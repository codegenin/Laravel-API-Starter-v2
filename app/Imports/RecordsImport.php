<?php

namespace App\Imports;

use App\Models\ImportRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RecordsImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts
{
    /**
     * @var
     */
    private $import;
    
    /**
     * RecordsImport constructor.
     * @param $import
     */
    public function __construct($import)
    {
        $this->import = $import;
    }
    
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ImportRecord([
            "import_id"         => $this->import->id,
            "fr_title"          => trim($row["titre_de_loeuvre_version_francaise"]),
            "en_title"          => trim($row["titre_de_loeuvre_version_anglaise"]),
            "fr_complete_title" => trim($row["titre_complet_de_loeuvreversion_francaise"]),
            "en_complete_title" => trim($row["titre_complet_de_loeuvreversion_anglaise"]),
            "artist"            => trim($row["artiste"]),
            "fr_date"           => trim($row["date_version_francaise"]),
            "en_date"           => trim($row["date_version_anglaise"]),
            "fr_location"       => trim($row["lieuversion_francaise"]),
            "en_location"       => trim($row["lieuversion_anglaise"]),
            "fr_collection"     => trim($row["nom_collection_version_francaise"]),
            "en_collection"     => trim($row["nom_collection_version_anglaise"]),
            "fr_art_medium"     => trim($row["mediumversion_francaise"]),
            "en_art_medium"     => trim($row["mediumversion_anglaise"]),
            "credit_line"       => trim($row["credit_line"]),
            "museum"            => trim($row["nom_du_musee"]),
            "url"               => trim($row["url"]),
            "image_url"         => trim($row["aws"]),
            "fr_department"     => trim($row["departement_version_francaise"]),
            "en_department"     => trim($row["departement_version_anglaise"]),
        ]);
    }
    
    public function rules(): array
    {
        return [
            "titre_de_loeuvre_version_francaise"        => 'required',
            "titre_de_loeuvre_version_anglaise"         => 'required',
            "titre_complet_de_loeuvreversion_francaise" => 'required',
            "titre_complet_de_loeuvreversion_anglaise"  => 'required',
            "artiste"                                   => 'required',
            "date_version_francaise"                    => 'required',
            "date_version_anglaise"                     => 'required',
            "lieuversion_francaise"                     => 'required',
            "lieuversion_anglaise"                      => 'required',
            "nom_collection_version_francaise"          => 'required',
            "nom_collection_version_anglaise"           => 'required',
            "mediumversion_francaise"                   => 'required',
            "mediumversion_anglaise"                    => 'required',
            "credit_line"                               => 'required',
            "nom_du_musee"                              => 'required',
            "url"                                       => 'required',
            "aws"                                       => 'required',
            "departement_version_francaise"             => 'required',
            "departement_version_anglaise"              => 'required',
        ];
    }
    
    
    public function batchSize(): int
    {
        return 10;
    }
}
