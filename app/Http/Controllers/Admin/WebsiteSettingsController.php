<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteSettingsController extends Controller
{
    //View
    public function create(Request $request){
        $params =[

            "form_url" => route('admin.website.store')
        ];
        $this->saveActivity($request, "Website page opened");
        return view('admin.website.settings',$params);
    }
}
