<?php


namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void {
        $this->user = new User();
    }

    public function testIdGetter_shouldReturnNull(): void {
        $this->assertNull($this->user->getId());
    }

    public function testUsernameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setUsername("superman");

        $this->assertEquals($ref, $this->user);
        $this->assertEquals("superman", $this->user->getUsername());
    }

    public function testFirstnameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setFirstname("Clark");

        $this->assertEquals($ref, $this->user);
        $this->assertEquals("Clark", $this->user->getFirstname());
    }

    public function testLastnameFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setLastname("Kent");

        $this->assertEquals($ref, $this->user);
        $this->assertEquals("Kent", $this->user->getLastname());
    }

    public function testRolesGetter_withoutAnyRole_shouldReturnUserRole(): void {
        $this->assertEquals([
            'ROLE_USER',
        ], $this->user->getRoles());
    }

    public function testRolesFluentSetterGetter_shouldReturnCorrectRoles(): void {
        $ref = $this->user->setRoles([
            'ROLE_SUPERHERO',
        ]);

        $this->assertEquals($ref, $this->user);
        $this->assertEquals([
            'ROLE_SUPERHERO',
            'ROLE_USER',
        ], $this->user->getRoles());
    }

    public function testPasswordFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setPassword('12345');

        $this->assertEquals($ref, $this->user);
        $this->assertEquals('12345', $this->user->getPassword());
    }

    public function testEmailFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setEmail('clark@dailyplanet.com');

        $this->assertEquals($ref, $this->user);
        $this->assertEquals('clark@dailyplanet.com', $this->user->getEmail());
    }

    public function testSaltGetter_shouldReturnNull(): void {
        $this->assertNull($this->user->getSalt());
    }

    public function testEraseCredentials_shouldReturnNull(): void {
        $this->assertNull($this->user->eraseCredentials());
    }

    public function testWaiEnabled_shouldDefaultedFalse(): void {
        $this->assertEquals(false, $this->user->getWaiEnabled());
    }

    public function testWaiEnabledFluentSetterGetter_shouldReturnSameValue(): void {
        $ref = $this->user->setWaiEnabled(true);

        $this->assertEquals($ref, $this->user);
        $this->assertEquals(true, $this->user->getWaiEnabled());
    }

}
