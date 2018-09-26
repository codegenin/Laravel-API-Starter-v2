<?php

namespace App\Traits;

use App\Models\Report;


trait ReportabilityTrait
{
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }
    
    /**
     * Return a collection with the User reported Model.
     * The Model needs to have the Reportable trait
     *
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return \Illuminate\Database\Eloquent\Collection
     *
     */
    public function report($class)
    {
        return $this->reports()
                    ->where('reportable_type', $class)
                    ->with('reportable')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        if (!$item['reportable']) {
                            return [];
                        }
            
                        return [$item['reportable']->id => $item['reportable']];
                    });
    }
    
    /**
     * Add the object to the User report.
     * The Model needs to have the reportable trait
     *
     * @param Object $object
     */
    public function addReport($object)
    {
        $object->addReport($this->id);
    }
    
    /**
     * Remove the Object from the user reports.
     * The Model needs to have the Reportable trai
     *
     * @param Object $object
     */
    public function removeReport($object)
    {
        $object->removeReport($this->id);
    }
    
    /**
     * Toggle the report status from this Object from the user reports.
     * The Model needs to have the Reportable trai
     *
     * @param Object $object
     */
    public function toggleReport($object)
    {
        $object->toggleReport($this->id);
    }
    
    /**
     * Check if the user has reported this Object
     * The Model needs to have the Reportable trait
     *
     * @param Object $object
     * @return boolean
     */
    public function isReported($object)
    {
        return $object->isReported($this->id);
    }
    
    /**
     * Check if the user has reported this Object
     * The Model needs to have the Reportable trait
     *
     * @param Object $object
     * @return boolean
     */
    public function hasReported($object)
    {
        return $object->isReported($this->id);
    }
}