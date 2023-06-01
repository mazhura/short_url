<?php

namespace App\Actions;


use App\Helpers\UserDataHelper;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenerateLinkAction
{
    /**
     * @param string $inputUrl
     * @return string
     */
    public function handle(Request $request): string
    {
        $validated = $request->validate(['inputUrl' => 'required|url']);

        $inputUrl = $validated['inputUrl'];


        $link = Link::query()->create([
            'input_url' => $inputUrl,
            'user_data' => UserDataHelper::generate($request)
        ]);

        return route('redirectToUrl', $link->hash);
    }

}
