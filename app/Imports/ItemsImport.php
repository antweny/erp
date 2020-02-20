<?php

namespace App\Imports;

use App\Item;
use App\ItemUnit;
use App\ItemCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ItemsImport implements ToModel,WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        $item = new Item();
        $item->create([
            'name' => $row['name'],
            'min_quantity' => $row['min_quantity'],
            'quantity' => $row['quantity'],
            'item_unit_id' => $this->check_item_unit($row['unit']),
            'item_category_id' => $this->check_item_category($row['category']),
        ]);
    }

    /*
    * Sometimes you might want to validate each row before it's inserted into the database.
    * By implementing the WithValidation concern, you can indicate the rules that each row need to adhere to.
    */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:100'],
            'min_quantity' => ['integer','required'],
            'quantity' => ['integer','required'],
            'unit' => ['nullable','string'],
            'category' => ['nullable','string'],
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
    public function check_item_unit($request)
    {
        $name = new ItemUnit();
        return $name->get_id($request);

    }
    public function check_item_category($request)
    {
        $name = new ItemCategory();
        return $name->get_id($request);
    }
}
