<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Models\Article;

use App\Http\Resources\V1\ArticleResource;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
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
        return ArticleResource::collection(Article::all());
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
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
