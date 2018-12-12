<?php

namespace App\Traits;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

trait PurchasableTrait
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function purchases()
    {
        return $this->morphMany(Purchase::class, 'purchasable');
    }
    
    /**
     * Add this Object to the user purchase
     *
     * @param  int $user_id  [if  null its added to the auth user]
     */
    public function addPurchase($user_id = null)
    {
        $favorite = new Purchase(['user_id' => ($user_id) ? $user_id : Auth::id()]);
        $this->purchases()->save($favorite);
    }
    
    /**
     * Remove this Object from the user purchases
     *
     * @param  int $user_id  [if  null its added to the auth user]
     *
     */
    public function removePurchase($user_id = null)
    {
        $this->purchases()->where('user_id', ($user_id) ? $user_id : Auth::id())->delete();
    }
    
    /**
     * Grab user purchases
     *
     * @return $this
     */
    public function userPurchases()
    {
        $this->purchases()->where('user_id',  Auth::id());
    }
    
    /**
     * Toggle the favorite status from this Object
     *
     * @param  int $user_id  [if  null its added to the auth user]
     */
    public function togglePurchase($user_id = null)
    {
        $this->isPurchased($user_id) ? $this->removePurchase($user_id) : $this->addPurchase($user_id) ;
    }
    
    /**
     * Check if the user has purchasedBy this Object
     *
     * @param  int $user_id  [if  null its added to the auth user]
     * @return boolean
     */
    public function isPurchased($user_id = null)
    {
        return $this->purchases()->where('user_id', ($user_id) ? $user_id : Auth::id())->exists();
    }
    
    /**
     * Return a collection with the Users who marked as favorite this Object.
     *
     * @return Collection
     */
    public function purchasedBy()
    {
        return $this->purchases()->with('user')->get()->mapWithKeys(function ($item) {
            return [$item['user']];
        });
    }
    
    /**
     * Count the number of purchases
     *
     * @return int
     */
    public function getPurchasesCountAttribute()
    {
        return $this->purchases()->count();
    }
    
    /**
     * @return purchasesCount attribute
     */
    public function purchasesCount()
    {
        return $this->purchasesCount;
    }
}