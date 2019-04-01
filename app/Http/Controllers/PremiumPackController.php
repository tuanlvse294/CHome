<?php

namespace App\Http\Controllers;

use App\PremiumPack;
use Illuminate\Http\Request;

class PremiumPackController extends Controller
{
    private $validator_rule = [
        'price' => 'required|numeric',
        'days' => 'required|numeric',
        'info' => 'required',
        'type' => 'required',
    ];

    /**
     * Display a listing of the code.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('premium.list', ['items' => PremiumPack::all(), 'title' => 'Quản lý gói tin đặc biệt']);
    }

    /**
     * Show the form for creating a new code.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('premium.edit', ['title' => 'Tạo gói tin đặc biệt mới']);
    }

    /**
     * Store a newly created code in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            $this->validator_rule
        );
        $pack = new PremiumPack();
        $pack->fill($request->all());
        $pack->save();

        return redirect(route('premium.manage'));

    }


    /**
     * Show the form for editing the specified code.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PremiumPack $pack)
    {
        $pack->fill_olds();

        return view('premium.edit', ['item' => $pack, 'title' => 'Chỉnh sửa gói tin đặc biệt']);
    }

    /**
     * Update the specified code in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PremiumPack $pack)
    {
        $request->validate(
            $this->validator_rule
        );
        $pack->fill($request->all());
        $pack->save();

        return redirect(route('premium.manage'));
    }

    /**
     * Remove the specified code from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(PremiumPack $pack)
    {
        $pack->delete();
        return redirect()->back();
    }
}
