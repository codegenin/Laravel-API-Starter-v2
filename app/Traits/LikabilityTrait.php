<?php

namespace App\Traits;

use App\Models\Like;

trait LikabilityTrait
{
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }
    
    /**
     * Get all images book
     *
     * @return mixed
     */
    public function book($class)
    {
        return $this->likes()
                    ->where('likable_type', $class)
                    ->where('booked', 1)
                    ->with('likable')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item['likable']->id => $item['likable']];
                    });
    }
    
    /**
     * Return a collection with the User liked Model.
     * The Model needs to have the Likeable trait
     *
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return Collection
     */
    public function like($class)
    {
        return $this->likes()
                    ->where('likable_type', $class)
                    ->with('likable')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item['likable']->id => $item['likable']];
                    });
    }
    
    /**
     * Add the object to the User likes.
     * The Model needs to have the Likeable trai
     *
     * @param Object $object
     */
    public function addLike($object)
    {
        $object->addLike($this->id);
    }
    
    public function addBook($object)
    {
        $object->addBook($this->id);
    }
    
    /**
     * Remove the Object from the user likes.
     * The Model needs to have the Likeable trai
     *
     * @param Object $object
     */
    public function removeLike($object)
    {
        $object->removeLike($this->id);
    }
    
    public function removeBooked($object)
    {
        $object->removeBooked($this->id);
    }
    
    /**
     * Toggle the like status from this Object from the user likes.
     * The Model needs to have the Likeable trai
     *
     * @param Object $object
     */
    public function toggleLike($object)
    {
        $object->toggleLike($this->id);
    }
    
    /**
     * Check if the user has liked this Object
     * The Model needs to have the Likeable trait
     *
     * @param Object $object
     * @return boolean
     */
    public function isLiked($object)
    {
        return $object->isLiked($this->id);
    }
    
    public function isBooked($object)
    {
        return $object->isBooked($this->id);
    }
    
    /**
     * Check if the user has liked this Object
     * The Model needs to have the Likeable trai
     *
     * @param Object $object
     * @return boolean
     */
    public function hasLiked($object)
    {
        return $object->isLiked($this->id);
    }
}