<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'image_path' => $this->image_path,
            'supplier_id' => $this->supplier_id,
            'code' => $this->code,
            'color' => $this->color,
            'size' => $this->size,
            'brand_id' => $this->brand_id,
            'current_sale_price' => round($this->current_sale_price) ,
            'current_purchase_cost' => $this->current_purchase_cost,
            'current_wholesale_price' => $this->current_wholesale_price,
            'wholesale_minimum_qty' => $this->wholesale_minimum_qty,
            'previous_wholesale_price' => $this->previous_wholesale_price,
            'previous_sale_price' => $this->previous_sale_price,
            'previous_purchase_cost' => $this->previous_purchase_cost,
            'available_quantity' => $this->available_quantity,
            'discount_type' => $this->discount_type,
            'discount' => $this->discount,
            'unit_type' => $this->unit_type,
            'description' => $this->description,
            'offer_amount'=>0,
            'offer_type'=>0,
            'is_popular' => $this->is_popular,
            'is_trending' => $this->is_trending,
            'category_info'=> new ProductCategoryResource($this->productCategory),
            'sub_category_info'=>new ProductSubCategoryResource($this->productSubcategory),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ];
    }
}
