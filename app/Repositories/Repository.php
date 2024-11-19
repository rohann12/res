<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

class Repository{
    protected $modelClass;

    public function select($select='*'){
        return $this->modelClass->select($select);
    }

    public function with($with=[]){
        return $this->modelClass->with($with);
    }

    public function all(){
        return $this->modelClass->all();
    }

    public function get(){
        return $this->modelClass->get();
    }

    public function count(){
        return $this->modelClass->count();
    }

    public function find($id){
        return $this->modelClass->findOrFail($id);
    }

    public function save($data){
        DB::beginTransaction();
        try{
            $this->modelClass->insert($data);
            DB::commit();
            return true;
        }catch(QueryException $exception){
            DB::rollback();
            return false;
        }
    }

    public function update($id,$data){
        DB::beginTransaction();
        try{
            $record=$this->modelClass->findOrFail($id);
            $record->fill($data)->save();
            DB::commit();
            return $record;
        }catch(QueryException $ex){
            DB::rollback();
            return false;
        }
    }

    public function destroy($id){
        try{
            $this->modelClass->findOrFail($id)->delete();
            return true;
        }catch(QueryException $ex){
            return false;
        }
    }


    public function create($inputs){
        $record= $this->modelClass->create($inputs);
        return $record;
    }

    public function updateOrCreate($conditions,$inputs){
        DB::beginTransaction();
        try{
            $record= $this->modelClass->updateOrCreate($conditions,$inputs);
            DB::commit();
            return $record;
        }catch(QueryException $ex){
            DB::rollback();
            return false;
        }
    }

    public function where($field,$operator=null,$value){
        return $this->modelClass->where($field,$operator,$value);
    }

    public function pluck($field,$key){
        return $this->modelClass->pluck($field,$key);
    }

    public function findByField($field, $value = null, $columns = ['*'])
    {
        return $this->modelClass->where($field, '=', $value)->first($columns);
    }

    public function whereIn($field, $value=[]) {
        return $this->modelClass->whereIn($field, $value);
    }

    public function orderby($field, $type='desc')
    {
        return $this->modelClass->orderby($field, $type);
    }
}

