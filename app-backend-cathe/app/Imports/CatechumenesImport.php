<?php

namespace App\Imports;

use App\Models\Catechumene;
use Carbon\Carbon;
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
            'matricule' => str_replace('-', '', $row['matricule']),
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'contact' => $row['contact_1'],
            'niveau_catechese' => $row['niveau_catechese'],
            'classe_or_profession' => $row['classe_ou_profession'],
            'jour_cours' => strtolower(str_replace(' ', '-', $row['jour_de_cours'])),
            'annee_catechese' => $row['annee_catechese'],
            'profil' => 'JEUNE',
            'date_inscription' => Carbon::today()
        ]);
    }
}
