<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Domain;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DomainType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Domain',
        'description' => 'A Host to serve Ejabberd',
        'model' => Domain::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'id of host'

            ],
            'name' => [
                'type' => Type::nonNull(Type::string())
            ],
            'url' => [
                'type' => Type::nonNull(Type::string())
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User'))
                ]
        ];
    }
}
