<?php
namespace App\Models;
use Illuminate\Support\Facades\Http;

/**
 * Class Product
 * @package App\Models
 */
class Product
{
    /**
     * Gets last page and total records
     * @param $perPage
     * @return array
     */
    public static function pageInfo( $perPage ):array {
        $total = count( self::all() );
        $lastPage = floor( $total/$perPage );
        return ['lastPage' => $lastPage, 'total' => $total];
    }

    /**
     * Gets products by page
     * @param $page
     * @param $count
     * @param $total
     * @return array
     */
    public static function getByPage( $page, $count, $total ): array {
        $paginated = [];
        $all = self::all();
        $first = ( $page - 1 ) * $count;
        $last = $page * $count - 1;
        if ( ( $first < 0 || $first > $total ) )
            return [];
        if ( ( $last < 0 || $last > $total ) )
            return [];
        for ( $i = $first; $i <= $last; $i++ )
            $paginated[] = $all[$i];
        return $paginated;
    }

    /**
     * Gets all products from API
     * @return array
     */
    private static function all():array {
        $products = [];
        $response = Http::get( env('API_PRODUCTS_URL') );
        $rawProducts = json_decode($response->body());
        if ( !empty( $rawProducts ) )
            foreach ( $rawProducts as $rawProduct ){
                $products[] = [
                    'name' => $rawProduct->title,
                    'description' => $rawProduct->description,
                    'price' => $rawProduct->price
                ];
            }
        return $products;
    }
}
