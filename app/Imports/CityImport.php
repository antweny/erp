<?php

namespace App\Imports;

use App\City;
use App\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class CityImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $city = new City();
        $city->create([
            'id' => Uuid::uuid4(),
            'name'     => $row['name'],
            'country_id' => $this->check_country($row['country'])
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:cities,name',
            'country_id' => 'integer|nullable',
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

    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function check_country($request)
    {
        $name = new Country();
        return $name->get_id($request);
    }


}
