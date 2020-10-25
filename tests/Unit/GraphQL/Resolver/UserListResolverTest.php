<?php


namespace App\Tests\GraphQL\Resolver;


use App\Entity\User;
use App\GraphQL\Resolver\UserListResolver;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\TestCase;

class UserListResolverTest extends TestCase {

    public function testResolve_withoutArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserListResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument());
    }

    public function testResolve_withoutOrderByArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserListResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument([
            'order'  => 'asc',
            'limit'  => 20,
            'offset' => 0,
        ]));
    }

    public function testResolve_withoutOrderArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserListResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument([
            'order_by' => 'id',
            'limit'    => 20,
            'offset'   => 0,
        ]));
    }

    public function testResolve_withoutLimitArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserListResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument([
            'order_by' => 'id',
            'order'    => 'asc',
            'offset'   => 0,
        ]));
    }

    public function testResolve_withoutOffsetArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserListResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument([
            'order_by' => 'id',
            'order'    => 'asc',
            'limit'    => 20,
        ]));
    }

    public function testResolve_withAllArguments_shouldReturnUserList(): void {

        $users = [
            (new User())->setUsername('batman'),
            (new User())->setUsername('robin'),
        ];


        $repositoryMock = $this->createMock(UserRepository::class);

        $repositoryMock->expects($this->once())
                       ->method("findBy")
                       ->willReturn($users);


        $entityManagerMock = $this->createMock(EntityManager::class);

        $entityManagerMock->method("getRepository")
                          ->with(User::class)
                          ->willReturn($repositoryMock);
        $resolver = new UserListResolver($entityManagerMock);

        $result = $resolver->resolve(new Argument([
            'order_by' => 'id',
            'order'    => 'asc',
            'limit'    => 20,
            'offset'   => 0,
        ]));

        $this->assertEquals(['users' => $users], $result);
    }

    public function testGetAliases_shouldReturnAliases(): void {
        $excpected = [
            'resolve' => 'UserList',
        ];

        $this->assertEquals($excpected, UserListResolver::getAliases());
    }

}
