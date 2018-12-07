<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClockInResource extends JsonResource
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
            'time_in' => $this->time_in,
            'time_out' => $this->time_out,
            'username' => $this->userIdToUsername->username
        ];
    }
}
