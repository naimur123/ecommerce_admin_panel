<?php

namespace App\Http\Components\Traits;

use DateTime;
use Exception;
use Illuminate\Support\Facades\Http;

trait Helper{

    protected function getNumber($number, $thousand_seperator = "") {
        $number = str_replace([',',"'",'-'],'',$number); 
        return number_format($number, 2, ".", $thousand_seperator);   
    }

    /**
     * Find the word is exists or Not in The String
     * @return bool
     */
    protected function wordExists($string, $word){
        if(strstr($string, $word)){
            return true;
        }
        return false;
    }

    /**
     * Generate & get HTTP Status
     */
    public function getStatus($status){
        switch($status){  
            case "1":
                return "<span class=\"badge badge-success\">Published</span>";
                break;
            case "0":
                return "<span class=\"badge badge-warning\">Unpublished</span>";
                break; 
            case 'verify':
            case 'verified':
            case 'active':
            case 'public':
            case 'running':
                return "<span class=\"badge badge-primary\">".ucwords(str_replace("_", " ", $status))."</span>";
                break;
            case 'inactive':
            case 'not_started':            
                return "<span class=\"badge badge-info\">".ucwords(str_replace("_", " ", $status))."</span>";
                break;
            case 'not_verify':
            case 'not_verified':
            case 'not_yet':
            case 'private':
            case 'cancelled';
                return "<span class=\"badge badge-warning\">".ucwords(str_replace("_", " ", $status))."</span>";
                break; 
            case 'completed':
                return "<span class=\"badge badge-success\">".ucwords(str_replace("_", " ", $status))."</span>";
                break;        
                       
            default:
                return "<span class=\"badge badge-default\">".ucwords(str_replace("_", " ", $status))."</span>";
                break;
        }
    }

    /**
    * Get Postal Code Data
    */
    protected function getResponse($url){        
        $response = Http::get($url);        
        return json_decode($response->getBody());
    }

    protected function getAllFilesFromDir($dir){
        if( is_dir($dir) ){
            $file_arr_list = [];
            if( $open_dir = opendir($dir) ){
                while( ($file = readdir($open_dir))){
                    if($file == "." || $file == ".."){
                        continue;
                    }
                    $file_arr_list[] = $dir.'/'.$file;                 
                }
                closedir($open_dir);
                return $file_arr_list;
            }
        }
        return 'Is Not Directory';
    }

    /**
     * Get Data From IP Address
     */
    protected function getDataFromIP($ip){
        try{
            $url = "http://ip-api.com/json/".$ip;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $data = json_decode(curl_exec($ch));
            return $data;
        }catch(Exception $e){            
            return Null;
        }
        
    }

    /**
     * Calculate Time Different Between Two Times
     * @return Format 1Day 2Month 28 Minuits 12Seconds
     */
    protected function getTimeDiffrent($now, $target_time){
        $d1 = new DateTime($now);
        $d2 = new DateTime($target_time);
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8
        $diffInDays    = $interval->d; //21
        $diffInMonths  = $interval->m; //4
        $diffInYears   = $interval->y; //1
        $text = "";
        $text .= $diffInYears > 0 ? $diffInYears . ' Years ' : Null;
        $text .= $diffInMonths > 0 ? $diffInMonths . ' Months ' : Null;
        $text .= $diffInDays > 0 ? $diffInDays . ' Day ' : Null;
        $text .= $diffInHours > 0 ? $diffInHours . ' Hour ' : Null;
        $text .= $diffInMinutes > 0 ? $diffInMinutes . ' Minutes ' : Null;
        $text .= $diffInSeconds > 0 ? $diffInSeconds . ' Seconds ' : Null;
        return $text;
    }
}