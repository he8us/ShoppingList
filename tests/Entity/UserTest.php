<?php


namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    private $object;

    protected function setUp(): void {
        $this->object = new User();
    }

    public function testIdGetter_shouldReturnNull(): void {
        $this->assertNull($this->object->getId());
    }

    public function testUsernameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setUsername("superman");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("superman", $this->object->getUsername());
    }

    public function testFirstnameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setFirstname("Clark");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("Clark", $this->object->getFirstname());
    }

    public function testLastnameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setLastname("Kent");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("Kent", $this->object->getLastname());
    }

    public function testRolesGetter_withoutAnyRole_shouldReturnUserRole(): void {
        $this->assertEquals([
            'ROLE_USER',
        ], $this->object->getRoles());
    }

    public function testRolesFluentSetterGetter_shouldReturnCorrectRoles(): void {
        $ref = $this->object->setRoles([
            'ROLE_SUPERHERO',
        ]);

        $this->assertEquals($ref, $this->object);
        $this->assertEquals([
            'ROLE_SUPERHERO',
            'ROLE_USER',
        ], $this->object->getRoles());
    }

    public function testPasswordFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setPassword('12345');

        $this->assertEquals($ref, $this->object);
        $this->assertEquals('12345', $this->object->getPassword());
    }

    public function testEmailFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setEmail('clark@dailyplanet.com');

        $this->assertEquals($ref, $this->object);
        $this->assertEquals('clark@dailyplanet.com', $this->object->getEmail());
    }

    public function testSaltGetter_shouldReturnNull(): void {
        $this->assertNull($this->object->getSalt());
    }

    public function testEraseCredentials_shouldReturnNull(): void {
        $this->assertNull($this->object->eraseCredentials());
    }

    public function testWaiEnabled_shouldDefaultedFalse(): void {
        $this->assertEquals(false, $this->object->getWaiEnabled());
    }

    public function testWaiEnabledFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->object->setWaiEnabled(true);

        $this->assertEquals($ref, $this->object);
        $this->assertEquals(true, $this->object->getWaiEnabled());
    }

}
