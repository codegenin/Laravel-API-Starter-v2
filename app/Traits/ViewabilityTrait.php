<?php

namespace App\Traits;


use App\Models\View;

trait ViewabilityTrait
{
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views()
    {
        return $this->hasMany(View::class, 'user_id');
    }
    
    /**
     * Return a collection with the User viewd Model.
     * The Model needs to have the Viewable trait
     *
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return Collection
     */
    public function view($class)
    {
        return $this->views()->where('viewable_type', $class)->with('viewable')->get()->mapWithKeys(function ($item) {
            return [$item['viewable']->id=>$item['viewable']];
        });
    }
    
    /**
     * Add the object to the User views.
     * The Model needs to have the Viewable trai
     *
     * @param Object $object
     */
    public function addView($object)
    {
        $object->addView($this->id);
    }
    
    /**
     * Remove the Object from the user views.
     * The Model needs to have the Viewable trai
     *
     * @param Object $object
     */
    public function removeView($object)
    {
        $object->removeView($this->id);
    }
    
    /**
     * Toggle the view status from this Object from the user views.
     * The Model needs to have the Viewable trai
     *
     * @param Object $object
     */
    public function toggleView($object)
    {
        $object->toggleView($this->id);
    }
    
    /**
     * Check if the user has viewd this Object
     * The Model needs to have the Viewable trai
     *
     * @param Object $object
     * @return boolean
     */
    public function isViewed($object)
    {
        return $object->isViewed($this->id);
    }
    
    /**
     * Check if the user has viewd this Object
     * The Model needs to have the Viewable trai
     *
     * @param Object $object
     * @return boolean
     */
    public function hasViewed($object)
    {
        return $object->isViewed($this->id);
    }
}