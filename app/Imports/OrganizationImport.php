<?php

namespace App\Imports;

use App\Organization;
use App\City;
use App\District;
use App\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class OrganizationImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{


    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $organization = new Organization();

        $organization->create([
            'name' => $row['name'],
            'founded' => $row['founded'],
            'registered' => $row['registered'],
            'mobile' => $row['mobile'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'contact_person' => $row['contact_person'],
            'address' => $row['address'],
            'district_id' => $this->check_district($row['district']),
            'city_id' => $this->check_city($row['city']),
        ]);

    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:organizations',
            'founded'=>'nullable|integer',
            'registered'=>'nullable|integer',
            'city'=>'nullable|string',
            'district'=>'nullable|string',
            'ward'=>'nullable|string',
            'address' =>'nullable|string',
            'website' => 'nullable|url',
            'email'=>'nullable|email',
            'mobile' => 'string|nullable',
            'phone' => 'string|nullable'
        ];
    }



    public function batchSize(): int
    {
        return 250;
    }


    public function chunkSize(): int
    {
        return 250;
    }


    public function onFailure(Failure ...$failures)
    {
        return null;
    }


    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function check_city($request)
    {
        $name = new City();
        return $name->get_id($request);

    }


    public function check_district($request)
    {
        $name = new District();
        return $name->get_id($request);
    }


    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);
    }


}
