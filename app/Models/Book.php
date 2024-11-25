<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public static function query()
    {

        return self::select([
            'books.*',
            'book_inventories.book_name',
            'book_inventories.front_photo AS front_photo',
            'book_inventories.back_photo AS back_photo',
            'book_inventories.required_points',
            'book_levels.level_name',
            'book_levels.id as level_id',
            'book_statuses.status_name',
            'book_statuses.color_code as status_color_code',
            'swap_statuses.swap_status_name',
            'swap_statuses.color_code as swap_status_color_code',
            'book_editions.edition_name',
            'users.name as created_by_name',
            'users.telephone as created_by_telephone',
        ])
            ->leftJoin('book_inventories', 'books.book_id', 'book_inventories.id')
            ->leftJoin('book_levels', 'book_inventories.level_id', 'book_levels.id')
            ->leftJoin('book_editions', 'book_inventories.edition_id', 'book_editions.id')
            ->leftJoin('book_statuses', 'books.status_id', 'book_statuses.id')
            ->leftJoin('swap_statuses', 'books.swap_status_id', 'swap_statuses.id')
            ->leftJoin('users', 'books.created_by', 'users.id');
    }

    public static function getUserBooks($userID)
    {
        return self::query()->where('books.created_by', $userID)->get();
    }


    public static function getBooksByLevel($levelID)
    {
        return self::query()->where('level_id', $levelID)->take(5)->get();
    }


    public static function getBookByID($bookID)
    {
        return self::query()->where('books.id', $bookID)->first();
    }

    public static function getLatestBooks()
    {
        return self::query()->where('books.status_id', BookStatus::APPROVED)->take(20)->get();
    }

    public static function getBookByLevelID($levelID)
    {
        return self::query()->where('books.status_id', BookStatus::APPROVED)->where('level_id', $levelID)->get();
    }

    public static function getRecentBooks()
    {
        return self::query()->where('books.status_id', BookStatus::APPROVED)->orderBy('books.id', 'DESC')->get();
    }

    public static function getPendingCollectionBooks()
    {
        return self::query()->where('books.status_id', BookStatus::PENDING_PICKUP_APPROVAL)->get();
    }

    public static function getPendingDeliveryBooks()
    {
        return self::query()->where('books.status_id', BookStatus::PENDING_DELIVERY)->get();
    }
}
