<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'produits'=> $this->produits->map(function ($produit) {
                return [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'description' => $produit->description,
                    'prix' => $produit->prix,
                    'delai_confection' => $produit->delai_confection,
                ];
            }),
            'modeles'=>ModeleResource::collection($this->modeles_stylistes),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
