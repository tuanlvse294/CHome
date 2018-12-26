<?php

namespace App\Http\Controllers;

use App\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ProcessImage;

    /**
     * Display a listing of the offer.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('offer.list', ['items' => Offer::all(), 'title' => 'Quản lý bài đăng']);
    }

    /**
     * Show the form for creating a new offer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offer.edit', ['title' => "Đăng tin rao vặt mới"]);
    }

    /**
     * Store a newly created offer in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer = new Offer();

        return $this->process($request, $offer);
    }

    /**
     * Display the specified offer.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        $liked = null;
        $is_bought = false;
        if (\Auth::check()) {
            $mycomment = $this->get_my_comment($offer->id);
            $mycomment->fill_olds();
            $is_bought = $this->is_bought_this_offer($offer->id);
        }

        $related = $offer->category->offers->random(min(4, $offer->category->offers->count()));
        return view('offer.detail', ['item' => $offer,
            'is_bought' => $is_bought,
            'liked' => $liked,
            'title' => $offer->name,
            'related' => $related
        ]);
    }

    /**
     * Show the form for editing the specified offer.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        if (null == \Session::get('errors'))
            $offer->fill_olds();

        return view('offer.edit', ['item' => $offer, 'title' => "Chỉnh sửa tin rao vặt"]);
    }

    /**
     * Update the specified offer in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        return $this->process($request, $offer);
    }

    /**
     * Remove the specified offer from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Offer::destroy($id);

        return redirect('/manage/offers');
    }


    //this process step is same for store new offer and save old edited offer
    protected function process(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string',
            'city_id' => 'required',
            'district_id' => 'required',
            'area' => 'required',
            'address' => 'required',
            'content' => 'required',
            'price' => 'required|numeric|min:0'
        ]);
        $offer->fill($request->all()); //fill all inputs to model

        if ($request->files->has('image')) { //save uploaded images
            $urls = array();

            foreach ($request->files->get('image') as $file) {
                $path = $this->process_image($file);
                array_push($urls, $path);
            }
            $offer->image_urls = json_encode($urls);
        } else if (is_null($offer->image_urls)) {
            $offer->images = json_encode(['no-thumbnail.png']); //there's no image, we will use default image
        }
        $offer->save(); //save model to database

        return redirect('/');
    }

    //save user's review comment
    public function save_comment(Request $request, $offer_id)
    {
        $request->validate([
            'content' => 'required|string',
            'score' => 'required|numeric'
        ]);
        $comment = $this->get_my_comment($offer_id);
        $comment->user_id = \Auth::id();
        $comment->offer_id = $offer_id;
        $comment->fill($request->all());
        $comment->save();

        return redirect('/offers/' . $offer_id);
    }

    //get user's review comment in this offer
    protected function get_my_comment($offer_id)
    {
        $query = Comment::whereUserId(\Auth::id())->whereOfferId($offer_id);
        if ($query->count() > 0) //there's existed comment
            return $query->get()[0]; //take the first
        return new Comment(); //return new comment
    }

    //like this offer
    public function like_offer(Request $request, $offer_id)
    {
        \Auth::user()->liked_offers()->attach($offer_id);

        return redirect('/offers/' . $offer_id);
    }

    //dislike this offer
    public function dislike_offer(Request $request, $offer_id)
    {
        \Auth::user()->liked_offers()->detach($offer_id);

        return redirect('/offers/' . $offer_id);
    }

    //check if the user has boudgt this offer before?
    private function is_bought_this_offer($offer_id)
    {
        foreach (\Auth::user()->orders()->whereStatus('done')->get() as $order) {

            foreach ($order->items as $item) {
                if ($item->offer_id == $offer_id)
                    return true;
            }
        }
        return false;
    }

    public function add_to_wishlist(Offer $offer)
    {
        \Auth::user()->liked_offers()->attach($offer);
        \Session::flash('message', $offer->name . ' đã thêm vào ưa thích.');
    }

    public function remove_from_wishlist(Offer $offer)
    {
        \Auth::user()->liked_offers()->detach($offer);
        \Session::flash('message', $offer->name . ' đã bỏ thích.');
    }

    private function log($type, $offer_id)
    {
        $log = Log::query()->firstOrNew(
            ['type' => $type, 'value1' => $offer_id, 'date' => Carbon::today()->timestamp]);
        $log->value2++;
        $log->save();
    }

}
