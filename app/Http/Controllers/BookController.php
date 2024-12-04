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
        $this->validate($request, [
            'book_title' => 'required',
            // 'level' => 'required',
            // 'edition' => 'required',
            // 'front_photo' => 'required|mimes:png,jpg,jpeg',
            // 'back_photo' => 'required|mimes:png,jpg,jpeg',
        ]);



        // if (!empty($request['book_id'])) {
        // if ($request->hasFile('front_photo') && $request->file('front_photo')->isValid()) {
        //     $photo_file = $request->file('front_photo');
        //     $photo_file_name = Str::random(30) . '.' . $photo_file->getClientOriginalExtension();
        //     $photo_file->move('uploads/photos/', $photo_file_name);
        //     $front_photo = 'uploads/photos/' . $photo_file_name;
        // }


        // if ($request->hasFile('back_photo') && $request->file('back_photo')->isValid()) {
        //     $photo_file = $request->file('back_photo');
        //     $photo_file_name = Str::random(30) . '.' . $photo_file->getClientOriginalExtension();
        //     $photo_file->move('uploads/photos/', $photo_file_name);
        //     $back_photo = 'uploads/photos/' . $photo_file_name;
        // }


        $RequiredPoints = BookInventory::where('id', $request['book_title'])->first()->required_points;

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
        ]);

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


        $level = $request['levels'];
        $bookTitle = $request['book_title'];


        $bookQuery = Book::query();

        $bookQuery->where(function ($query) use ($level, $bookTitle) {
            if (!empty($bookTitle)) {
                $query->where('books.book_id', $bookTitle);
            }
            if (!empty($level)) {
                $query->orWhere('book_levels.id', $level);
            }
        });

        $bookQuery->where('books.status_id', BookStatus::APPROVED);
        $data = $bookQuery->get();

        return view('book.results')->with([
            'books' => $data,
        ]);
    }
}
