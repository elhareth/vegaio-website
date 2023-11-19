<?php

namespace App\Services;

use Exception;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Builder as EloquentQuery;

use App\Models\Category;

class CategoriesRepository extends RepoService
{
    /**
     * Repository Instance
     *
     * @var static
     */
    protected static $instance;

    /**
     * Repo name, used as ID & key
     *
     * @var string
     */
    protected static $repo = 'repo.categories';

    /**
     * Cache lifetime in days
     *
     * @var int
     */
    protected static $cacheDays = 3;

    /**
     * Get Repository key
     *
     * @return string
     */
    public function getRepoKey(): string
    {
        return static::$repo;
    }

    /**
     * Get Repository Collection
     *
     * @return EloquentCollection
     */
    public function getRepoCollection(): EloquentCollection
    {
        return Category::withCount([
            'services',
            'articles',
            'children',
        ])->get();
    }

    /**
     * Get Query
     *
     * @return EloquentCollection
     */
    public function getQuery(): EloquentQuery
    {
        return Category::query();
    }

    /**
     * Get category by name
     *
     * @param  string $name
     * @return ?Category
     */
    public function get(string $name)
    {
        return $this->findBy('name', $name);
    }

    /**
     * Get Bloggers | Blog category and its children
     *
     * @param  bool $includeBlog Whether to include the primary Blog
     * @return Collection
     */
    public function getBlogCategories(bool $includeBlog = true): Collection
    {
        $list = collect();
        $blog = $this->getRecords()->firstWhere('slug', 'blog');

        if (!$blog) {
            return $list;
        }

        if ($includeBlog) {
            $list->add($blog);
        }

        $blogs = $blog->children;

        $list->push(...$blogs);

        return $list;
    }
}
