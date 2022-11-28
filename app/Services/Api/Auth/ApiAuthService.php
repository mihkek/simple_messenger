<?php

namespace App\Services\Api\Auth;

use App\Contracts\AbstractClasses\AbsBaseApiService;
use App\Contracts\Interfaces\IAuthService;
use App\Enum\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class ApiAuthService extends AbsBaseApiService implements IAuthService
{
    public function signin($email, $password): JsonResponse
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $authUser = Auth::user();
            if ($authUser instanceof User) {
                $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
                $success['name'] =  $authUser->name;
                return $this->responceService->sendResponse($success, 'User signed in');
            } else {
                return $this->responceService->sendError(['Undefined authorised user'], 'Server auth error.', 500);
            }
        } else {
            return $this->responceService->sendError(['Invalid email and/or password.'], 'Auth error.', 403);
        }
    }
    public function signup($input): JsonResponse
    {
        $validator = FacadesValidator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->responceService->sendError('Error validation', $validator->errors());
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MessengerAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->responceService->sendResponse($success, 'User created successfully.');
    }
    public function checkUserHasRole(UserRoleEnum $role, int $user_id): bool
    {
        return User::where('role', $role)->where('id', $user_id)->exists();
    }
}
