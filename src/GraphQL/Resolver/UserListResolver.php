<?php


namespace App\GraphQL\Resolver;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class UserListResolver implements ResolverInterface, AliasedInterface {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function resolve(Argument $args) {
        $users = $this->em->getRepository(User::class)->findBy(
            [],
            [ $args['order_by'] => $args['order']],
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
