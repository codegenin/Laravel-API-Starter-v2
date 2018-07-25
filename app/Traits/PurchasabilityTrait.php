<?php

namespace App\Traits;

use App\Models\Purchase;

trait PurchasabilityTrait
{
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'user_id');
    }
    
    /**
     * Return a collection with the User purchased Model.
     * The Model needs to have the Purchaseable trait
     *
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return Collection
     */
    public function purchase($class)
    {
        return $this->purchases()
                    ->where('purchasable_type', $class)
                    ->with('purchasable')
                    ->get()
                    ->mapWithKeys(function ($item) {
            
                        if (!$item['purchasable']) {
                            return [];
                        }
            
                        return [$item['purchasable']->id => $item['purchasable']];
                    });
    }
    
    /**
     * Add the object to the User purchases.
     * The Model needs to have the Purchaseable trai
     *
     * @param Object $object
     */
    public function addPurchase($object)
    {
        $object->addPurchase($this->id);
    }
    
    /**
     * Remove the Object from the user purchases.
     * The Model needs to have the Purchaseable trai
     *
     * @param Object $object
     */
    public function removePurchase($object)
    {
        $object->removePurchase($this->id);
    }
    
    /**
     * Toggle the purchase status from this Object from the user purchases.
     * The Model needs to have the Purchaseable trai
     *
     * @param Object $object
     */
    public function togglePurchase($object)
    {
        $object->togglePurchase($this->id);
    }
    
    /**
     * Check if the user has purchased this Object
     * The Model needs to have the Purchaseable trai
     *
     * @param Object $object
     * @return boolean
     */
    public function isPurchased($object)
    {
        return $object->isPurchased($this->id);
    }
    
    /**
     * Check if the user has purchased this Object
     * The Model needs to have the Purchaseable trai
     *
     * @param Object $object
     * @return boolean
     */
    public function hasPurchased($object)
    {
        return $object->isPurchased($this->id);
    }
}