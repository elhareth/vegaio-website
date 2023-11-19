<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Models\SiteOption;

use App\Http\Resources\V1\SiteOptionResource;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;

class SiteOptionController extends Controller
{
    /**
     * Construct
     *
     * Instruct policies, gates and middlewares
     *
     * @return static
     */
    public function __construct()
    {
        // $this->authorize();
        // $this->middleware();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SiteOptionResource::collection(SiteOption::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteOption $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SiteOption $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteOption $option)
    {
        //
    }
}
