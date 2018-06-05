<?php

namespace App\Repositories;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

abstract class AbstractBaseRepository
{
    /**
     * Eloquent model
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * Name of child class of Illuminate\Database\Eloquent\Model
     *
     * @param String $modelName
     */
    public function setUpModel($modelName)
    {
        $this->model = App::make($modelName);
    }
    
    /**
     * Determine all records
     *
     * @param array $with
     * @param array $columns
     * @return mixed
     */
    public function all($with = [], $columns = ['*'])
    {
        return $this->model->with($with)
                           ->get($columns);
    }
    
    /**
     * Find a record
     *
     * @param       $id
     * @param array $with
     * @param array $columns
     * @return mixed
     */
    public function find($id, $with = [], $columns = ['*'])
    {
        return $this->model->with($with)
                           ->where('id', $id)
                           ->first($columns);
    }
    
    /**
     * Find a record using the column information
     *
     * @param       $criterias
     * @param array $with
     * @return mixed
     */
    public function findByColumns($criterias, $with = [])
    {
        return $this->model->with($with)
                           ->where($criterias)
                           ->get();
    }
    
    /**
     * Find a record using the value information
     *
     * @param       $column
     * @param       $values
     * @param array $with
     * @return mixed
     */
    public function findByValues($column, $values, $with = [])
    {
        $models = $this->model->with($with);
        foreach ($values as $value) {
            $models->orWhere($column, $value);
        }
        
        return $models->get();
    }
    
    /**
     * Find record using the record columns
     *
     * @param       $criterias
     * @param array $with
     * @return mixed
     */
    public function findByColumnsFirst($criterias, $with = [])
    {
        return $this->model->with($with)
                           ->where($criterias)
                           ->first();
    }
    
    /**
     * Find record using selected columns
     *
     * @param       $criterias
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function findBySelectedColumnsFirst($criterias, $columns = ['*'], $with = [])
    {
        return $this->model->with($with)
                           ->where($criterias)
                           ->first($columns);
    }
    
    public function findByColumnsQuery($table, $criterias)
    {
        $element = DB::table($table);
        
        foreach ($criterias as $column => $value) {
            $element = $element->where($column, $value);
        }
        
        return $element->get();
    }
    
    /**
     * Update record using columns for association
     *
     * @param       $criterias
     * @param array $data
     * @return mixed
     */
    public function updateByColumns($criterias, $data = [])
    {
        return $this->model->where($criterias)
                           ->update($data);
    }
    
    /**
     * Update record using the id
     *
     * @param       $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data = [])
    {
        return $this->model->where('id', $id)
                           ->update($data);
    }
    
    /**
     * Create a record
     *
     * @param $data_insert
     * @return mixed
     */
    public function create($data_insert)
    {
        return $this->model->create($data_insert);
    }
    
    /**
     * Removes a record
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)
                           ->delete();
    }
    
    public function insertOrCreate($criteria, $fill_data)
    {
        $element = $this->model->firstOrCreate($criteria);
        
        return $element->fill($fill_data)
                       ->save();
    }
    
    public function updateOrCreate($criteria, $fill_data)
    {
        return $this->model->updateOrCreate($criteria, $fill_data);
    }
    
    public function whereLike($column, $value)
    {
        return $this->model->where($column, 'like', '%' . $value . '%')
                           ->get();
    }
    
}