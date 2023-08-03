<?php

namespace App\Http\Controllers;

use App\Http\Components\Traits\ActivityLog;
use App\Http\Components\Traits\CurrencySymbol;
use App\Http\Components\Traits\Helper;
use App\Http\Components\Traits\Message;
use App\Http\Components\Traits\Permission;
use App\Http\Components\Traits\Upload;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use CurrencySymbol, Helper, Message, Upload, ActivityLog;
    protected $index;
}
