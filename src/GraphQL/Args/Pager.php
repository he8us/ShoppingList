<?php


namespace App\GraphQL\Args;

use InvalidArgumentException;
use Overblog\GraphQLBundle\Definition\Builder\MappingInterface;

class Pager implements MappingInterface {

    protected const ASC = "asc";
    protected const DESC = "desc";

    public function toMappingDefinition(array $config): array {
        $defaultOrder   = $this->getDefaultOrder($config);
        $defaultOrderBy = isset($config['defaultOrderBy']) ? (string)$config['defaultOrderBy'] : 'id';
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

    /**
     * @param array $config
     * @return string "asc"|"desc"
     */
    private function getDefaultOrder(array $config): string {
        $defaultOrder = self::ASC;
        if (isset($config['defaultOrder'])) {
            if ($config['defaultOrder'] !== self::DESC && $config['defaultOrder'] !== self::ASC) {
                throw new InvalidArgumentException('defaultOrder should be one of "asc" or "desc"');
            }
            $defaultOrder = $config['defaultOrder'];
        }
        return $defaultOrder;
    }

}
