<?php

namespace App\Imports;

use App\Models\Complain;
use App\Models\ComplainType;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportComplains implements ToModel, WithHeadingRow
{
    private $complains;
    public function __construct()
    {
        $this->complains = Complain::select('id')->get();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // $complain_type = ComplainType::where('id', $row['complain_type_id'])->first();
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']);
        //$date = date('Y-m-d', strtotime(str_replace('-', '/', $row['date'])));
        //dd($date);
        $complain_type = $this->complains->where('id', $row['complain_type_id'])->first();
        //$new = $complain_type->id;
       // dd($new);
        return new Complain([
            'complain_type_id'     => $complain_type->id ?? NULL,
            'source_id'    => $row['source_id'],
            'complain_by'    => $row['complain_by'],
            'phone'    => $row['phone'],
            'description'    => $row['description'],
            'action_taken'    => $row['action_taken'],
            'assigned'    => $row['assigned'],
            'note'    => $row['note'],
            'date'    => $date,
        ]);
    }
}
