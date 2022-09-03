<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
{
    protected $withoutFields = [];

    /**
     * Set Hidden Item 
     */
    public function hide(array $hide = []){
        $this->withoutFields = $hide;
        return $this;
    }

    /**
     * Filter Hide Items
     */
    protected function filterFields($data){
        return collect($data)->forget($this->withoutFields)->toArray();
    }

    /**
     * Collection
     */
    public static function collection($resource){
        return tap(new UserCollection($resource), function ($collection) {
            $collection->collects = __CLASS__;
        });
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->filter([
            "id"                => $this->id,
            "name"              => $this->name,
            "email"             => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "phone"             => $this->phone,
            "social_id"         => $this->social_id,
            "image"             => URL::asset($this->picture),
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
            
                      
        ]);
    }
}
