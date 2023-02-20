<?php

namespace App\Http\Libraries;

use App\Models\User;

trait ApiHelpers
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    protected function errorResponse($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    protected function isSuperAdmin($user)
    {
        if (!empty($user)) {
            return $user->role === User::ROLES['SUPER_ADMIN'];
        }

        return false;
    }

    protected function isAdmin($user)
    {
        if (!empty($user)) {
            return $user->role === User::ROLES['ADMIN'];
        }

        return false;
    }
}
