<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A User',
        'model' => User::class
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of user'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of user'
            ],
            'token' => [
                'type' => Type::string(),
                // 'privacy'       => function(array $args, $ctx): bool {
                //     return isset($args['id']) && $args['id'] == Auth::id();
                // }
            ],
            'domains' => [
                'type' => Type::listOf(GraphQL::type('Domain'))
            ]
        ];
    }
}
