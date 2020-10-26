<?php


namespace App\Tests\GraphQL\Resolver;


use App\Entity\User;
use App\GraphQL\Resolver\UserResolver;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Overblog\GraphQLBundle\Definition\Argument;
use PHPUnit\Framework\TestCase;

class UserResolverTest extends TestCase {

    public function testResolve_withArgument_shouldReturnUser(): void {
        $user           = new User();
        $repositoryMock = $this->createMock(UserRepository::class);

        $repositoryMock->expects($this->once())
                       ->method("find")
                       ->with(10)
                       ->willReturn($user);


        $entityManagerMock = $this->createMock(EntityManager::class);

        $entityManagerMock->method("getRepository")
                          ->with(User::class)
                          ->willReturn($repositoryMock);

        $resolver = new UserResolver($entityManagerMock);

        $this->assertEquals($user, $resolver->resolve(new Argument(['id' => 10])));
    }

    public function testResolve_withoutArgument_shouldThrowException(): void {
        $entityManagerMock = $this->createMock(EntityManager::class);
        $resolver          = new UserResolver($entityManagerMock);

        $this->expectException(InvalidArgumentException::class);
        $resolver->resolve(new Argument());

    }

    public function testGetAliases_shouldReturnAliases(): void {
        $excpected = [
            'resolve' => 'User',
        ];

        $this->assertEquals($excpected, UserResolver::getAliases());
    }

}
