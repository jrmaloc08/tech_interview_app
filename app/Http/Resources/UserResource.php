<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'username' => $this->username,
            'email'    => $this->email,
            'address'  => json_decode($this->address, true),
            'phone'    => $this->phone,
            'website'  => $this->website,
            'company'  => json_decode($this->company, true),
        ];
    }
}
