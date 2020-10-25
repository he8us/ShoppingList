<?php


namespace App\Tests\GraphQL\Args;


use App\GraphQL\Args\Pager;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PagerTest extends TestCase {

    private $pager;

    protected function setUp() {
        $this->pager = new Pager();
    }

    public function testMappingDefinition_withoutConfig(): void {
        $expected = [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => 'asc',
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => 'id',
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => 20,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];

        $this->assertEquals($expected, $this->pager->toMappingDefinition([]));
    }

    public function testMappingDefinition_withOrderConfig(): void {
        $expected = [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => 'desc',
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => 'id',
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => 20,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrder' => 'desc',
        ]));
    }

    public function testMappingDefinition_withOrderByConfig(): void {
        $expected = [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => 'asc',
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => 'name',
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => 20,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrderBy' => 'name',
        ]));
    }

    public function testMappingDefinition_withLimitConfig(): void {
        $expected = [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => 'asc',
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => 'id',
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => 10,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultLimit' => 10,
        ]));
    }

    public function testMappingDefinition_withAllConfig(): void {
        $expected = [
            'order'    => [
                'type'         => 'OrderDirection',
                'defaultValue' => 'desc',
                'description'  => 'order direction',
            ],
            'order_by' => [
                'type'         => 'String',
                'defaultValue' => 'name',
                'description'  => 'The field on which we should order',
            ],
            'limit'    => [
                'type'         => 'Int',
                'defaultValue' => 10,
                'description'  => 'The limit the number of results',
            ],
            'offset'   => [
                'type'         => 'Int',
                'defaultValue' => 0,
            ],
        ];

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrder'   => "desc",
            'defaultOrderBy' => "name",
            'defaultLimit'   => 10,
        ]));
    }

    public function testMappingDefinition_withIncorrectOrderConfig(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->pager->toMappingDefinition([
            'defaultOrder' => 'foo',
        ]);
    }

}
