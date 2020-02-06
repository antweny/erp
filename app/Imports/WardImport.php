<?php

namespace App\Imports;

use App\District;
use App\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class WardImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $ward = new Ward();

        $ward->create([
            'id' => Uuid::uuid4(),
            'name'     => $row['name'],
            'district_id' => $this->check($row['district'])
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:wards,name',
            'district_id' => 'nullable',
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
        $name = new Ward();

        return $name->get_id($request);
    }

}
