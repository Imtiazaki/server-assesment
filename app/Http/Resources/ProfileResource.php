<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'token' => $this->token,
            'jenis_kelamin' => $this->jenis_kelamin,
            'jabatan' => $this->jabatan,
            'perusahaan' => $this->perusahaan,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jadwal' => $this->jadwal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
