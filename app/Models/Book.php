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
            // 'book_editions.edition_name',
            'CREATED_BY_USER_JOIN.name as created_by_name',
            'CREATED_BY_USER_JOIN.email as created_by_email',
            'COLLECTION_RIDER_USER_JOIN.name as collection_rider_name',
            'CREATED_BY_USER_JOIN.telephone as created_by_telephone',
            'book_conditions.condition_name',
        ])
            ->leftJoin('book_inventories', 'books.book_id', 'book_inventories.id')
            ->leftJoin('book_levels', 'books.book_level_id', 'book_levels.id')
            // ->leftJoin('book_editions', 'book_inventories.edition_id', 'book_editions.id')
            ->leftJoin('book_statuses', 'books.status_id', 'book_statuses.id')
            ->leftJoin('book_conditions', 'books.condition_id', 'book_conditions.id')
            ->leftJoin('swap_statuses', 'books.swap_status_id', 'swap_statuses.id')
            ->leftJoin('users AS CREATED_BY_USER_JOIN', 'books.created_by', 'CREATED_BY_USER_JOIN.id')
            ->leftJoin('users AS COLLECTION_RIDER_USER_JOIN', 'books.collection_rider_id', '=', 'COLLECTION_RIDER_USER_JOIN.id');
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
        return self::query()
            ->whereIn('books.status_id', [BookStatus::APPROVED, BookStatus::APPROVED_NOT_COLLECTED])
            ->orderBy('books.id', 'DESC')
            ->paginate(16);
    }

    public static function getBookByLevelID($levelID)
    {
        return self::query()->wherein('books.status_id', [BookStatus::APPROVED, BookStatus::APPROVED_NOT_COLLECTED])
            ->where('level_id', $levelID)
            ->get();
    }

    public static function getRecentBooks()
    {
        return self::query()->whereIn('books.status_id', [BookStatus::APPROVED, BookStatus::APPROVED_NOT_COLLECTED])
            ->orderBy('books.id', 'DESC')
            ->paginate(16);
    }

    public static function getPendingCollectionBooks()
    {
        return self::query()->where('books.status_id', BookStatus::PENDING_PICKUP_APPROVAL)
            ->paginate(30);
    }

    public static function getPendingDeliveryBooks()
    {
        return self::query()->where('books.status_id', BookStatus::PENDING_DELIVERY)
            ->get();
    }
}
