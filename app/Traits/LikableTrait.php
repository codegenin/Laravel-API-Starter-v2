<?php

namespace App\Traits;

use App\Models\Like;

trait LikableTrait
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }
    
    public function book($user_id)
    {
        $this->likes()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->where('book', 1)
             ->get();
    }
    
    /**
     * Add this Object to the user like
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function addLike($user_id = null)
    {
        $favorite = new Like([
            'user_id' => ($user_id) ? $user_id : Auth::id(),
            'booked'  => 1
        ]);
        
        $this->likes()
             ->save($favorite);
    }
    
    public function addBook($user_id = null)
    {
        $this->likes()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->update([
                 'booked' => 1
             ]);
    }
    
    /**
     * Remove this Object from the user likes
     *
     * @param  int $user_id [if  null its added to the auth user]
     *
     */
    public function removeLike($user_id = null)
    {
        $this->likes()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->delete();
    }
    
    /**
     * Remove booked like
     *
     * @param null $user_id
     */
    public function removeBooked($user_id = null)
    {
        $this->likes()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->update(['booked' => 0]);
    }
    
    /**
     * Toggle the favorite status from this Object
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function toggleLike($user_id = null)
    {
        $this->isLiked($user_id) ? $this->removeLike($user_id) : $this->addLike($user_id);
    }
    
    /**
     * Check if the user has likedBy this Object
     *
     * @param  int $user_id [if  null its added to the auth user]
     * @return boolean
     */
    public function isLiked($user_id = null)
    {
        return $this->likes()
                    ->where('user_id', ($user_id) ? $user_id : Auth::id())
                    ->exists();
    }
    
    /**
     * Check if the user has likedBy this Object and is booked
     *
     * @param null $user_id
     * @return bool
     */
    public function isBooked($user_id = null)
    {
        return $this->likes()
                    ->where('user_id', ($user_id) ? $user_id : Auth::id())
                    ->where('booked', 1)
                    ->exists();
    }
    
    /**
     * Return a collection with the Users who marked as favorite this Object.
     *
     * @return Collection
     */
    public function likedBy()
    {
        return $this->likes()
                    ->with('user')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item['user']];
                    });
    }
    
    /**
     * Count the number of likes
     *
     * @return int
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()
                    ->count();
    }
    
    /**
     * @return likesCount attribute
     */
    public function likesCount()
    {
        return $this->likesCount;
    }
}