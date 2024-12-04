<?php

namespace App\Http\Controllers;

use App\Exports\BooksCollectionExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        return view('report.index');
    }


    public function bookReport()
    {
        return view('report.book_report');
    }


    public function collectionReportProcess(Request $request)
    {


        return Excel::download(new BooksCollectionExport(
            $request['from_date'],
            $request['to_date'],
        ), 'book_collections_report.csv');
    }
}
