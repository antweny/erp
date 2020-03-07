<?php

namespace App\Imports;

use App\Publication;
use App\Publisher;
use App\Author;
use App\Shelf;
use App\Genre;
use App\PublicationCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PublicationImport implements ToModel,WithValidation, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $publication = new Publication();
        $publication->create([
            'title' => $row['title'],
            'year' => $row['year'],
            'public_category_id' => $this->category($row['category']),
            'author_id' => $this->author($row['author']),
            'publisher_id' => $this->publisher($row['publisher']),
            'class_number' => $row['class_number'],
            'shelf_id' => $this->shelf($row['shelf']),
            'genre_id' => $this->genre($row['genre']),
        ]);
    }

    /*
    * Sometimes you might want to validate each row before it's inserted into the database.
    * By implementing the WithValidation concern, you can indicate the rules that each row need to adhere to.
    */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'category'=>'nullable',
            'author' => 'nullable',
            'publisher' => 'nullable',
            'shelf' => 'nullable',
            'genre' => 'nullable',
            'class_number' => 'nullable|numeric',
            'year' => 'nullable|integer',
        ];
    }

    /*
    * Importing a large file to Eloquent models
    */
    public function batchSize(): int
    {
        return 300;
    }

    /*
     * Importing a large file can have a huge impact on the memory usage, as the library will try to load the entire sheet into memory.
     */
    public function chunkSize(): int
    {
        return 300;
    }

    public function onFailure(Failure $failures)
    {
        return $failures;
    }


    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function publisher($request)
    {
        $name = new Publisher();
        return $name->get_id($request);

    }
    public function author($request)
    {
        $name = new Author();
        return $name->get_id($request);
    }
    public function category($request)
    {
        $name = new PublicationCategory();
        return $name->get_id($request);
    }
    public function shelf($request)
    {
        $name = new Shelf();
        return $name->get_id($request);
    }

    public function genre($request)
    {
        $name = new Genre();
        return $name->get_id($request);
    }

}
