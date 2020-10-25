<?php


namespace App\Tests\GraphQL\Mutation;


use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class NewUserMutation implements MutationInterface, AliasedInterface {


    public function mutate() {


        return new User();
    }

    public static function getAliases(): array {
        return [
            "mutate" => "NewUser",
        ];
    }

}
