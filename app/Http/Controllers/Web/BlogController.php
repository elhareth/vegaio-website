<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Article;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\Facades\CategoriesRepository;

class BlogController extends Controller
{
    /**
     *
     *
     */
    public function __construct()
    {
        //
    }

    /**
     *
     *
     */
    public function index()
    {
        $data = [];

        $bloggers = CategoriesRepository::getBlogCategories(true)->pluck('id')->toArray();

        $data['articles'] = Article::whereIn('category_id', $bloggers)
            ->with(['author', 'category'])
            ->withCount('comments')
            ->published()
            ->orderBy('published_at')
            ->paginate(5);

        return view('site.blog.index', $data);
    }

    /**
     *
     *
     */
    public function author(Request $request, User $user)
    {
        $data = [];

        $data['author'] = $user->load([
            'metalist'
        ])->loadCount('comments');

        $data['articles'] = $user->articles()->paginate(5);

        return view('site.blog.author', $data);

    }

    /**
     *
     *
     */
    public function archive(Request $request)
    {
        return view('site.blog.archive');
    }

    /**
     *
     *
     */
    public function article(Request $request, Article $article)
    {
        $data = [];

        Article::published()->where('id', $article->id)->firstOrFail();

        $data['article'] = $article->load([
            'metalist',
            'category',
            'comments',
        ])->loadCount('comments');

        return view('site.blog.article', $data);
    }

    /**
     *
     *
     */
    public function article_comment(Request $request, Article $article)
    {
        $response = static::makeComment($request, $article);

        if ($response['success']) {
            return redirect()->route('blog.article', $article)->with($response['message']);
        } else {
            return redirect()->route('blog.article', $article)->withErrors($response['message']);
        }
    }

    /**
     *
     *
     */
    public function category(Request $request, Category $category)
    {
        $data = [];

        if ($category->slug != 'blog' && $category->parent?->slug != 'blog') {
            abort(404);
        }

        $data['category'] = $category;
        $data['articles'] = $category->articles()->withCount('comments')->paginate(5);

        return view('site.blog.category', $data);
    }

    /**
     *
     *
     */
    public function category_article(Request $request, Category $category, Article $article)
    {
        return $this->article($request, $article);
    }

    /**
     *
     *
     */
    public function category_article_comment(Request $request, Category $category, Article $article)
    {
        $response = static::makeComment($request, $article);

        if ($response['success']) {
            return redirect()->route('blog.category.article', $article)->with($response['message']);
        } else {
            return redirect()->route('blog.category.article', $article)->withErrors($response['message']);
        }
    }

    /**
     * Make Comment
     *
     * @param  Request $request
     * @return array
     */
    protected static function makeComment(Request $request, Article $article)
    {
        $meta = [];

        $response = [
            'comment' => null,
            'success' => false,
            'message' => null,
            'errors' => [],
        ];

        if ($request->user()) {
            $request->validate([
                'comment' => 'required|string|min:5|max:1000',
            ]);

            $meta['name'] = $request->user()->getDisplayName();
            $meta['email'] = $request->user()->email;
        } else {
            $request->validate([
                'name' => 'required|string|min:2|max:20',
                'email' => 'required|email',
                'comment' => 'required|string|min:5|max:1000',
            ]);

            $meta['name'] = $request->input('name');
            $meta['email'] = $request->input('email');
        }

        $comment = $article->comments()->create([
            'comment' => $request->input('comment'),
        ]);

        if ($comment) {
            $comment->setMeta([
                'name' => [
                    'value' => $meta['name'],
                    'group' => 'user',
                ],
                'email' => [
                    'value' => $meta['email'],
                    'group' => 'user',
                ],
            ]);

            $response['comment'] = $comment;
            $response['success'] = true;
            $response['message'] = 'Comment added successfully!';
        } else {
            $response['comment'] = false;
            $response['message'] = 'Error!';
        }

        return $response;
    }
}
