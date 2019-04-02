<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Offer;
use App\PremiumPack;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    use ProcessImage;

    public function manage()
    {
        return view('offer.list', ['items' => Offer::all()->where('accepted', '=', true), 'title' => 'Quản lý tin rao vặt']);
    }

    public function manage_accept()
    {
        return view('offer.list', ['items' => Offer::all()->where('accepted', '=', false), 'title' => 'Xét duyệt  tin rao vặt', 'accept' => true]);
    }

    public function accept(Offer $offer)
    {
        $offer->accepted = true;
        $offer->save();
        Notification::makeNotification("Tin đăng của bạn đã được duyệt!!!", route('offers.show', ['offer' => $offer]), $offer->user);
        return redirect()->back();
    }

    public function trash()
    {
        return view('offer.list', ['items' => Offer::onlyTrashed()->get(), 'title' => 'Quản lý tin rao vặt đã xoá', 'trash' => true]);
    }

    public function promote(Offer $offer)
    {
        return view('offer.promote', ['offer' => $offer, 'title' => 'Bán nhanh hơn']);
    }

    public function pick_promote(Offer $offer, PremiumPack $pack)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        if ($pack->type == 'premium') {
            $premium_expire = Carbon::parse($offer->premium_expire);
            if ($premium_expire < $now) {
                $premium_expire = $now;
            }

            $premium_expire->addDays($pack->days);
            $offer->premium_expire = $premium_expire;
        } elseif ($pack->type == 'top') {
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
        $offer->save();

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->amount = $pack->price;
        $transaction->info = "Mua gói " . $pack->type_str() . " thời hạn " . $pack->days . " ngày.";

        $transaction->save();

        return redirect(route('users.premiums'));
    }


    public function restore($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        $offer->restore();
        \Session::flash("message", "Khôi phục tin rao vặt " . $offer->title);
        return redirect()->back();

    }

    public function force_delete($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        \Session::flash("message", "Đã xoá vĩnh viễn tin rao vặt " . $offer->title);
        $offer->forceDelete();
        return redirect()->back();
    }

    public function create()
    {
        return view('offer.edit', ['title' => "Đăng tin rao vặt mới"]);
    }

    public function store(Request $request)
    {
        $offer = new Offer();

        return $this->process($request, $offer);
    }

    public function show(Request $request, Offer $offer)
    {
        if ($offer->accepted or (Auth::check() && Auth::user()->has_role('admin'))) {
            if ($request->has('click') && $request->get('click') == 'from_ads') {
                $offer->ads_reach += 1;
            }
            $offer->views += 1;
            $offer->save();
            return view('offer.detail', ['item' => $offer,
                'title' => $offer->title,
            ]);
        } else abort(404);
    }

    public function edit(Offer $offer)
    {
        $offer->fill_olds();
        return view('offer.edit', ['item' => $offer, 'title' => "Chỉnh sửa tin rao vặt"]);
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::query()->findOrFail($id);

        return $this->process($request, $offer);
    }


    public function destroy(Offer $offer)
    {
        \Session::flash("message", "Đã ẩn tin rao vặt " . $offer->title);
        $offer->delete();
        Notification::makeNotification("Tin đăng của bạn đã bị ẩn!!!", route('offers.show', ['offer' => $offer]), $offer->user);
        return redirect()->back();
    }


    //this process step is same for store new offer and save old edited offer
    protected function process(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string',
            'city_id' => 'required',
            'district_id' => 'required',
            'area' => 'required',
            'front' => 'required|numeric|min:1|max:10000',
            'address' => 'required',
            'content' => 'required',
            'price' => 'required|numeric|min:0'
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
        Notification::makeNotification("Đã đăng tin mới thành công!!", route('offers.show', ['offer' => $offer]), Auth::user());
        return redirect('/');
    }


    public function like(Offer $offer)
    {
        if (!\Auth::user()->liked_offers->contains($offer))
            \Auth::user()->liked_offers()->attach($offer);
        $offer->refresh();
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
