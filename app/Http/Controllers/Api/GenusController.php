<?php

namespace App\Http\Controllers\Api;

use App\Genus;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneraResource;
use Illuminate\Http\Request;

class GenusController extends Controller
{
    public function index(Request $request)
    {
        return GeneraResource::collection(Genus::get()->load('vegetables'));
    }
}
