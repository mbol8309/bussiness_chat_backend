<?php

namespace App\GraphQL\Queries\User;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UsersQuery extends Query
{

    protected $attributes = [
        'name' => 'user',
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        return true;
    }

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function rules(array $args = []): array
    {
        return [
        ];
    }

    public function resolve($root, $args, ?SelectFields $fields)
    {
        return User::all();
    }
}
