<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UserLogin extends Mutation
{
    protected $attributes = [
        'name' => 'login',
        'description' => 'To login a user'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    protected function rules(array $args = []): array
    {
        return [
            'email' => [
                'required',
                'string',
                'min:1',
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }

    public function args(): array
    {
        return [
            'email' => Type::string(),
            'password' => Type::string(),
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        // $select = $fields->getSelect();
        $with = $fields->getRelations();

        $email = $args['email'];
        $user = User::where('email', $email)->with($with)->first();
        if (Auth::attempt($args)) {
            Auth::login($user);
            $tokens = $user->tokens;
            foreach ($tokens as $token) {
                if ($token->can('authenticate')) {
                    $token->delete();
                }
            }
            $new_token = $user->createToken('login_token', ['authenticate']);
            $user->withAccessToken($new_token->plainTextToken);
        } else {
            throw new Exception('Invalid login credentials');
        }
        

        return $user;
    }
}
