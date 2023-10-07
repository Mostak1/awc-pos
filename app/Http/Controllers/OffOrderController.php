<?php

namespace App\Http\Controllers;

use App\Models\OffOrder;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\OffOrderDetails;
use App\Models\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class OffOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OffOrder::with('tab','user')->get();
        return view('offorder.index')->with('items', $items);
    }
    public function dailyreport()
    {
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)->sum('discount');
        $items = OffOrder::with('tab','user')->whereDate('created_at', $currentDate)->get();
        // $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        return view('offorder.dailyreport', compact('items', 'orderCountD', 'totalSalesD','totalDisD'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all()); db tranjections
        $order = new OffOrder();
        $order->tab_id = '1';
        $order->user_id = Auth::user()->id ?? 1;
        $order->total = $request->totalbill;
        $order->discount = $request->discount;
        $order->reason = $request->reason;
        $order->save();

        foreach ($request->items as $item) {
            $orderDetail = new OffOrderDetails();
            $orderDetail->off_order_id = $order->id;
            $orderDetail->menu_id = $item['id'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->save();

            $menu = Menu::find($item['id']);
            if ($menu) {
                $menu->quantity = $menu->quantity - $item['quantity'];
                $menu->save();
            }
        }
        return back()->with('success','Order Details Added');
        // return response()->json(['success' => true]);
    }
    // return view('offorder.order')->with('success','Order Details Added');

    /**
     * Display the specified resource.
     */
    public function show(OffOrder $offorder)
    {
        // $items = OffOrderDetails::with('offorder', 'menu')->where('off_order_id', $offorder->id)->get();
        $items = OffOrderDetails::with('offorder', 'menu')
            ->where('off_order_id', $offorder->id)
            ->get();

        return view('offorder.show', compact('items'))->with('user', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffOrder $offorder)
    {
        $tabs = Tab::pluck('name', 'id');
        return view('offorder.edit', compact('offorder'))->with('tabs', $tabs)->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffOrder $offorder)
    {
        $data = [
            'tab_id' => $request->tab_id,
            'total' => $request->total,
        ];
        $offorder->update($data);
        if ($offorder->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!!!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffOrder $offOrder)
    {
        //
    }
}
