<?php

namespace Modules\Item\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ItemMigrationExport implements FromView, ShouldAutoSize
{
    use Exportable;
    protected $records;
    public function records($records)
    {
        $this->records = $records;

        return $this;
    }

    public function view(): View
    {
        return view('item::item-migration.report_excel', [
            'records' => $this->records,
        ]);
    }
}
