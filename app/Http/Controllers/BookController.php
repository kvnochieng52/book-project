<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCondition;
use App\Models\BookEdition;
use App\Models\BookInventory;
use App\Models\BookLevel;
use App\Models\BookStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\SwapStatus;
use App\Models\UserBookPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class BookController extends Controller
{



    public function browse()
    {
        return view("book.browse")->with([
            'bookLevels' => BookLevel::where('is_active', 1)->get(),
            'bookInventories' => BookInventory::pluck('book_name', 'id'),
            'books' => Book::getRecentBooks(),
        ]);
    }



    public function storeBook(Request $request)
    {


        $bookNotInListCheckbox = $request['book_not_in_list_checkbox'];
        if ($bookNotInListCheckbox == 1) {

            $this->validate($request, [

                'condition' => 'required',
                'address' => 'required',
                'front_image' => 'required',
                'exchange_books' => 'required',

            ]);




            Book::insert([
                'status_id' => BookStatus::PENDING_PICKUP_APPROVAL,
                'swap_status_id' => SwapStatus::NOT_YET_SWAPPED,
                // 'front_photo' => $front_photo,
                // 'back_photo' => $back_photo,
                'book_points' => 2,
                'description' => $request['description'],
                'maps_address' => $request['autocomplete'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'coordinates' => $request['coordinates'],
                'address' => $request['address'],
                'telephone' => $request['telephone'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),

                'book_title' => $request['uploadBookTitle'],
                'manual_upload' => 1,
                'front_image' => $request['front_image'],
                'exchange_books' => $request['exchange_books'],
                'book_level_id' => $request['level'],
                'condition_id' => $request['condition'],


            ]);
        } else {


            $this->validate($request, [
                'book_title' => 'required',
                'condition' => 'required',
                'address' => 'required',
                'exchange_books' => 'required',

            ]);


            $RequiredPoints = BookInventory::where('id', $request['book_title'])->first()->required_points;

            $bookDetails = BookInventory::where('id', $request['book_title'])->first();


            Book::insert([
                'book_id' => $request['book_title'],
                'status_id' => BookStatus::PENDING_PICKUP_APPROVAL,
                'swap_status_id' => SwapStatus::NOT_YET_SWAPPED,
                // 'front_photo' => $front_photo,
                // 'back_photo' => $back_photo,
                'book_points' => $RequiredPoints,
                'description' => $request['description'],
                'maps_address' => $request['autocomplete'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'coordinates' => $request['coordinates'],
                'address' => $request['address'],
                'telephone' => $request['telephone'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),

                'book_title' => $bookDetails->book_name,
                'manual_upload' => 0,
                'front_image' => $bookDetails->front_photo,
                'exchange_books' => $request['exchange_books'],
                'book_level_id' => $bookDetails->level_id,
                'condition_id' => $request['condition'],

            ]);
        }

        // $accumulatedPoints = UserBookPoint::where('user_id', Auth::user()->id)->first()->points + $RequiredPoints;

        // UserBookPoint::where('user_id', Auth::user()->id)->update([
        //     'points' => $accumulatedPoints,
        //     'updated_by' => Auth::user()->id,
        //     'updated_at' => Carbon::now()->toDateTimeString(),
        // ]);

        return redirect("/dashboard/your-books")->with('success', 'Book Successfully Submitted. The book is PENDING FOR PICKUP & APPROVAL. Once your book is picked and approved you will earn the Eligible points then Published  for swapping.');
        // } else {
        //     return redirect("/dashboard")->with('error', 'We currently dont have this book in Inventory please try later');
        // }
    }


    public function submitBook()
    {
        return view("book.submit")->with([
            'bookLevels' => BookLevel::where('is_active', 1)->pluck('level_name', 'id'),
            'bookEditions' => BookEdition::where('is_active', 1)->pluck('edition_name', 'id'),
            'bookConditions' => BookCondition::where('is_active', 1)->pluck('condition_name', 'id'),
            'bookInventories' => BookInventory::query()->pluck('book_with_level', 'id')
        ]);
    }


    public function suggestBook(Request $request)
    {

        $bookQuery = $_GET['query'];


        $bookInventoryQuery = BookInventory::query();

        $bookInventoryQuery->where(function ($query) use ($bookQuery) {
            $query->where('book_inventories.book_name', 'like', '%' . $bookQuery . '%')
                ->orWhere('book_levels.level_name', 'like', '%' . $bookQuery . '%')
                ->orWhere('book_editions.edition_name', 'like', '%' . $bookQuery . '%');
        });

        $data = $bookInventoryQuery->take(10)->get()->toArray();

        return $data;

        //;
        // $matchingSuggestions = [];


        // foreach ($suggestions as $suggestion) {
        //     if (stripos($suggestion, $query) !== false) {
        //         $matchingSuggestions[] = $suggestion;
        //     }
        // }

        // return $matchingSuggestions;
    }


    public function redeemBook($bookID)
    {

        return view('book.redeem')->with([
            'book' => Book::getBookByID($bookID),
        ]);
    }


    public function redeemProcess(Request $request)
    {
        $userPoints = UserBookPoint::getUserPoints(Auth::user()->id);
        $book = Book::getBookByID($request['bookID']);

        if ($userPoints >= $book->required_points) {

            UserBookPoint::where('user_id', Auth::user()->id)->update([
                'points' => $userPoints - $book->required_points,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);




            Order::insert([
                'book_id' => $request['bookID'],
                'user_id' => Auth::user()->id,
                'order_status' => OrderStatus::PENDING,

                'delivery_maps_address' => $request['autocomplete'],
                'delivery_latitude' => $request['latitude'],
                'delivery_longitude' => $request['longitude'],
                'delivery_coordinates' => $request['coordinates'],
                'delivery_address' => $request['address'],
                'delivery_telephone' => $request['telephone'],

                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);


            Book::where('id', $request['bookID'])->update([
                'status_id' => BookStatus::PENDING_DELIVERY,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);


            return redirect("/dashboard/your-orders")->with('success', 'Book Successfully Ordered');
        } else {
            return redirect("/dashboard/your-orders")->with('error', 'No enough points to order the book');
        }
    }



    public function booksCheck()
    {

        return view('book.check')->with([
            'books' => BookInventory::leftJoin('book_levels', 'book_inventories.level_id', 'book_levels.id')->get()
        ]);
    }


    public function search(Request $request)
    {
        $level = $request['level'];
        $bookTitle = $request['title'];

        $bookQuery = Book::query();

        $bookQuery->where(function ($query) use ($level, $bookTitle) {
            if (!empty($bookTitle)) {
                $query->where('book_title', 'LIKE', "%{$bookTitle}%");
            }
            if (!empty($level)) {
                if (is_numeric($level)) {
                    $query->where('book_level_id', $level);
                } else {
                    $query->where('level_name', 'LIKE', "%{$level}%");
                }
            }
        });

        $bookQuery->where('books.status_id', BookStatus::APPROVED);
        $data = $bookQuery->get();

        return view('book.results')->with([
            'books' => $data,
        ]);
    }



    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480', // Accepting image files up to 20MB
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Generate a random filename and get the file extension
        $randomFilename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        // Define the destination path
        $destinationPath = public_path('manual_uploads');

        // Move the file to the destination path
        $file->move($destinationPath, $randomFilename);

        // Generate the relative file path
        $relativeFilePath = 'manual_uploads/' . $randomFilename;

        return response()->json([
            'message' => 'Image uploaded successfully!',
            'file_path' => $relativeFilePath,
        ]);
    }



    public function updateBooks(Request $request)
    {
        $books = Book::where('book_title', null)->get();
        foreach ($books as $book) {
            $bookDetails = BookInventory::where('id', $book->book_id)->first();
            Book::where('id', $book->id)->update([
                'book_title' => $bookDetails->book_name,
                'front_image' => $bookDetails->front_photo,
                'book_level_id' => $bookDetails->level_id,
            ]);

            echo $book->book_id . " ----- " . $bookDetails->book_name . "<br/>";
        }
    }



    public function autoComplete(Request $request)
    {
        $search = $request->input('q');
        $books = Book::query()->where('book_title', 'LIKE', "%{$search}%")
            ->orWhere('level_name', 'LIKE', "%{$search}%")
            ->get();

        $results = [];
        foreach ($books as $book) {
            $results[] = [
                'id' => $book->id,
                'title' => $book->book_title,
                'subtitle' => $book->level_name,
                'thumbnail' => asset($book->front_image)
            ];
        }

        return response()->json($results);
    }
}
