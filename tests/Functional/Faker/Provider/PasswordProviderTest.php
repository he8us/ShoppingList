<?php


namespace App\Tests\Faker\Provider;


use App\Faker\Provider\PasswordProvider;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordProviderTest extends TestCase {

    public function testEncodeFakerMethod_shouldCallUserPasswordEncoder(): void {
        $generator = $this->createMock(Generator::class);

        $encoder = $this->createMock(UserPasswordEncoderInterface::class);

        $encoder
            ->expects($this->once())
            ->method("encodePassword")
            ->will($this->returnArgument(1));

        $provider = new PasswordProvider($generator, $encoder);

        $this->assertEquals(12345, $provider->encode(12345));
    }

}
