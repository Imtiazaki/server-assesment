<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoringResource extends JsonResource
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
            'modul' => $this->kursus,
            'idModul' => $this->idModul,
            'metode_penilaian' => $this->metode_penilaian,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
