<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderListResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'invoice_id' => $this->invoice_id,
            'sell_type' => $this->sell_type,
            'sell_by' => $this->sell_by,
            'bank_id' => $this->bank_id,
            'total_discount' => $this->total_discount,
            'total_payable_amount' => $this->total_payable_amount,
            'total_paid' => $this->total_paid,
            'total_due' => $this->total_due,
            'payment_type' => $this->payment_type,
            'order_status' => $this->order_status,
            'date' => $this->date,
            'date_format' => date('d-M-y', strtotime($this->date)),

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
