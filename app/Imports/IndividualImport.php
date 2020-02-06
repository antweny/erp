<?php

namespace App\Imports;

use App\Country;
use App\City;
use App\District;
use App\Individual;
use App\Street;
use App\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class IndividualImport implements ToModel, WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $individual = new Individual();

        $individual->create([
            'id' => Uuid::uuid4(),
            'full_name' => $row['full_name'],
            'mobile' => $row['mobile'],
            'age_group' => $row['age_group'],
            'email' => $row['email'],
            'district_id' => $this->check_district($row['district']),
            'city_id' => $this->check_city($row['city']),

        ]);
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required','string','max:100'],
            'mobile' => ['nullable','string','min:10'],
            'district' => ['string','nullable'],
            'city' => ['string','nullable'],
            'email' => ['nullable','email','max:100','unique:individuals'],
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
