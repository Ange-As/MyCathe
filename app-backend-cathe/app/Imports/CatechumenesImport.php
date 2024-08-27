<?php

namespace App\Imports;

use App\Models\Catechumene;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class CatechumenesImport implements ToCollection
{

    public $rows;

    public function __construct()
    {
        $this->rows = collect();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $this->rows = $rows;

        foreach ($rows as $row) {
            # code...
            var_dump($row);
        }
    }
}
