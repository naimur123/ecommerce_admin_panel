<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ["index","invoice_no","product_name","order_quantity","customer_name","customer_phone", "division","address", "code","transaction_no","price","status","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ["index","invoice_no","product_name","order_quantity","customer_name","customer_phone","division","address","code","transaction_id","price","status","action"];
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
           
        ];
        return view('vendors.order.table', $params);
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

    protected function getDataTable(Request $request){
        if ($request->ajax()){
           $vendor = Auth::user()->id;
           $data = OrderDetails::with('productOrdered', 'order')
                ->whereHas('productOrdered', function ($query) use ($vendor) {
               $query->where('vendor_id', $vendor);
           })->get();
           return DataTables::of($data)->addIndexColumn()
                  ->addColumn('index', function(){ return ++$this->index; })
                  ->addColumn('invoice_no', function($row){ return $row->order->invoice_no; })
                  ->addColumn('code', function($row){ return $row->productOrdered->code ?? "N/A"; })
                  ->addColumn('product_name', function($row){ return $row->productOrdered->name; })
                  ->addColumn('order_quantity', function($row){ return $row->product_sales_quantity; })
                  ->addColumn('customer_name', function($row){ return $row->order->user->name ?? "N/A"; })
                  ->addColumn('customer_phone', function($row){ return $row->order->phone ?? "N/A"; })
                  ->addColumn('division', function($row){ return $row->order->shipping->division ?? ""; })
                  ->addColumn('address', function($row){ return $row->order->shipping_address_details ?? ""; })
                  ->addColumn('transaction_id', function($row){ return $row->order->transaction_id ?? "N/A"; })
                  ->addColumn('price', function($row){ return $row->order->amount ?? "N/A"; })
                  ->addColumn('status', function($row){ return $row->order->status ?? "N/A"; })
                  ->addColumn('action', function($row){
                    //   $vendor = Vendor::find(Auth::user()->id);
                    //   $deleteBtn = '';
                    //   if($vendor->hasPermissionTo('Order Cancel')){
                    //       $deleteBtn .= '<a href="'.route('admin.products.delete', $row->id).'" class="btn btn-danger btn-sm" data-confirm-delete="true">Cancel</a>';
                          
                    //   }
                    //   return $deleteBtn;
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
}
