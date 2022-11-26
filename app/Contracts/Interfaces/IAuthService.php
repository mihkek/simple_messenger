<?php

namespace App\Contracts\Interfaces;

use App\Enum\UserRoleEnum;
use Illuminate\Http\JsonResponse;

interface IAuthService
{
    public function signin($email, $password): JsonResponse;
    public function signup($input): JsonResponse;
    public function checkUserHasRole(UserRoleEnum $role, int $user_id): bool;
    public function test();
}
