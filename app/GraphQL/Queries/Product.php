<?php
namespace App\GraphQL\Queries;
use App\Models\Product as MProduct;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

/**
 * Class Product
 * @package App\GraphQL\Queries
 */
class Product
{
    /**
     * Gets product from GraphQL request
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return iterable
     */
    public function __invoke( $root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo ):iterable {
        $currentPage = $args['page'] ?? 1;
        $perPage = $args['count'] ?? 1;
        $pageInfo = MProduct::pageInfo( $perPage );
        $data = MProduct::getByPage( $currentPage, $perPage, $pageInfo['total'] );
        return [
            'current_page' => $currentPage,
            'last_page' => $pageInfo['lastPage'],
            'per_page' => $perPage,
            'total' => $pageInfo['total'],
            'data' => $data
        ];
    }
}
