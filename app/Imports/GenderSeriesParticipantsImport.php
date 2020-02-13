<?php

namespace App\Imports;

use App\GenderSeries;
use App\GenderSeriesParticipant;
use App\Individual;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class GenderSeriesParticipantsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{/**
 * @param array $row
 *
 * @return User|null
 */
    public function model(array $row)
    {
        $data = new GenderSeriesParticipant();

        $data->create([
            'id' => Uuid::uuid4(),
            'individual_id'     => $this->individualID($row['individual_name']),
            'gender_series_id' => $this->genderSeriesID($row['topic'])
        ]);

    }


    /*
     * Sometimes you might want to validate each row before it's inserted into the database.
     * By implementing the WithValidation concern, you can indicate the rules that each row need to adhere to.
     */
    public function rules(): array
    {
        return [
            'individual_name' => 'required|string',
            'topic' => 'required|string',
        ];
    }

    /*
     * Importing a large file to Eloquent models
     */
    public function batchSize(): int
    {
        return 100;
    }

    /*
     * Importing a large file can have a huge impact on the memory usage, as the library will try to load the entire sheet into memory.
     */
    public function chunkSize(): int
    {
        return 100;
    }

    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function genderSeriesID($request)
    {
        $data = new GenderSeries();
        return $data->get_id($request);
    }

    /*
    * Check if resource exist get ID if not create and get ID
    */
    public function individualID($request)
    {
        $data = new Individual();
        return $data->get_id($request);
    }

}
