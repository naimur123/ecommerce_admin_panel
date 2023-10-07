<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ["index","paymentType","invoice_no","product_name","order_quantity","customer_name","vendor_name", "code","transaction_no","price","division","address","date","status","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ["index","payment_type_id","invoice_no","product_name","product_sales_quantity","customer_name","vendor_name", "code","transaction_id","price","division","shipping_address_details","created_at","status","action"];
        return $columns;
    }
    //GetModel
    private function getModel(){
        return new Order();
    }

    //Get Datas
    public function index(Request $request){
        // $data = OrderDetails::with('productOrdered', 'order')
        // ->whereHas('order', function ($query) {
        //             $query->where('status', 'Processing');
        //         })
        // ->get();

        
        //  dd($data);
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
            // 'tableStyleClass'   => '',
           
        ];
        return view('admin.order.table', $params);
    }

    protected function getDataTable(Request $request){
        if ($request->ajax()){
           $data = OrderDetails::with('productOrdered', 'order')->get();
           $data = $data->filter(function ($item) {
            return $item->order->status === "Processing";
           });
           return DataTables::of($data)->addIndexColumn()
                  ->addColumn('index', function(){ return ++$this->index; })
                  ->addColumn('payment_type_id', function($row){ return $row->order->paymentType->name ?? ""; })
                  ->addColumn('invoice_no', function($row){ return $row->order->invoice_no; })
                  ->addColumn('product_name', function($row){ return $row->productOrdered->name; })
                  ->addColumn('customer_name', function($row){ return $row->order->user->name ?? ""; })
                  ->addColumn('vendor_name', function($row){ return $row->productOrdered->vendor->name ?? ""; })
                  ->addColumn('code', function($row){ return $row->productOrdered->code ?? ""; })
                  ->addColumn('transaction_id', function($row){ return $row->order->transaction_id ?? ""; })
                  ->addColumn('price', function($row){ return $row->productOrdered->price - $row->productOrdered->discount_price ?? ""; })
                  ->addColumn('division', function($row){ return $row->order->shipping->division ?? ""; })
                  ->addColumn('shipping_address_details', function($row){ return $row->order->shipping_address_details ?? ""; })
                  ->addColumn('created_at', function($row){ return $row->order->created_at ?? ""; })
                  ->addColumn('status', function($row){ return $row->order->status; })
                  ->addColumn('action', function($row){
                      $admin = Admin::find(Auth::user()->id);
                      if($admin->hasPermissionTo('Order delete')){
                          $deleteBtn = '<a href="'.route('admin.products.delete', $row->id).'" class="btn btn-danger btn-sm" data-confirm-delete="true">Cancel</a>';
                          
                      }
                      return $deleteBtn;
                      
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
