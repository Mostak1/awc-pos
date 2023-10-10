<?php

namespace App\Http\Controllers;

use App\Models\CustomerPrepaidCard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerPrepaidCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CustomerPrepaidCard::all();
        return view('card.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('card.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::now();
        $thirtyDaysAgo = Carbon::now()->addDays(31);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'customer_card_number'=>'green'.Str::random(7),
            'card_valid_date' =>$thirtyDaysAgo,
            'card_activation_date'=>$currentDate,
            'card_status'=>$request->card_status
        ];
        $create = CustomerPrepaidCard::create($data);
        if ($create) {
            return back()->with('success', 'card ' . $create->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPrepaidCard $customerPrepaidCard)
    {
        return view('card.show', compact('card'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerPrepaidCard $customerPrepaidCard)
    {
        return view('card.edit', compact('card'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerPrepaidCard $customerPrepaidCard)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename ?? $customerPrepaidCard->image,
            'active' => $request->active,
        ];

        $customerPrepaidCard->update($data);
        if ($customerPrepaidCard->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerPrepaidCard $customerPrepaidCard)
    {
        
        if (CustomerPrepaidCard::destroy($customerPrepaidCard->id)) {
            return back()->with('success', $customerPrepaidCard->id . ' has been deleted!');
        } else {
            return back()->with('error', 'Delete Failed!');
        }
    }
}
