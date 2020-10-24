<?php


namespace App\Tests\Faker\Provider;


use App\Faker\Provider\PasswordProvider;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordProviderTest extends TestCase {

    private $provider;

    protected function setUp(){
        $generator = $this->createMock(Generator::class);

        $encoder = $this->createMock(UserPasswordEncoderInterface::class);

        $encoder
            ->expects($this->once())
            ->method("encodePassword")
            ->will($this->returnArgument(1));

        $this->provider = new PasswordProvider($generator, $encoder);
    }

    public function testEncodeFakerMethod() {


        $this->assertEquals(12345, $this->provider->encode(12345));
    }
}
