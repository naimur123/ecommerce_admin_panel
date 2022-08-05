<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, $id){
        $find = User::find($id);
        if(!empty($find)){
            $params = [
               "user" => $find
            ];
            return view('frontend.user.dashboard');
        }
        else{
            return redirect()->back();
        }
        
    }
}
