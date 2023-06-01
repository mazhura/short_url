<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class UserDataHelper
{
    public static function generate(Request $request): array
    {
        return [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            ];
    }

}
