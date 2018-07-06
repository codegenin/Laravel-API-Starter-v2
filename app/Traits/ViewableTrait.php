<?php

namespace App\Traits;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Models\View;

trait ViewableTrait
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }
    
    /**
     * Add this Object to the user purchase
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function addView($user_id = null)
    {
        $favorite = new View(['user_id' => ($user_id) ? $user_id : Auth::id()]);
        $this->views()
             ->save($favorite);
    }
    
    /**
     * Remove this Object from the user views
     *
     * @param  int $user_id [if  null its added to the auth user]
     *
     */
    public function removeView($user_id = null)
    {
        $this->views()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->delete();
    }
    
    /**
     * Toggle the favorite status from this Object
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function toggleView($user_id = null)
    {
        $this->isViewd($user_id) ? $this->removeView($user_id) : $this->addView($user_id);
    }
    
    /**
     * Check if the user has viewedBy this Object
     *
     * @param  int $user_id [if  null its added to the auth user]
     * @return boolean
     */
    public function isViewed($user_id = null)
    {
        return $this->views()
                    ->where('user_id', ($user_id) ? $user_id : Auth::id())
                    ->exists();
    }
    
    /**
     * Return a collection with the Users who marked as favorite this Object.
     *
     * @return Collection
     */
    public function viewedBy()
    {
        return $this->views()
                    ->with('user')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item['user']];
                    });
    }
    
    /**
     * Count the number of views
     *
     * @return int
     */
    public function getViewsCountAttribute()
    {
        return $this->views()
                    ->count();
    }
    
    /**
     * @return viewsCount attribute
     */
    public function viewsCount()
    {
        return $this->viewsCount;
    }
}