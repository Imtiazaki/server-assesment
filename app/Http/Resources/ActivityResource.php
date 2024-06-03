<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,   
            'email' => $this->email,
            'nama' => $this->nama,
            'module' => $this->module,
            'sudah_mulai' => $this->sudah_mulai,
            'sudah_selesai' => $this->sudah_selesai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
