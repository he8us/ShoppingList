<?php


namespace App\Tests\GraphQL\Args;


use App\GraphQL\Args\Pager;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PagerTest extends TestCase {

    private $pager;
    private $expected;

    protected function setUp() {
        $this->pager = new Pager();

        $this->expected = [
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
    }

    public function testMappingDefinition_withoutConfig_shouldReturnConfig(): void {
        $this->assertEquals($this->expected, $this->pager->toMappingDefinition([]));
    }

    public function testMappingDefinition_withOrderConfig_shouldReturnConfig(): void {
        $expected                          = $this->expected;
        $expected['order']['defaultValue'] = 'desc';

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrder' => 'desc',
        ]));
    }

    public function testMappingDefinition_withOrderByConfig_shouldReturnConfig(): void {
        $expected                             = $this->expected;
        $expected['order_by']['defaultValue'] = 'name';

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrderBy' => 'name',
        ]));
    }

    public function testMappingDefinition_withLimitConfig_shouldReturnConfig(): void {
        $expected                          = $this->expected;
        $expected['limit']['defaultValue'] = 10;

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultLimit' => 10,
        ]));
    }

    public function testMappingDefinition_withAllConfig_shouldReturnConfig(): void {
        $expected                             = $this->expected;
        $expected['order']['defaultValue']    = 'desc';
        $expected['order_by']['defaultValue'] = 'name';
        $expected['limit']['defaultValue']    = 10;

        $this->assertEquals($expected, $this->pager->toMappingDefinition([
            'defaultOrder'   => "desc",
            'defaultOrderBy' => "name",
            'defaultLimit'   => 10,
        ]));
    }

    public function testMappingDefinition_withIncorrectOrderConfig_shouldThrowException(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->pager->toMappingDefinition([
            'defaultOrder' => 'foo',
        ]);
    }

}
