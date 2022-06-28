<?php

namespace App\Http\Components\Traits;

trait Message{
    
    protected $status = false;
    protected $message = '';   
    protected $reset = false; 
    protected $modal = false;
    protected $table = false;    
    protected $button = false;
    protected $api_token = "";
    protected $data = [];
    

    /**
     * Return Default Output Message
     * This Method for web JSON Response
     */
    protected function output(){
        return [ 
            'status' => $this->status,
            'message' => $this->message,
            'reset' => $this->reset,
            'table' => $this->table,
            'modal' => $this->modal,
            'button' => $this->button
        ];
    }

    /**
     *  Success  Function Set the Value as Success
     * This Method for Web Success Message
     */
    protected function success( $smg = null, $reset = true, $modal = true, $table = true, $button = false){
        $this->status = true;
        $this->message = $smg == null ? ( $this->message ?? 'Information Save Successfully') : $smg ;
        $this->reset = $reset;
        $this->modal = $modal;
        $this->table = $table;
        $this->button = $button;
    }

    /**
     * Success  Function For API
     * Set api response status as Success
     * This Method is responsible all API Response
     */
    protected function apiSuccess($message = Null, $data = Null){
        $this->status = true;
        $this->message = !empty($message) ? ( $this->message ?? $message ) : 'Successfully';
        $this->data = $data;
    }

    /**
     * Return Default API Output Message
     * This Method for API Response
     */
    protected function apiOutput($status_code = 200){
        $content = [
            'status'    => $this->status,
            'message'   => $this->message,
            'api_token' => $this->api_token,
            'data'      => $this->data
        ];
        if(empty($this->api_token)){
            unset($content["api_token"]);
        }
        return response($content, $status_code);
    }

    /**
     * Get Error Message
     * If Application Environtment is local then
     * Return Error Message With filename and Line Number
     * else return a Simple Error Message
     */
    protected function getError($e = null){
        if( !empty($e) ){
            return $e->getMessage() . ' On File ' . $e->getFile() . ' on line ' . $e->getLine();
        }
        return 'Something went wrong!';
    }

    

    /**
     * Get Validation Error
     */
    public function getValidationError($validator){
        return $validator->errors()->first();
    }

    /**
     * Access Denied Message
     */
    protected function accessDenie(){
        $this->message = "You have no permission to access this page";
        $this->modal = false;
        return $this->output();
    }
}