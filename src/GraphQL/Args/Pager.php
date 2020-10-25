<?php


namespace App\GraphQL\Args;

use Overblog\GraphQLBundle\Definition\Builder\MappingInterface;

class Pager implements MappingInterface {

    protected const ASC = "asc";
    protected const DESC = "desc";

    public function toMappingDefinition(array $config): array {
        $defaultOrder   = isset($config['defaultOrder']) ? (int)$config['defaultOrder'] : self::ASC;
        $defaultOrderBy = isset($config['defaultOrderBy']) ? (int)$config['defaultOrderBy'] : 'id';
        $defaultLimit   = isset($config['defaultLimit']) ? (int)$config['defaultLimit'] : 20;

        return [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => $defaultOrder,
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => $defaultOrderBy,
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => $defaultLimit,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];
    }

}
