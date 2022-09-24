<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserResourceCollection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        $values = $request->validate([
            'email' => ['required', 'string', 'min:1'],
            'password' => ['required', 'string', 'min:1'],
        ]);
        $user = User::where('email', $values['email'])->first();

        if (Auth::attempt($values)) {
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

        return new UserResource($user);
    }
}
