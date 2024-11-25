<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static function query()
    {
        return self::leftJoin('books', 'orders.book_id', 'books.id')
            ->leftJoin('book_inventories', 'books.book_id', 'book_inventories.id')
            ->leftJoin('book_levels', 'book_inventories.level_id', 'book_levels.id')
            ->leftJoin('book_editions', 'book_inventories.edition_id', 'book_editions.id')
            ->leftJoin('book_statuses', 'book_inventories.status_id', 'book_statuses.id')
            ->leftJoin('order_statuses', 'orders.order_status', 'order_statuses.id')
            ->leftJoin('users', 'orders.user_id', 'users.id');
    }



    public static function getUserOrders($userID)
    {
        return self::query()
            ->where('orders.user_id', $userID)
            ->get([
                'books.*',
                'book_inventories.book_name',
                'book_levels.level_name',
                'book_editions.edition_name',
                'order_statuses.order_status_name',

            ]);
    }


    public static function getPendingOrders()
    {
        return self::query()->where('orders.order_status', OrderStatus::PENDING)->get([
            'orders.*',
            'book_inventories.book_name',
            'book_inventories.front_photo',
            'book_inventories.back_photo',
            'book_levels.level_name',
            'book_editions.edition_name',
            'order_statuses.order_status_name',
            'order_statuses.color_code AS order_status_color_code',
            'users.name AS order_by_name'
        ]);
    }
}
