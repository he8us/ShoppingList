<?php


namespace App\GraphQL\Resolver;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class UserResolver implements ResolverInterface, AliasedInterface {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param Argument $args
     * @return User|null
     */
    public function resolve(Argument $args): ?User {
        if(!isset($args['id'])){
            throw new InvalidArgumentException('id should be defined');
        }

        return $this->em->getRepository(User::class)->find($args['id']);
    }

    public static function getAliases(): array {
        return [
            'resolve' => 'User',
        ];
    }

}
