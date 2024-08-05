<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FallbackController extends Controller
{
    public function pageNotFound(Request $request) 
    {
        return response()->view('site.errors.404', [], 404);
    }
}
