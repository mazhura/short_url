<?php

namespace App\Http\Controllers;

use App\Actions\GenerateLinkAction;
use App\Models\Link;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function redirectToUrl(Link $link)
    {
        return redirect($link->input_url);
    }

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
