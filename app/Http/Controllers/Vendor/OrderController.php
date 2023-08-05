<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Get Table Column List
    private function getColumns(){
        $columns = ["index","invoice_no","product_name","order_quantity","customer_name", "code","transaction_no","price","status","action"];
        return $columns;
    }

    // Get DataTable Column List
    private function getDataTableColumns(){
        $columns = ["index","invoice_no","product_name","product_sales_quantity","customer_name","code","transaction_id","price","status","action"];
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
            'tableStyleClass'   => 'bg-success',
           
        ];
        return view('vendors.order.table', $params);
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
                  ->addColumn('product_name', function($row){ return $row->productOrdered->name; })
                  ->addColumn('customer_name', function($row){ return $row->order->user->name ?? "N/A"; })
                  ->addColumn('code', function($row){ return $row->productOrdered->code ?? "N/A"; })
                  ->addColumn('transaction_id', function($row){ return $row->order->transaction_id ?? "N/A"; })
                  ->addColumn('price', function($row){ return $row->order->amount ?? "N/A"; })
                  ->addColumn('status', function($row){ return $row->order->status ?? "N/A"; })
                  ->addColumn('action', function($row){
                      $vendor = Vendor::find(Auth::user()->id);
                      if($vendor->hasPermissionTo('Order delete')){
                          $deleteBtn = '<a href="'.route('admin.products.delete', $row->id).'" class="btn btn-danger btn-sm" data-confirm-delete="true">Cancel</a>';
                          
                      }
                      return $deleteBtn;
                      
                  })
                  ->rawColumns(['action'])
                  ->make(true);
        }
  
    }
}
