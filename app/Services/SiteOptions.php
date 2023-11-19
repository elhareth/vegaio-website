<?php

namespace App\Services;

use Exception;
use App\Exceptions\RepoRecordNotFound;

use Illuminate\Contracts\Foundation\Application;

use Illuminate\Support\Carbon;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Builder as EloquentQuery;

use App\Models\SiteOption;

use App\Concerns\SiteOptionsService\ContactInfo;

class SiteOptions extends RepoService
{
    use ContactInfo;

    /**
     * Repository Instance
     *
     * @var static
     */
    protected static $instance;

    /**
     * Repo identifier
     *
     * @return string
     */
    protected static $repo = 'repo.site-options';

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
     * {@inheritDocs}
     */
    public function getRepoCollection(): EloquentCollection
    {
        return SiteOption::with([])->autoloaded()->get();
    }

    /**
     * Get Query
     *
     * @return EloquentCollection
     */
    public function getQuery(): EloquentQuery
    {
        return SiteOption::query();
    }

    /**
     * Get fined list
     *
     * @return Enumerable
     */
    public function getList(): Enumerable
    {
        return $this->getRecords()->mapWithKeys(function ($option, $index) {
            return [
                $option->name => $option->value
            ];
        });
    }

    /**
     * Get site meta records
     *
     * @param  string $name
     * @param  mixed  $default
     * @return ?SiteOption
     */
    public function get(string $name, $default = null)
    {
        try {
            $option = $this->findBy('name', $name);

            if ($option) {
                return $option->value ?? $default;
            }
        } catch (RepoRecordNotFound $e) {
            $option = SiteOption::firstWhere('name', $name);

            if ($option) {
                return $option->value ?? $default;
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $default;
    }

    /**
     * Set site meta record
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  ?string $group
     * @return ?SiteOption
     */
    public function set(
        string $name,
        mixed  $value,
        string $group = null,
    )
    {
        $name = str($name)->tirm()->slug('_');

        return SiteOption::upateOrCreate(
            [
                'name' => $name,
                'group' => $group,
            ],
            [
                'value' => $value,
            ],
        );
    }

    /**
     *
     *
     */
    public function siteIcon()
    {
        $icon = $this->get('site_icon');

        if ($icon) {
            return asset('media/'. $icon);
        } else {
            return asset('assets/img/brand/favicon.png');
        }
    }

    /**
     *
     *
     */
    public function siteLogo()
    {
        $logo = $this->get('site_logo');

        if ($logo) {
            return asset('media/'. $logo);
        } else {
            return asset('assets/img/brand/logo-land.png');
        }
    }
}
