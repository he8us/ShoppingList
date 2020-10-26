<?php


namespace App\Tests\Repository;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepositoryTest extends KernelTestCase {

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    protected function setUp(): void {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                      ->get('doctrine')
                                      ->getManager();

        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    protected function tearDown(): void {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testUpgradePassword_withWrongUser_shouldThrowException(): void {
        $object = $this->createMock(UserInterface::class);

        $this->expectException(UnsupportedUserException::class);
        $this->userRepository->upgradePassword($object, '12345');
    }

    public function testUpgradePassword_withNewPassword_shouldUpdateTheDatabase(): void {
        $user = $this->userRepository->findOneByUsername('admin');

        $this->userRepository->upgradePassword($user, '12345');


        $user = $this->userRepository->findOneByUsername('admin');
        $this->assertEquals('12345', $user->getPassword());
    }

    public function testLoadUserByUsername_withUsername_shouldReturnCorrectUser(): void {
        $user = $this->userRepository->loadUserByUsername('admin');
        $this->assertNotNull($user);
        $this->assertEquals('admin@example.com', $user->getEmail());
    }

    public function testLoadUserByUsername_withEmail_shouldReturnCorrectUser(): void {
        $user = $this->userRepository->loadUserByUsername('admin@example.com');
        $this->assertNotNull($user);
        $this->assertEquals('admin', $user->getUsername());
    }

}
