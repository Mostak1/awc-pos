<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\OffOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $items = Customer::with('menu', 'user','auth')->get();
        return view('customer.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = Menu::where('subcategory_id', 8)->pluck('name', 'id');
        return view('customer.create', compact('menu'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required','string','min:3' ,'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //         'mobile' => ['required','max:255', 'unique:'.Customer::class],
    //     ]);
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make(12345678),
    //     ]);

    //     if ($user) {
    //         $currentDate = Carbon::now();
    //         $thirtyDaysAgo = Carbon::now()->addDays(31);
    //         $data = [
    //             'user_id' => $user->id,
    //             'mobile' => $request->mobile,
    //             'address' => $request->address,
    //             'card_number' => 'green' . Str::random(7),
    //             'valid_date' => $thirtyDaysAgo,
    //             'active_date' => $currentDate,
    //             'card_status' => $request->card_status,
    //             'total_meal' => $request->total_meal,
    //             'consumed_meal' => 0,
    //             'menu_id' => $request->menu_id,
    //             'auth_id' => Auth::user()->id
    //         ];
    //         $menu = Menu::find($request->menu_id);
    //         $create = Customer::create($data);
    //         $order = new OffOrder();
    //         $order->tab_id = '1';
    //         $order->user_id = Auth::user()->id;
    //         $order->total = $menu->price;
    //         $order->discount = 0;
    //         $order->reason = 'Monthly Package';
    //         $order->save();
    //         if ($create && $order->save()) {
    //             return back()->with('success', 'Customer ID: ' . $create->id . ' has been created Successfully!');
    //         }
    //     }
    // }
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => ['required','string','min:3' ,'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'mobile' => ['required','max:255', 'unique:'.Customer::class],
    ]);
    DB::beginTransaction();

    try {

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(12345678),
        ]);

        // Create a new customer
        $currentDate = Carbon::now();
        $thirtyDaysAgo = Carbon::now()->addDays(31);
        $data = [
            'user_id' => $user->id,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'card_number' => 'green' . Str::random(7),
            'valid_date' => $thirtyDaysAgo,
            'active_date' => $currentDate,
            'card_status' => $request->card_status,
            'total_meal' => $request->total_meal,
            'consumed_meal' => 0,
            'menu_id' => $request->menu_id,
            'auth_id' => Auth::user()->id
        ];

        $customer = Customer::create($data);

        // Create a new order
        $menu = Menu::find($request->menu_id);
        $order = new OffOrder();
        $order->tab_id = '1';
        $order->user_id = Auth::user()->id;
        $order->total = $menu->price;
        $order->discount = 0;
        $order->reason = 'Monthly Package';
        $order->save();

        // Commit the transaction
        DB::commit();
    } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while processing the order.');
    }

    return back()->with('success', 'Customer ID: ' . $customer->id . ' has been created Successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $menu = Menu::where('subcategory_id', 8)->pluck('name', 'id');
        return view('customer.edit', compact('customer','menu'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $currentDate = Carbon::now();
            $thirtyDaysAgo = Carbon::now()->addDays(31);
            $data = [
                'mobile' => $request->mobile,
                'address' => $request->address,
                // 'valid_date' => $thirtyDaysAgo,
                // 'active_date' => $currentDate,
                'card_status' => $request->card_status,
                'total_meal' => $request->total_meal,
                'menu_id' => $request->menu_id
            ];
            $customer->update($data);
        if ($customer->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if (Customer::destroy($customer->id)) {
            return back()->with('success', $customer->id . ' has been deleted!');
        } else {
            return back()->with('error', 'Delete Failed!');
        }
    }
    public function cardcheck(Request $request)
    {
        $currentDate = Carbon::now();
        $customer = Customer::with('user')->where('card_number', $request->card_number)->first();

        if ($customer) {
            $havemeal =$customer->total_meal-$customer->consumed_meal;
            if ($havemeal>0 && $currentDate <= $customer->valid_date) {
                $customer->consumed_meal = $customer->consumed_meal + 1;
                $customer->save();

                $order = new OffOrder();
                $order->tab_id = '1';
                $order->user_id = Auth::user()->id;
                $order->total = 0;
                $order->discount = 0;
                $order->reason = 'Monthly Package of ' . $customer->user->name;
                $order->save();
                return redirect()->back()->with('success',$customer->user->name . ' Successfully Consumed Todays Meal!');
            } else {
                return redirect()->back()->with('info',$customer->user->name . ' You Consumed All Meal or You Date Expired');
               
            }
            
           
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }

    public function cardinfo()
    {
        return view('customer.info');
    }
    public function getcardinfo(Request $request){
        $customer = Customer::with('user')->where('card_number', $request->customer_card_number)->first();

        if ($customer) {
            return redirect()->back()->with('customer',$customer);
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }
}
