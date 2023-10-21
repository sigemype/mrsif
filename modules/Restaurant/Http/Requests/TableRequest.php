<?php

namespace Modules\Restaurant\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TableRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [

            'number' => [
                'required',
            ],
            'area_id' => [
                'required',
            ],
            'status_table_id' => [
                'required',
            ],
        ];
    }
}
