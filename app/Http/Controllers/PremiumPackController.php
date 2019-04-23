<?php

namespace App\Http\Controllers;

use App\PremiumPack;
use Illuminate\Http\Request;

class PremiumPackController extends Controller
{
    private $validator_rule = [
        'price' => 'required|numeric|min:1',
        'days' => 'required|numeric|min:1',
        'info' => 'required',
        'type' => 'required',
    ];

    /**
     * Display a listing of the pack.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('premium.list', ['items' => PremiumPack::all(), 'title' => 'Quản lý gói tin đặc biệt']);
    }

    /**
     * Show the form for creating a new pack.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('premium.edit', ['title' => 'Tạo gói tin đặc biệt mới']);
    }

    /**
     * Store a newly created pack in storage.
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
     * Show the form for editing the specified pack.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PremiumPack $premium)
    {
        $premium->fill_olds();

        return view('premium.edit', ['item' => $premium, 'title' => 'Chỉnh sửa gói tin đặc biệt']);
    }

    /**
     * Update the specified pack in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PremiumPack $premium)
    {
        $request->validate(
            $this->validator_rule
        );
        $premium->fill($request->all());
        $premium->save();

        return redirect(route('premium.manage'));
    }

    /**
     * Remove the specified pack from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(PremiumPack $premium)
    {
        $premium->delete();
        return redirect()->back();
    }
}
