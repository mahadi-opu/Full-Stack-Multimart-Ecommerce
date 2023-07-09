<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' =>$this->product_id,
            'product_name'=>$this->productInfo->name,
            'sale_quantity'=>$this->sale_quantity,
            'sell_id'=>$this->sell_id,
            'status'=>$this->status,
            'total_discount'=>$this->total_discount,
            'total_payable_amount'=>$this->total_payable_amount,
            'unit_product_cost'=>$this->unit_product_cost,
            'unit_sell_price'=>$this->unit_sell_price,
            'unit_vat'=>$this->unit_vat,
        ];
    }
}
