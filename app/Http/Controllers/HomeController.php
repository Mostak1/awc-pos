<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OffOrder;
use App\Models\OffOrderDetails;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function main()
    {
        $user_id = Auth::user()->id;
        $roles = UserRole::where('user_id', $user_id)->get();
        return view('layouts.side_nav', compact('roles'));
    }
    public function adminHome()
    {
        $currentDate = Carbon::now();
        // Get date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Get date 30 days ago
        $thirtyDaysAgo = Carbon::now()->subDays(30);


        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)

            ->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)

            ->sum('discount');



        // Count orders for the last 7 days
        $orderCountW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])->count();

        // Count orders for the last 30 days
        $orderCountM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])->count();

        // Calculate total sales for the last 7 days
        $totalSalesW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->sum('total');
        $totalDisW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->sum('discount');

        // Calculate total sales for the last 30 days
        $totalSalesM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->sum('total');
        $totalDisM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->sum('discount');

        $salesCountD = OffOrder::whereDate('created_at', $currentDate)

            ->count();
        $salesCountW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->count();
        $salesCountM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->count();

        // dd($orderCountD);
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)->sum('discount');

        $items = OffOrder::with('tab', 'user', 'offorderdetails')->whereDate('created_at', $currentDate)->get();
        $orderDetails = OffOrderDetails::with('menu', 'off_order')->whereDate('created_at', $currentDate)->get();
        // $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        // return view('offorder.dailyreport', compact('items', 'orderCountD', 'totalSalesD', 'totalDisD'));

        // dd($role);

        return view('dashboard', compact('totalDisM', 'totalDisD', 'totalDisW', 'items', 'orderDetails'))
            ->with('orderCountD', $orderCountD)
            ->with('totalSalesD', $totalSalesD)
            ->with('salesCountD', $salesCountD)
            ->with('orderCountW', $orderCountW)
            ->with('totalSalesW', $totalSalesW)
            ->with('salesCountW', $salesCountW)
            ->with('orderCountM', $orderCountM)
            ->with('totalSalesM', $totalSalesM)
            ->with('salesCountM', $salesCountM);
    }

    public function offorderDetailsapi()
    {
        $orderDetails = OffOrderDetails::with('menu.category', 'off_order')->get();
        return response()->json($orderDetails);
    }
}
