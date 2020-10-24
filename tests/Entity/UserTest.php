<?php


namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    private $object;

    protected function setUp() {
        $this->object = new User();
    }

    public function testIdGetter() {
        $this->assertNull($this->object->getId());
    }

    public function testUsernameFluentSetterGetter() {
        $ref = $this->object->setUsername("superman");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("superman", $this->object->getUsername());
    }

    public function testFirstnameFluentSetterGetter() {
        $ref = $this->object->setFirstname("Clark");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("Clark", $this->object->getFirstname());
    }

    public function testLastnameFluentSetterGetter() {
        $ref = $this->object->setLastname("Kent");

        $this->assertEquals($ref, $this->object);
        $this->assertEquals("Kent", $this->object->getLastname());
    }

    public function testRolesShouldBeAtLeastUser() {
        $this->assertEquals([
            'ROLE_USER',
        ], $this->object->getRoles());
    }

    public function testRolesFluentSetterGetter() {
        $ref = $this->object->setRoles([
            'ROLE_SUPERHERO',
        ]);

        $this->assertEquals($ref, $this->object);
        $this->assertEquals([
            'ROLE_SUPERHERO',
            'ROLE_USER',
        ], $this->object->getRoles());
    }

    public function testPasswordFluentSetterGetter() {
        $ref = $this->object->setPassword('12345');

        $this->assertEquals($ref, $this->object);
        $this->assertEquals('12345', $this->object->getPassword());
    }

    public function testEmailFluentSetterGetter() {
        $ref = $this->object->setEmail('clark@dailyplanet.com');

        $this->assertEquals($ref, $this->object);
        $this->assertEquals('clark@dailyplanet.com', $this->object->getEmail());
    }

    public function testSaltGetter() {
        $this->assertNull($this->object->getSalt());
    }

    public function testEraseCredentials() {
        $this->assertNull($this->object->eraseCredentials());
    }

    public function testWaiEnabledDefaultFalse() {
        $this->assertEquals(false, $this->object->getWaiEnabled());
    }

    public function testWaiEnabledFluentSetterGetter() {
        $ref = $this->object->setWaiEnabled(true);

        $this->assertEquals($ref, $this->object);
        $this->assertEquals(true, $this->object->getWaiEnabled());
    }

}
