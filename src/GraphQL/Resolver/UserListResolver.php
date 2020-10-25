<?php


namespace App\GraphQL\Resolver;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class UserListResolver implements ResolverInterface, AliasedInterface {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function resolve(Argument $args): array {
        if(!isset($args['order_by'])){
            throw new InvalidArgumentException("order_by should be defined");
        }

        if(!isset($args['order'])){
            throw new InvalidArgumentException("order should be defined");
        }

        if(!isset($args['limit'])){
            throw new InvalidArgumentException("limit should be defined");
        }

        if(!isset($args['offset'])){
            throw new InvalidArgumentException("offset should be defined");
        }

        $users = $this->em->getRepository(User::class)->findBy(
            [],
            [$args['order_by'] => $args['order']],
            $args['limit'],
            $args['offset']
        );

        return [
            "users" => $users,
        ];
    }

    public static function getAliases(): array {
        return [
            'resolve' => 'UserList',
        ];
    }

}
