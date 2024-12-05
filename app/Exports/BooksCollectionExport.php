<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Status;
use App\Models\Subscriber;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksCollectionExport implements FromCollection, WithHeadings, WithMapping
{

    public $fromDate;
    public $toDate;



    public function  __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function headings(): array
    {
        return [
            "Book ID",
            "Book Name",
            "Level",
            "Submitted By",
            "Date/Time",
            "Telephone",
            "Email",
            "Address",
            "Google Maps Address",
            "Cordinates",
            "Status",
            "Swap Status",
            "Collection Rider",
            "Updated At"
        ];
    }

    public function map($row): array
    {

        return [
            $row->id,
            $row->book_name,
            $row->level_name,
            $row->created_by_name,
            Carbon::parse($row->created_at)->format('Y-m-d H:i:s'),
            $row->created_by_telephone,
            $row->created_by_email,
            $row->address,
            $row->maps_address,
            $row->coordinates,
            $row->status_name,
            $row->swap_status_name,
            $row->collection_rider_name,
            Carbon::parse($row->updated_at)->format('Y-m-d H:i:s'), // Format the date as 'Y-m-d H:i:s'

        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {


        return  Book::query()
            ->where([
                ['books.created_at', '>=',  Carbon::parse($this->fromDate)->format('Y-m-d')],
                ['books.created_at', '<',  Carbon::parse($this->toDate)->addDays(1)->format('Y-m-d')],
            ])->get();
    }
}
