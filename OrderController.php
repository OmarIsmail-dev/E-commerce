<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResources;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use MathPHP\Statistics\Descriptive;

class OrderController extends Controller
{
 
    public function index()
    {
 
        $Order = Order::orderBy('created_at', 'DESC')->with("product", "user")->get();


        return  OrderResources::collection($Order);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

 

    public function standerDeviation(Request $request)
{
    $results = []; 
    
    // تحديد أول وآخر يوم موجود في جدول الطلبات
    $minDate = Order::min(DB::raw('DATE(created_at)'));
    $maxDate = Order::max(DB::raw('DATE(created_at)'));

    // حساب عدد الأيام بين أول وآخر تاريخ
    $totalDays = Carbon::parse($minDate)->diffInDays(Carbon::parse($maxDate)) + 1; 

    // تجميع الطلبات اليومية
    $dailyDemands = Order::with('product')
        ->selectRaw('product_id, DATE(created_at) as day, SUM(quantity) as total_quantity')
        ->where('order_status', 'completed')
        ->groupBy('product_id', 'day')
        ->orderBy('product_id')
        ->orderBy('day')
        ->get()
        ->groupBy('product_id');

    foreach ($dailyDemands as $productId => $days) {
        $dailyQuantities = $days->pluck('total_quantity')->toArray();

        $stdDev = (count($dailyQuantities) > 1)
            ? Descriptive::standardDeviation($dailyQuantities)
            : 0;

        $totalQuantity = array_sum($dailyQuantities);
        $mean = $totalQuantity / $totalDays;

        $product = $days->first()->product;
        $productName = optional($product)->name ?? 'N/A';

        $results[] = [
            'product_id' => $productId,
            'mean_daily_demand' => number_format($mean, 6),
            'std_daily_demand' => number_format($stdDev, 6),
            'product_name' => $productName
        ];
    }

    return $results;
}

    
     


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $Order = Order::find($id);
    
         if (!$Order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
         return new OrderResources($Order);
    }
                 

 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function TotalAmountOrder()
    {
       
                 
       $price = Order::where("order_status","completed")->sum("price"); 
        

       $TotalAmount=    number_format( $price,0 );   
       return response()->json(['TotalAmount' => $TotalAmount]);

    }
    
    public function total()
    {  
        
        $sales = DB::table('orders as oi')
        ->join('orders as o', 'oi.id', '=', 'o.id')
        ->join('products as p', 'oi.product_id', '=', 'p.id')
        ->select('p.name as product_name', DB::raw('SUM(oi.quantity) as total_sold'))
        ->where('o.order_status', 'completed')
        ->groupBy('p.id', 'p.name')
        ->orderByDesc('total_sold')
        ->get();

        return response()->json([$sales]);
         
    }

    
}
