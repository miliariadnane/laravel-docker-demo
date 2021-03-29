<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'Fist Name' => $this->firstName,
            'Last Name' => $this->lastName,
            'Email' => $this->email,
            'Phone Number' => $this->phoneNumber
        ];
    }
}
