<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all(); 

        return response()->json($routes);
    }

    
    public function store(Request $request)
    {
        $route = new Route();
        $route->name = $request->input('name');
        $route->path = $request->input('path');
        $route->save();

        return response()->json($route, 201);
    }
}
