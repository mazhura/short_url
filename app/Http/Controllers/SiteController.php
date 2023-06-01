<?php

namespace App\Http\Controllers;

use App\Actions\GenerateLinkAction;
use App\Helpers\UserDataHelper;
use App\Models\Link;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SiteController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @param Link $link
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function redirectToUrl(Link $link, Request $request)
    {
        $link->redirects()->create([
            'user_data' => UserDataHelper::generate($request),
        ]);

        return redirect($link->input_url);
    }

    /**
     * @param Request $request
     * @param GenerateLinkAction $action
     * @return JsonResponse
     */
    public function store(Request $request, GenerateLinkAction $action)
    {
        try {
            $outputUrl = $action->handle($request);

            return response()->json(compact('outputUrl'));
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
