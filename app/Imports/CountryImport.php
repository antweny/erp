<?php

namespace App\Imports;

use App\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class CountryImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading,SkipsOnFailure
{

    //private $country;

    public function _construct()
    {
        $country = new Country();
        $country->create(['id' => Uuid::uuid4()]);
    }

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        return new Country([
           'name'     => $row['name'],
       ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:countries,name',
            'desc' => 'string|nullable',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function onFailure(Failure ...$failures)
    {
        return null;
    }
}
