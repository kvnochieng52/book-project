<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInventory;
use App\Models\BookStatus;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\SwapStatus;
use App\Models\User;
use App\Models\UserBookPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiderDashboardController extends Controller
{
    public function pendingPickup(Request $request)
    {
        return view('dashboard.rider.pending_pickup')->with([
            'pendingPickupBooks' => Book::query()->where('books.status_id', BookStatus::PENDING_PICKUP_APPROVAL)
                ->where('collection_rider_id', Auth::user()->id)
                ->get(),
        ]);
    }


    public function updateStatus($id)
    {
        return view('dashboard.rider.update_status')->with([
            'statuses' => BookStatus::whereIn('id', [BookStatus::APPROVED, BookStatus::CANCELLED])->pluck('status_name', 'id'),
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
            'collection_rider_id' => Auth::user()->id,
            'collection_rider_notes' => $request['description'],
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);


        if ($request['status'] == BookStatus::APPROVED) {

            $book = Book::where('id', $request['bookID'])->first();

            $RequiredPoints = BookInventory::where('id', $book->book_id)->first()->required_points;

            $accumulatedPoints = UserBookPoint::where('user_id', $book->created_by)->first()->points + $RequiredPoints;

            UserBookPoint::where('user_id', $book->created_by)->update([
                'points' => $accumulatedPoints,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        return redirect("/rider-dashboard/pending-pickup")->with('success', 'Book status updated');
    }


    public function pendingDelivery(Request $request)
    {


        return view('dashboard.rider.pending_delivery')->with([
            'pendingPickupBooks' => Order::getPendingOrders(),
        ]);
    }


    public function updateDeliveryStatus($id)
    {
        return view('dashboard.rider.update_delivery_status')->with([
            'statuses' => OrderStatus::whereIn('id', [OrderStatus::DELIVERED, OrderStatus::CANCELLED])->pluck('order_status_name', 'id'),
            'oredrID' => $id
        ]);
    }


    public function updateDeliveryStatusProcess(Request $request)
    {


        $this->validate($request, [
            'status' => 'required',
        ]);

        Order::where('id', $request['orderID'])->update([
            'order_status' => $request['status'],
            'delivery_rider_id' => Auth::user()->id,
            'delivery_rider_notes' => $request['description'],
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);



        $book_id = Order::where('id', $request['orderID'])->first()->book_id;



        $status = $request['status'] == OrderStatus::DELIVERED ? BookStatus::DELIVERED : BookStatus::CANCELLED;
        $swap_status = $request['status'] == OrderStatus::DELIVERED ? SwapStatus::SWAPPED : SwapStatus::NOT_YET_SWAPPED;


        Book::where('id', $book_id)->update([
            'status_id' => $status,
            'swap_status_id' => $swap_status,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect("/rider-dashboard/pending-delivery")->with('success', 'Book status updated');
    }
}
