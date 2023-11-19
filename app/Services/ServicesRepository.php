<?php

namespace App\Services;

use Exception;

use Illuminate\Support\Carbon;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Builder as EloquentQuery;

use App\Models\Service;

class ServicesRepository extends RepoService
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
    protected static $repo = 'repo.services';

    /**
     * Cache lifetime in days
     *
     * @var int
     */
    protected static $cacheDays = 3;


    /**
     * {@inheritDoc}
     */
    public function getRepoKey(): string
    {
        return static::$repo;
    }

    /**
     * {@inheritDoc}
     */
    public function getRepoCollection(): EloquentCollection
    {
        return Service::with('media')->get();
    }

    /**
     * Get Query
     *
     * @return EloquentCollection
     */
    public function getQuery(): EloquentQuery
    {
        return Service::query();
    }

    /**
     * Get service by name
     *
     * @param  string $name
     * @return ?Service
     */
    public function get(string $name)
    {
        return $this->findBy('name', $name);
    }
}
