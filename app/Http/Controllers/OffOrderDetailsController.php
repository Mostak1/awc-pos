<?php

namespace App\Http\Controllers;

use App\Models\OffOrderDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OffOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OffOrderDetails::with('offorder','menu')->get();

        return view('offorderdetails.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffOrderDetails $offOrderDetails)
    {
        //
    }
}
