<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Offer;
use App\PremiumPack;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    use ProcessImage;

    //amdin panel to see all accepted offers
    public function manage()
    {
        return view('offer.list', ['items' => Offer::query()->whereHas(
            'user', function ($query) {
            $query->where('deleted_at', '=', null);
        })->where('accepted', '=', true)->get(), 'title' => 'Quản lý tin rao vặt']);
    }

    //admin panel to see all unaccepted offers

    public function manage_accept()
    {
        return view('offer.list', ['items' => Offer::all()->where('accepted', '=', false), 'title' => 'Xét duyệt  tin rao vặt', 'accept' => true]);
    }

    //accept a offer
    public function accept(Offer $offer)
    {
        $offer->accepted = true;
        $offer->save();
        Notification::makeNotification("Tin đăng đã được duyệt!!!", route('offers.show', ['offer' => $offer]), $offer->user); //notify the offer's ownser
        return redirect(route('offers.manage_accept')); //back to manage panel
    }

    //amdin panel to see all hidden offers

    public function trash()
    {
        $from_trashed_users = Offer::query()->whereHas(
            'user', function ($query) {
            $query->where('deleted_at', '!=', null);
        })->where('accepted', '=', true)->get();

        $all_trashed = Offer::onlyTrashed()->get();
        return view('offer.list', ['items' => $all_trashed->merge($from_trashed_users), 'title' => 'Quản lý tin rao vặt đã ẩn']);
    }

    //show user premium packs

    public function promote(Offer $offer)
    {
        return view('offer.promote', ['offer' => $offer, 'title' => 'Bán nhanh hơn']);
    }

    //user choosed premium packs

    public function pick_promote(Offer $offer, PremiumPack $pack)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh'); //what time is it now?
        if ($pack->type == 'premium') { //premium then, you are special
            $premium_expire = Carbon::parse($offer->premium_expire); //when will it expire?
            if ($premium_expire < $now) { //if it's expired
                $premium_expire = $now; //then start is now
            }

            $premium_expire->addDays($pack->days); //add premium pack's days to start
            $offer->premium_expire = $premium_expire;
        } elseif ($pack->type == 'top') { //so so
            $top_expire = Carbon::parse($offer->top_expire);
            if ($top_expire < $now) {
                $top_expire = $now;
            }

            $top_expire->addDays($pack->days);
            $offer->top_expire = $top_expire;
        } elseif ($pack->type == 'highlight') {
            $highlight_expire = Carbon::parse($offer->highlight_expire);
            if ($highlight_expire < $now) {
                $highlight_expire = $now;
            }

            $highlight_expire->addDays($pack->days);
            $offer->highlight_expire = $highlight_expire;
        }
        $offer->save(); //saved new expired date

        $transaction = new Transaction(); //make new transaction
        $transaction->user_id = Auth::id(); //of current user
        $transaction->amount = $pack->price; //how much he paid
        $transaction->info = "Mua gói " . $pack->type_str() . " thời hạn " . $pack->days . " ngày."; //some info

        $transaction->save(); //save then
        Notification::makeNotification("Đã mua gói " . $transaction->info . " thành công!!!", route('users.premiums'), $offer->user); //notify the offer's ownser

        if ($offer->accepted)
            return redirect(route('users.premiums')); //go back to premium offers panel
        else
            return redirect(route('users.pending')); //go back to premium offers panel
    }

    //admin restore hidden offer
    public function restore($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        $offer->restore();
        \Session::flash("message", "Khôi phục tin rao vặt " . $offer->title);
        return redirect()->back();

    }

    //admin permanently delete offer
    public function force_delete($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        \Session::flash("message", "Đã xoá vĩnh viễn tin rao vặt " . $offer->title);
        $offer->forceDelete();
        return redirect()->back();
    }

    //user make new offer
    public function create()
    {
        return view('offer.edit', ['title' => "Đăng tin rao vặt mới"]);
    }

    //save new offer
    public function store(Request $request)
    {
        $offer = new Offer();

        return $this->process($request, $offer);
    }

    //view the offer in detail
    public function show(Request $request, Offer $offer)
    {
        if (($offer->accepted and !$offer->user->trashed()) or (Auth::check() && (Auth::user()->has_role('admin')) || Auth::id() == $offer->user_id)) {
            //if it's not accepted then only admin and the owner can see
            if (!Auth::check() || Auth::id() != $offer->user_id) {
                //if the owner see then views and ads reach will not increase
                if ($request->has('click') && $request->get('click') == 'from_ads') { //link from ads places
                    $offer->ads_reach += 1;
                }
                $offer->views += 1;
                $offer->save();
            }
            return view('offer.detail', ['item' => $offer,
                'title' => $offer->title,
            ]);
        } else abort(404);
    }

    //the owner see his hidden offer
    public function show_hidden(Request $request, $offer_id)
    {
        $offer = Offer::withTrashed()->find($offer_id);

        if ((Auth::check() && (Auth::user()->has_role('admin')) || Auth::user()->has_role('mod') || Auth::id() == $offer->user_id)) {
            //if it's not accepted then only admin and the owner can see
            if (Auth::id() == $offer->user_id)
                Session::flash('error', "Tin này đã bị ẩn - Liên hệ admin bằng chatbox hoặc hotline"); //show the nag after the header
            else
                Session::flash('error', "Tin này đã bị ẩn");
            return view('offer.detail', ['item' => $offer,
                'title' => $offer->title,
            ]);
        } else abort(404);
    }

    //not used
    public function edit(Offer $offer)
    {
        $offer->fill_olds();
        return view('offer.edit', ['item' => $offer, 'title' => "Chỉnh sửa tin rao vặt"]);
    }

    //not used
    public function update(Request $request, $id)
    {
        $offer = Offer::query()->findOrFail($id);

        return $this->process($request, $offer);
    }

    //admin hide the offer
    public function destroy(Offer $offer)
    {
        \Session::flash("message", "Đã ẩn tin rao vặt " . $offer->title);
        $offer->delete();
        Notification::makeNotification("Tin đăng đã bị ẩn!!!", route('offers.show_hidden', ['offer' => $offer]), $offer->user);
        return redirect()->back();
    }


    //this process step is same for store new offer and save old edited offer
    protected function process(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string',
            'city_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'area' => 'required|numeric|min:1|max:9223372036854775807',
            'front' => 'required|numeric|min:1|max:9223372036854775807',
            'address' => 'required',
            'content' => 'required',
            'price' => 'required|numeric|min:0|max:9999999999999',
            'image.*' => 'mimes:jpg,jpeg,png,bmp|max:2000'
        ], [
            'image.*.mimes' => 'Chỉ hỗ trợ định dạng ảnh jpeg, png, jpg và bmp!',
            'image.*.max' => 'Kích cỡ ảnh tối đa là 2MB!',
        ]);
        $offer->fill($request->all()); //fill all inputs to model
        $offer->user_id = \Auth::id();
        if ($request->files->has('image')) { //save uploaded images
            $urls = array();

            foreach ($request->files->get('image') as $file) {
                $path = $this->process_image($file);
                array_push($urls, $path);
            }
            $offer->images = json_encode($urls);
        }
        $offer->save(); //save model to database
        Notification::makeNotification("Tin của bạn đang chờ duyệt", route('users.pending'), Auth::user());
        return redirect('/');
    }

    //user like a offer
    public function like(Offer $offer)
    {
        if (!\Auth::user()->liked_offers->contains($offer)) //if not liked
            \Auth::user()->liked_offers()->attach($offer);  //then like it
        $offer->refresh(); //update the model, very important
        return view('offer.like_button', ['item' => $offer]);
    }

    public function unlike(Offer $offer)
    {
        if (\Auth::user()->liked_offers->contains($offer))
            \Auth::user()->liked_offers()->detach($offer);
        $offer->refresh();
        return view('offer.like_button', ['item' => $offer]);
    }


}


