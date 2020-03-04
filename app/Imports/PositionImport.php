<?php

namespace App\Imports;

use App\City;
use App\District;
use App\Individual;
use App\Organization;
use App\position;
use App\Street;
use App\Title;
use App\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Ramsey\Uuid\Uuid;

class PositionImport implements  ToModel,WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $position = new Position();
        $position->create([
            'id' => Uuid::uuid4(),
            'individual_id' => $this->individual($row['full_name'],$row['mobile']),
            'city_id' => $this->city($row['region']),
            'district_id' => $this->district($row['district']),
            'ward_id' => $this->ward($row['ward']),
            'title_id' => $this->title($row['title']),
            'organization_id' => $this->organization($row['organization']),
        ]);
    }

    /*
    * Sometimes you might want to validate each row before it's inserted into the database.
    * By implementing the WithValidation concern, you can indicate the rules that each row need to adhere to.
    */
    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'organization' => 'required',
            'region' => 'nullable|string|max:255',
            'district'=>'nullable|string|max:255',
            'ward'=>'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
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
    public function city($request)
    {
        $name = new City();
        return $name->get_id($request);

    }
    public function district($request)
    {
        $name = new District();
        return $name->get_id($request);
    }
    public function ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);

    }
    public function street($request)
    {
        $name = new Street();
        return $name->get_id($request);
    }
    public function title($request)
    {
        $name = new Title();
        return $name->get_id($request);
    }
    public function organization($request)
    {
        $name = new Organization();
        return $name->get_id($request);
    }

    public function individual($name,$mobile)
    {
        $data = new Individual();
        $query  = $data->where('full_name',$name)->where('mobile',$mobile)->first();
        if (is_null($query)) {
            $query = $data->create([
                'full_name' => $name,
                'mobile' => $mobile,
            ]);
            return $query->id;
        }
        else {
            return  $query->id;
        }
    }
}
