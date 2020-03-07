<?php

namespace App\Imports;

use App\Individual;
use App\City;
use App\District;
use App\Street;
use App\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class IndividualsImport implements ToModel,WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading
{

   /**
    * @param array $row
    */
    public function model(array $row)
    {
        $individual = new Individual();
        $individual->create([
            //'id' => Uuid::uuid4(),
            'full_name' => $row['full_name'],
            'gender' => $row['gender'],
            'mobile' => $row['mobile'],
            'age_group' => $row['age_group'],
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
            'full_name' => ['required','string','max:100'],
            'gender' => ['string','max:3','nullable'],
            'mobile' => ['nullable','numeric'],
            'age_group' => ['nullable','string'],
            'district' => ['string','nullable'],
            'city' => ['string','nullable'],
            //'email' => ['nullable','email','max:100','unique:individuals'],
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
    public function check_street($request)
    {
        $name = new Street();
        return $name->get_id($request);
    }

}

