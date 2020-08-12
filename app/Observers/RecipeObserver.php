<?php

namespace App\Observers;

use App\Entities\Recipe;
use App\Entities\Categories;
use App\Verification;

class RecipeObserver
{
    /**
     * Handle the recipe "created" event.
     *
     * @param  \App\Recipe  $recipe
     * @return void
     */
    public function created(Recipe $recipe)
    {
        //
    }

    /**
     * Handle the recipe "updated" event.
     *
     * @param  \App\Recipe  $recipe
     * @return void
     */
    public function updated(Recipe $recipe)
    {
        //
    }

    /**
     * Handle the recipe "deleted" event.
     *
     * @param  \App\Recipe  $recipe
     * @return void
     */
    public function deleted(Recipe $recipe)
    {
        //
    }

    /**
     * Handle the recipe "restored" event.
     *
     * @param  \App\Recipe  $recipe
     * @return void
     */
    public function restored(Recipe $recipe)
    {
        //
    }

    /**
     * Handle the recipe "force deleted" event.
     *
     * @param  \App\Recipe  $recipe
     * @return void
     */
    public function forceDeleted(Recipe $recipe)
    {
        //
    }
}
