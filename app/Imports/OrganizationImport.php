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

class OrganizationImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading
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
            'email' => $row['email'],
            'website' => $row['website'],
            'contact_person' => $row['contact_person'],
            'contact_person_number' => $row['contact_person_number'],
            'district_id' => $this->check_district($row['district']),
            'city_id' => $this->check_city($row['city']),
        ]);

    }

    /*
     * Sometimes you might want to validate each row before it's inserted into the database.
     * By implementing the WithValidation concern, you can indicate the rules that each row need to adhere to.
    */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:organizations',
            'founded'=>'nullable|integer',
            'registered'=>'nullable|integer',
            'city'=>'nullable|string',
            'district'=>'nullable|string',
            'website' => 'nullable|url',
            'email'=>'nullable|email',
            'mobile' => 'nullable',
            'contact_person' => 'nullable',
            'contact_person_number' => 'nullable',
        ];
    }

    /*
     * Importing a large file to Eloquent models
     */
    public function batchSize(): int
    {
        return 250;
    }

    /*
     * Importing a large file can have a huge impact on the memory usage, as the library will try to load the entire sheet into memory.
     */
    public function chunkSize(): int
    {
        return 250;
    }


    public function onFailure(Failure $failures)
    {
        return $failures;
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
