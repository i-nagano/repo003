<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address();
        $address->parkdate = $request->parkdate;
        $address->member_name = $request->member_name;
        $address->car_name = $request->car_name;
        $address->address = $request->address;
        $address->comment = $request->comment;
        $address->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address, $id)
    {
        $address = Address::where('id', $id);
        $update = [
            'parkdate' => $request->parkdate,
            'member_name' => $request->member_name,
            'car_name' => $request->car_name,
            'address' => $request->address,
            'comment' => $request->comment,
        ];
        $address->update($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address, $id)
    {
        $address = Address::where('id', $id);
        $address->destroy();
    }
}
