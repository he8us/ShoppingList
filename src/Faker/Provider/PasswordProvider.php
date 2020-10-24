<?php

namespace App\Faker\Provider;


use App\Entity\User;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PasswordProvider
 * @package App\Faker\Provider
 */
final class PasswordProvider extends BaseProvider
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * PasswordProvider constructor.
     * @param Generator $generator
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(Generator $generator, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($generator);

        $this->encoder = $encoder;
    }

    /**
     * @param string $password
     * @return string
     */
    public function encode(string $password): string
    {
        $user = new User();
        return $this->encoder->encodePassword($user, $password);
    }
}
