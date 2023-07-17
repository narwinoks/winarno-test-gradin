<?php

namespace App\Http\Resources\Courier;

use App\Http\Resources\Default\CreatedAtResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierRespource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'noTelp' => $this->telp,
            'city' => $this->city,
            'level' => $this->level,
            'created_at' => new CreatedAtResource($this->created_at),

        ];
    }
}
