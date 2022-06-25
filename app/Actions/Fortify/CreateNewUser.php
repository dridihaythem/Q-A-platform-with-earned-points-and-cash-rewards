<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\PointService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function __construct(private PointService $pointService)
    {
    }
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $this->pointService->add($user, 'CREATE_ACCOUNT');

        if (request()->has('id')) {

            $user_who_invited_me = User::find(request()->id);

            if ($user_who_invited_me) {
                $this->pointService->add($user_who_invited_me, 'CREATE_ACCOUNT_WITH_MY_LINK');
            }
        }

        return $user;
    }
}
