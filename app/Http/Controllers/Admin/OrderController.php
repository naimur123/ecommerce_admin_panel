<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ["index","paymentType","invoice_no","product_name","order_quantity","customer_name","customer_phone","vendor_name", "code","transaction_no","price","division","address","date","status","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ["index","payment_type_id","invoice_no","product_name","order_quantity","customer_name","customer_phone","vendor_name", "code","transaction_id","price","division","address","created_at","status","action"];
        return $columns;
    }
    //GetModel
    private function getModel(){
        return new Order();
    }
    //Get Datas
    public function index(Request $request){
        if( $request->ajax() )
        {
            return $this->getDataTable($request);
        }
        $params = [
            'nav'               => 'product',
            'subNav'            => 'product.list',
            "pageTitle"         => "Order List",
            'tableColumns'      => $this->getColumns(),
            'dataTableColumns'  => $this->getDataTableColumns(),
            "dataTableUrl"      => URL::current(),
            'tableStyleClass'   => 'bg-light-blue',
            'reportUrl'         => route('admin.salesReport')
           
        ];
        return view('admin.order.table', $params);
    }

    // status update
    public function updateOrderStatus(Request $request){
        $status = $request->status;
        $order_id = $request->order_id;
        $product_id = $request->product_id ?? '';
        $product_qunatity = $request->quantity ?? '';
        $order = Order::find($order_id);
        if($order){

            if($status == 'Accepted'){
                $product = Product::find($product_id);
                if($product->quantity > 0){
                    $product->quantity = $product->quantity - $product_qunatity;  
                    $product->save();


                    $order->status = $status;
                    $order->accepted_at = Carbon::now();
                    $order->save();

                    return response()->json(['message' => 'Accepted']);

                }
                else{
                    return response()->json(['message' => 'Error']);
                }
               
            }else if($status == 'Cancelled'){
                $order->status = $status;
                $order->cancelled_at = Carbon::now();
                $order->save();
                return response()->json(['message' => 'Cancelled']);
            }
            else{
                $order->status = $status;
                $order->shifted_at = Carbon::now();
                $order->save();
                return response()->json(['message' => 'Shipped']);
            }
        }
    }

    //genrate sales report
    public function generateSalesReport(Request $request){
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $sellProducts = OrderDetails::with('productOrdered', 'order')
                        ->whereHas('order', function ($query) use ($startDate, $endDate) {
                            $query->where(function ($subQuery) use ($startDate, $endDate) {
                                $subQuery->where('status', 'Accepted')
                                        ->orWhere(function ($shippedAtQuery) use ($startDate, $endDate) {
                                            $shippedAtQuery->where('status', 'Shipped')
                                                            ->whereBetween('shipped_at', [$startDate, $endDate]);
                                        });
                            });
                        })
                        ->get();

        $groupedData = $sellProducts->groupBy('productOrdered.vendor.name');


        // dd($groupedData);\
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.order.report', compact('groupedData'));
        return $pdf->stream('report.pdf');
    }

    protected function getDataTable(Request $request){
        if ($request->ajax()){
           $data = OrderDetails::with('productOrdered', 'order')->get();
           $data = $data->filter(function ($item) {
            return $item->order->status != "Pending";
           });
           return DataTables::of($data)->addIndexColumn()
                  ->addColumn('index', function(){ return ++$this->index; })
                  ->addColumn('payment_type_id', function($row){ return $row->order->paymentType->name ?? ""; })
                  ->addColumn('invoice_no', function($row){ return $row->order->invoice_no; })
                  ->addColumn('product_name', function($row){ return $row->productOrdered->name; })
                  ->addColumn('order_quantity', function($row){ return $row->product_sales_quantity; })
                  ->addColumn('customer_name', function($row){ return $row->order->user->name ?? ""; })
                  ->addColumn('customer_phone', function($row){ return $row->order->phone ?? ""; })
                  ->addColumn('vendor_name', function($row){ return $row->productOrdered->vendor->name ?? ""; })
                  ->addColumn('code', function($row){ return $row->productOrdered->code ?? ""; })
                  ->addColumn('transaction_id', function($row){ return $row->order->transaction_id ?? ""; })
                  ->addColumn('price', function($row){ return $row->productOrdered->price - $row->productOrdered->discount_price ?? ""; })
                  ->addColumn('division', function($row){ return $row->order->shipping->division ?? ""; })
                  ->addColumn('address', function($row){ return $row->order->shipping_address_details ?? ""; })
                  ->addColumn('created_at', function($row){ return $row->order->created_at ?? ""; })
                  ->addColumn('status', function($row){ return $row->order->status; })
                  ->addColumn('action', function($row){
                    $btn = '';
                    if($row->order->status == 'Processing'){
                        $btn = '<button class="btn btn-warning btn-sm accept-order" data-order-id="'.$row->order->id.'" data-product-id ="'.$row->productOrdered->id.'" data-quantity="'.$row->product_sales_quantity.'">Accept</button> &nbsp';
                        $btn .= '<button class="btn btn-danger btn-sm cancel-order" data-order-id="'.$row->order->id.'">Cancel</button>';
                    }
                    if($row->order->status == 'Accepted'){
                        $btn .= '<button class="btn btn-success btn-sm ship-order" data-order-id="'.$row->order->id.'">Ship Order</button>';
                    }
                    return $btn;
                      
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
  
    }

    //ststus wise row color
    // $this->getStatusRowClass($row->order->status)
    // private function getStatusRowClass($status)
    // {
    //     switch ($status) {
    //         case 'Pending':
    //             return 'table-warning';
    //         case 'Processing':
    //             return 'table-success'; 
    //         case 'Cancelled':
    //             return 'table-danger'; 
    //         default:
    //             return '';
    //     }
    // }

}
