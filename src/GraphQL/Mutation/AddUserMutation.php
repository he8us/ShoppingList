<?php

namespace App\GraphQL\Mutation;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class AddUserMutation implements MutationInterface
{

    // public function __construct()
    // {
    //     If you wanna inject some service dependencies, do it here
    // }

    public function __invoke(Argument $args)
    {
        // Add your logic when the mutation is called here (e.g database calls and updates).
        // $args is generally an object passed in your Mutation.types.yaml and contains arguments of your mutation.
    }

}
