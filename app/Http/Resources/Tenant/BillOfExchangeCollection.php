<?php

namespace App\Http\Resources\Tenant;

use App\Models\Tenant\BillOfExchangeDocument;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

/**
 * Class SaleNoteCollection
 *
 * @package App\Http\Resources\Tenant
 */
class BillOfExchangeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($row, $key) {
            $documents = BillOfExchangeDocument::where('bill_of_exchange_id', $row->id)->get()
            ->transform(function($row){
                $document = $row->document;
                return [
                    "number_full" => $document ? $document->number_full : "-", 
                ];
            })
            ;
            $payments = $row->payments->sum('payment');
            $total =  $row->total - $payments;
            return [
                'documents' => $documents,
                'id' => $row->id,
                'date_of_due' => Carbon::parse($row->date_of_due)->format('Y-m-d'),
                'number' => $row->number,
                'customer_name' => $row->customer->name,
                'customer_number' => $row->customer->number,
                'series' => $row->series,
                'full_number' => $row->series.'-'.$row->number,
                'establishment' => $row->establishment,
                'establishment_id' => $row->establishment_id,
                'user' => $row->user,
                'total' => $total,
                'currency_type_id' => 'PEN',
            ];
        });
    }
}
