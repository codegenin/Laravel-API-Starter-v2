<?php

namespace App\Traits;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

trait ReportableTrait
{
    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
    
    
    /**
     * Add this Object to the user report
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function addReport($user_id = null)
    {
        $favorite = new Report([
            'user_id' => ($user_id) ? $user_id : Auth::id()
        ]);
        
        $this->reports()
             ->save($favorite);
    }
    
    /**
     * Remove this Object from the user reports
     *
     * @param  int $user_id [if  null its added to the auth user]
     *
     */
    public function removeReport($user_id = null)
    {
        $this->reports()
             ->where('user_id', ($user_id) ? $user_id : Auth::id())
             ->delete();
    }
    
    /**
     * Toggle the favorite status from this Object
     *
     * @param  int $user_id [if  null its added to the auth user]
     */
    public function toggleReport($user_id = null)
    {
        $this->isReported($user_id) ? $this->removeReport($user_id) : $this->addReport($user_id);
    }
    
    /**
     * Check if the user has reportedBy this Object
     *
     * @param  int $id [if  null its added to the media id]
     * @return boolean
     */
    public function isReported($id = null)
    {
        return $this->reports()
                    ->where('reportable_id', $id)
                    ->exists();
    }
    
    /**
     * Return a collection with the Users who marked as favorite this Object.
     *
     * @return Collection
     */
    public function reportedBy()
    {
        return $this->reports()
                    ->with('user')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item['user']];
                    });
    }
    
    /**
     * Count the number of reports
     *
     * @return int
     */
    public function getReportsCountAttribute()
    {
        return $this->reports()
                    ->count();
    }
    
    /**
     * @return reportsCount attribute
     */
    public function reportsCount()
    {
        return $this->reportsCount;
    }
}