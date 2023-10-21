<?php

namespace App\Http\Controllers\Tenant;

use Exception;
use Illuminate\Http\Request;
use App\Models\Tenant\UnitMeasure;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Catalogs\UnitType;
use App\Http\Requests\Tenant\UnitTypeRequest;
use App\Http\Resources\Tenant\UnitTypeResource;
use App\Http\Resources\Tenant\UnitTypeCollection;
use App\Http\Resources\Tenant\UnitMeasureCollection;

class UnitTypeController extends Controller
{
    public function records()
    {
        $records = UnitType::all();

        return new UnitTypeCollection($records);
    }
    public function tables(Request $request)
    {
        $unitmeasure = UnitMeasure::where('description', 'like', "%{$request->input}%")->take(20)->get();
        return compact('unitmeasure');
    }
    public function record($id)
    {
        $record = new UnitTypeResource(UnitType::findOrFail($id));

        return $record;
    }

    public function show_symbol($id)
    {
        $record = UnitType::findOrFail($id);
        $record->show_symbol = !$record->show_symbol;
        $record->save();
        return [
            'success' => true,
            'message' => 'Unidad editada con éxito'
        ];
    }
    public function store(UnitTypeRequest $request)
    {
        $id = $request->input('id');
        $unit_type = UnitType::firstOrNew(['id' => $id]);
        $unit_type->fill($request->all());
        $unit_type->save();

        return [
            'success' => true,
            'message' => ($id) ? 'Unidad editada con éxito' : 'Unidad registrada con éxito'
        ];
    }

    public function destroy($id)
    {
        try {

            $record = UnitType::findOrFail($id);
            $record->delete();

            return [
                'success' => true,
                'message' => 'Unidad eliminada con éxito'
            ];
        } catch (Exception $e) {

            return ($e->getCode() == '23000') ? ['success' => false, 'message' => 'La unidad esta siendo usada por otros registros, no puede eliminar'] : ['success' => false, 'message' => 'Error inesperado, no se pudo eliminar la unidad'];
        }
    }
}
