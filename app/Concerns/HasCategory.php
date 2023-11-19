<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Category;

trait HasCategory
{

    /**
     * Scope a query to specific category.
     *
     * @param  ?string $category
     * @return void
     */
    public function scopeWhereCategory(Builder $query, string $category = null): void
    {
        $query->whereHas('category', function (Builder $query) use ($category) {
            $query->where('name', $category)
                ->orWhere('slug', $category)
                ->orWhere('title', $category);
        });
    }

    /**
     * Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Set category
     *
     * @param  Category $category
     * @return \Illuminate\Database\Eloquent\Model|bool|null
     */
    public function setCategory(Category $category)
    {
        return $this->category()->associate($category);
    }

    /**
     * Remove from category
     *
     * @return \Illuminate\Database\Eloquent\Model|bool|null
     */
    public function unsetCategory()
    {
        return $this->category()->dissociate();
    }
}
