<?php

namespace App\Observers;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->name);
    }

    public function created(Category $category): void
    {

    }

    /**
     * @param Category $category
     * @return void
     */
    public function updating(Category $category): void
    {
        $category->slug = Str::slug($category->name);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {

    }

    /**
     * Handle the Category "deleted" event.
     */

    public function deleting(Category $category): void
    {
        /*$category->post()->delete();*/
    }

    public function deleted(Category $category): void
    {

    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
