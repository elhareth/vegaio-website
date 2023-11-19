<?php

namespace App\Services;

use Exception;
use App\Exceptions\RepoRecordNotFound;

use Illuminate\Support\Carbon;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Builder as EloquentQuery;

abstract class RepoService
{
    /**
     * Categories Collection
     *
     * @var Enumerable
     */
    protected Enumerable $records;

    /**
     * Get Query
     *
     * @return EloquentQuery
     */
    abstract public function getQuery(): EloquentQuery;

    /**
     * Get Repository key
     *
     * @return string
     */
    abstract public function getRepoKey(): string;

    /**
     * Get Repository primary collection
     *
     * @return EloquentCollection
     */
    abstract public function getRepoCollection(): EloquentCollection;

    /**
     *
     *
     */
    public function __construct()
    {
        $this->prefetch();

        if (!isset(static::$instance)) {
            static::$instance = $this;
        }
    }

    /**
     *
     *
     */
    public function __destruct()
    {
        //
    }

    /**
     *
     *
     */
    public static function instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     *
     *
     */
    protected function prefetch()
    {
        $this->records = Cache::remember($this->getRepoKey(), Carbon::now()->addDays(static::$cacheDays), fn() => $this->getRepoCollection());
    }

    /**
     *
     *
     */
    protected function fetchRecords()
    {
        $this->records = $this->getRepoCollection();
        Cache::put($this->getRepoKey(), $this->records, Carbon::now()->addDays(static::$cacheDays));
        return Cache::get($this->getRepoKey());
    }

    /**
     *
     *
     */
    public function flushRecords()
    {
        $this->records = null;
        return Cache::pull($this->getRepoKey());
    }

    /**
     * Get collected records
     *
     * @return Enumerable
     */
    public function getRecords(): Enumerable
    {
        return $this->records;
    }

    /**
     * Find a record on collection
     *
     * @param  string     $key
     * @param  string|int $value
     * @return ?Model
     */
    public function findBy(string $key, string|int $value)
    {
        $key = str($key)->trim()->lower();

        $record = $this->getRecords()->firstWhere($key, $value);

        if (!$record) {
            throw new RepoRecordNotFound(sprintf("No record found with %s : %s", $key, $value));
        }

        return $record;
    }

    /**
     * Find records by
     *
     * @param  string    $key
     * @param  string|in $value
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function collectBy(string $key, string|int|array $value)
    {
        $key = str($key)->trim()->lower();

        if (is_array($value)) {
            $records = $this->getRecords()->whereIn($key, $value);
        } else {
            $records = $this->getRecords()->where($key, $value);
        }

        return $records;
    }

    /**
     * Find records by
     *
     * @param  string    $key
     * @param  string|in $value
     * @return ?\Illuminate\Database\Eloquent\Collection
     */
    public function queryBy(string $key, string|int|array|null $value)
    {
        $key = str($key)->trim()->lower();

        if (is_array($value)) {
            $query = $this->getQuery()->whereIn($key, $value);
        } else {
            $query = $this->getQuery()->where($key, $value);
        }

        return $query->get();
    }
}
