<?php

namespace App\Imports;

use App\Models\Catechumene;
use Maatwebsite\Excel\Concerns\ToModel;

class CatechumenesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Catechumene([
            //
        ]);
    }
}
