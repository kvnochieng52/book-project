<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInventory;
use App\Models\BookStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\UserBookPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticsController extends Controller
{
    public function pendingPickup(Request $request)
    {



        return view('dashboard.logistics_manager.pending_pickup')->with([
            'pendingPickupBooks' => Book::getPendingCollectionBooks(),
        ]);
    }


    public function assignCollection($id)
    {





        $drivers = User::leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', 2)
            ->pluck('users.name', 'users.id')->toArray();


        // foreach ($drivers as $key => $driver) {
        //     $books = Book::where('collection_rider_id', $key)->where('status_id', BookStatus::PENDING_PICKUP_APPROVAL)->get();
        //     if (count($books) > 0) {
        //         if (array_key_exists($key, $drivers)) {
        //             unset($drivers[$key]);
        //         }
        //     }


        //     $orders = Order::where('delivery_rider_id', $key)->where('order_status', OrderStatus::PENDING)->get();
        //     if (count($orders) > 0) {
        //         if (array_key_exists($key, $drivers)) {
        //             unset($drivers[$key]);
        //         }
        //     }
        // }


        return view('dashboard.logistics_manager.assign_collection')->with([
            'statuses' => BookStatus::whereIn('id', [BookStatus::APPROVED, BookStatus::CANCELLED])->pluck('status_name', 'id'),
            'drivers' => $drivers,
            'bookID' => $id
        ]);
    }


    public function updateCollectionProcess(Request $request)
    {
        $this->validate($request, [
            'driver' => 'required',
        ]);


        Book::where('id', $request['bookID'])->update([
            'collection_rider_id' => $request['driver'],
            // 'collection_rider_notes' => $request['description'],
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect("/logistics/pending-pickup")->with('success', 'Book status updated');
    }



    public function pendingDelivery(Request $request)
    {



        return view('dashboard.logistics_manager.pending_delivery')->with([
            'pendingPickupBooks' => Order::getPendingOrders(),
        ]);
    }


    public function assignDelivery($id)

    {


        $drivers = User::leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', 2)
            ->pluck('users.name', 'users.id')->toArray();


        // foreach ($drivers as $key => $driver) {
        //     $books = Book::where('collection_rider_id', $key)->where('status_id', BookStatus::PENDING_PICKUP_APPROVAL)->get();
        //     if (count($books) > 0) {
        //         if (array_key_exists($key, $drivers)) {
        //             unset($drivers[$key]);
        //         }
        //     }


        //     $orders = Order::where('delivery_rider_id', $key)->where('order_status', OrderStatus::PENDING)->get();
        //     if (count($orders) > 0) {
        //         if (array_key_exists($key, $drivers)) {
        //             unset($drivers[$key]);
        //         }
        //     }
        // }


        return view('dashboard.logistics_manager.assign_delivery')->with([
            'drivers' => $drivers,
            'oredrID' => $id
        ]);
    }



    public function updateStatus($id)
    {



        return view('dashboard.logistics_manager.update_status')->with([
            'statuses' => BookStatus::whereIn('id', [BookStatus::APPROVED, BookStatus::APPROVED_NOT_COLLECTED, BookStatus::CANCELLED])->pluck('status_name', 'id'),
            'bookID' => $id
        ]);
    }



    public function updateStatusProcess(Request $request)
    {

        $this->validate($request, [
            'status' => 'required',
        ]);


        Book::where('id', $request['bookID'])->update([
            'status_id' => $request['status'],
            'logistic_manager_notes' => $request['description'],
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);


        if (
            $request['status'] == BookStatus::APPROVED
            || $request['status'] == BookStatus::APPROVED_NOT_COLLECTED
        ) {

            $book = Book::where('id', $request['bookID'])->first();

            $RequiredPoints = BookInventory::where('id', $book->book_id)->first()->required_points;

            $accumulatedPoints = UserBookPoint::where('user_id', $book->created_by)->first()->points + $RequiredPoints;

            UserBookPoint::where('user_id', $book->created_by)->update([
                'points' => $accumulatedPoints,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }


        return redirect("/logistics/pending-pickup")->with('success', 'Book status updated');
    }



    public function updateDeliveryStatusProcess(Request $request)
    {

        $this->validate($request, [
            'driver' => 'required',
        ]);

        Order::where('id', $request['orderID'])->update([
            // 'order_status' => $request['status'],
            'delivery_rider_id' => $request['driver'],
            'logistic_manager_notes' => $request['description'],
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
            'order_status' => OrderStatus::PENDING
        ]);



        $book_id = Order::where('id', $request['orderID'])->first()->book_id;

        Book::where('id', $book_id)->update([
            'status_id' => BookStatus::PENDING_DELIVERY,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect("/logistics/pending-delivery")->with('success', 'Book status updated');
    }
}
