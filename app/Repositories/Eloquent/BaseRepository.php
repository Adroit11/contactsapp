<?php

namespace App\Repositories\Eloquent;

abstract class BaseRepository
{
    protected $model;

    public function with( $relations )
    {
        return $this->model->with( $relations );
    }

    public function where( $column, $operator, $value)
    {
        return $this->model->where( $column, $operator, $value);
    }

    public function first()
    {
        return $this->model->first();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find( $id )
    {
        return $this->model->find( $id );
    }

    public function findOrFail( $id )
    {
        return $this->model->findOrFail( $id );
    }

    public function orderBy( $field, $direction )
    {
        return $this->model->orderBy( $field, $direction );
    }

    public function create( array $data )
    {
        return $this->model->create( $data );
    } 

    public function destroyAll()
    {
        $this->model->truncate();
    }   

    public function destroy( $keys )
    {
        return $this->model->destroy( $keys );
    }

    public function save($data)
    {
        if ($data instanceOf \Illuminate\Database\Eloquent\Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }

	public function delete( $data )
    {
		if ($data instanceOf \Illuminate\Database\Eloquent\Model) {

			 return $data->delete();
            
        } elseif (is_numeric( $data )) {

			return $this->model->destroy( $data );
			
        }else{

			throw new \InvalidArgumentException('Invalid argument.');	
		}
    }

    public function getNew($attributes = array())
    {
        return $this->model->newInstance($attributes);
    }  

}