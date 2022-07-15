<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Domain;
use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateDomainToken extends Mutation
{
    protected $attributes = [
        'name' => 'createDomainToken',
        'description' => 'Create a token for the given domain'
    ];

    public function type(): Type
    {
        return GraphQL::type('Domain');
    }

    protected function rules(array $args = []): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'min:1',
            ],
            'name' => [
                'required',
                'string'
            ]
        ];
    }

    public function args(): array
    {
        return [
            'id' => Type::int(),
            'name' => Type::string()
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $user = Auth::user();
        $domain = Domain::where('id', $args['id'])->with('user')->first();
        if (!$domain || $domain->user->id != $user->id){
            throw new Exception('No domain found with id:'. $args['id']);
        }
        $token = $domain->createToken($args['name'],['domain_token']);
        $domain->withAccessToken($token->plainTextToken);

        return $domain;
    }
}
