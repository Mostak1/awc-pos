<?php

namespace App\Http\Controllers;

use App\Models\CustomerPrepaidCard;
use App\Models\Menu;
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
        $items = CustomerPrepaidCard::with('menu')->get();
        return view('card.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = Menu::where('subcategory_id', 8)->pluck('name', 'id');
        return view('card.create', compact('menu'));
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
            'customer_card_number' => 'green' . Str::random(7),
            'card_valid_date' => $thirtyDaysAgo,
            'card_activation_date' => $currentDate,
            'card_status' => $request->card_status,
            'total_meal' => $request->total_meal,
            'consumrd_meal' => 0,
            'menu_id' => $request->menu_id
        ];
        $create = CustomerPrepaidCard::create($data);
        if ($create) {
            return back()->with('success', 'card ' . $create->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerPrepaidCard $card)
    {
        return view('card.show', compact('card'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerPrepaidCard $card)
    {
        // dd($card);
        $menu = Menu::where('subcategory_id', 8)->pluck('name', 'id');
        return view('card.edit', compact('menu', 'card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerPrepaidCard $customerPrepaidCard)
    {
        $currentDate = Carbon::now();
        $thirtyDaysAgo = Carbon::now()->addDays(31);
        $card = CustomerPrepaidCard::find($request->id);
        // dd($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'menu_id' => $request->menu_id,
            // 'customer_card_number' => $request->customer_card_number,
            'card_status' => $request->card_status,
            'total_meal' => $request->total_meal,
            'consumrd_meal' => 0,
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

    public function cardcheck(Request $request)
    {
        $currentDate = Carbon::now();
        $customer = CustomerPrepaidCard::where('customer_card_number', $request->customer_card_number)->first();

        if ($customer) {
            $havemeal =$customer->total_meal-$customer->consumrd_meal;
            if ($havemeal>0 && $currentDate <= $customer->card_valid_date) {
                $customer->consumrd_meal = $customer->consumrd_meal + 1;
                $customer->save();
    
                return redirect()->back()->with('success',$customer->name . ' Successfully Consumed Todays Meal!');
            } else {
                return redirect()->back()->with('info',$customer->name . ' You Consumed All Meal or You Date Expired');
               
            }
            
           
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }

    public function cardinfo()
    {
        return view('card.info');
    }
    public function getcardinfo(Request $request){
        $customer = CustomerPrepaidCard::where('customer_card_number', $request->customer_card_number)->first();

        if ($customer) {
            return redirect()->back()->with('success',
            'Name:'.$customer->name . '|| Email:'.$customer->email . 
            '|| Total Meal: '.$customer->total_meal .
            '|| Consumed Meal: '.$customer->consumrd_meal.  
            '|| Remaining Meal: '.$customer->total_meal-$customer->consumrd_meal.
            '|| Deadline: '.$customer->card_valid_date
        );
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }
}
