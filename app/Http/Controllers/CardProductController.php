<?php

namespace App\Http\Controllers;

use App\Models\CardProduct;
use App\Models\CustomerPrepaidCard;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CardProduct::all();
        return view('cardproduct.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu= Menu::where('subcategory_id',8)->pluck('id', 'name');
        $subscriber =CustomerPrepaidCard::pluck('id','name');
        return view('cardproduct.create',compact('menu','subscriber') );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $currentDate = Carbon::now();
        $thirtyDaysAgo = Carbon::now()->subDays(31);
        $data = [
            'customer_prepaid_card_id' => $request->customer_prepaid_card_id,
            'total_meal' => $request->total_meal,
            'consumrd_meal' =>'',
            'menu_id'=>$request->menu_id
        ];
        $create = CardProduct::create($data);
        if ($create) {
            return back()->with('success', 'card ' . $create->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CardProduct $cardProduct)
    {
        return view('cardproduct.show', compact('card'))->with('user', Auth::user());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CardProduct $cardProduct)
    {
        return view('cardproduct.edit', compact('card'))->with('user', Auth::user());
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CardProduct $cardProduct)
    {
       
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename ?? $cardProduct->image,
            'active' => $request->active,
        ];

        $cardProduct->update($data);
        if ($cardProduct->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CardProduct $cardProduct)
    {
        if (CardProduct::destroy($cardProduct->id)) {
            return back()->with('success', $cardProduct->id . ' has been deleted!');
        } else {
            return back()->with('error', 'Delete Failed!');
        }
    }
}
