<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ProcessImage;

    public function manage()
    {
        return view('offer.list', ['items' => Offer::all(), 'title' => 'Quản lý tin rao vặt']);
    }

    public function trash()
    {
        return view('offer.list', ['items' => Offer::onlyTrashed()->get(), 'title' => 'Quản lý tin rao vặt đã xoá', 'trash' => true]);
    }


    public function restore($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        $offer->restore();
        \Session::flash("message", "Khôi phục tin rao vặt " . $offer->title);
        return redirect(route('offers.manage'));
    }

    public function force_delete($offer)
    {
        $offer = Offer::withTrashed()->find($offer);
        \Session::flash("message", "Đã xoá vĩnh viễn tin rao vặt " . $offer->title);
        $offer->forceDelete();
        return redirect(route('offers.trash'));
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

    public function show(Offer $offer)
    {
        $offer->views += 1;
        $offer->save();
        return view('offer.detail', ['item' => $offer,
            'title' => $offer->title,
        ]);
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
        \Session::flash("message", "Đã xoá tin rao vặt " . $offer->title);
        $offer->delete();
        return redirect(route('offers.manage'));
    }


    //this process step is same for store new offer and save old edited offer
    protected function process(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string',
            'city_id' => 'required',
            'district_id' => 'required',
            'area' => 'required',
            'front' => 'required',
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
