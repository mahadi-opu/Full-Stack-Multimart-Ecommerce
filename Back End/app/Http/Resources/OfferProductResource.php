<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->productInfo->id,
            'name' => $this->productInfo->name,
            'category_id' => $this->productInfo->category_id,
            'subcategory_id' => $this->productInfo->subcategory_id,
            'image_path' => $this->productInfo->image_path,
            'supplier_id' => $this->productInfo->supplier_id,
            'code' => $this->productInfo->code,
            'brand_id' => $this->productInfo->brand_id,
            'current_sale_price' => round($this->productInfo->current_sale_price),
            'current_purchase_cost' => $this->productInfo->current_purchase_cost,
            'current_wholesale_price' => $this->productInfo->current_wholesale_price,
            'wholesale_minimum_qty' => $this->productInfo->wholesale_minimum_qty,
            'previous_wholesale_price' => $this->productInfo->previous_wholesale_price,
            'previous_sale_price' => $this->productInfo->previous_sale_price,
            'previous_purchase_cost' => $this->productInfo->previous_purchase_cost,
            'available_quantity' => $this->productInfo->available_quantity,
            'discount_type' => $this->productInfo->discount_type,
            'offer_amount'=>$this->offer_amount,
            'offer_type'=>$this->offer_type,
            'discount' => $this->productInfo->discount,
            'unit_type' => $this->productInfo->unit_type,
            'description' => $this->productInfo->description,
            'is_popular' => $this->productInfo->is_popular,
            'is_trending' => $this->productInfo->is_trending,
            'category_info'=> new ProductCategoryResource($this->productInfo->productCategory),
            'sub_category_info'=>new ProductSubCategoryResource($this->productInfo->productSubcategory),
            'status' => $this->productInfo->status,
            'created_at' => $this->productInfo->created_at,
            'created_by' => $this->productInfo->created_by,
            'updated_at' => $this->productInfo->updated_at,
            'updated_by' => $this->productInfo->updated_by,
            'deleted' => $this->productInfo->deleted,
            'deleted_at' => $this->productInfo->deleted_at,
            'deleted_by' => $this->productInfo->deleted_by,
        ];
    }
}
