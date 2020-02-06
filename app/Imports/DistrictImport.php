<?php

namespace App\Imports;

use App\City;
use App\District;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class DistrictImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $district = new District();

        $district->create([
            'id' => Uuid::uuid4(),
            'name'     => $row['name'],
            'city_id' => $this->check($row['region'])
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:districts,name',
            'city_id' => 'nullable',
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
    public function check($request)
    {
        $name = new City();
        return $name->get_id($request);
    }

}
