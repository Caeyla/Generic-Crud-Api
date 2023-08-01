<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    public abstract function getModel():Model;
    public function getFillable(){
        return $this->getModel()->getFillable();
    }
    public function save(Request $request){
        $model = $this->getModel();
        $model->fill($request->only($this->getFillable()));
        $model->save();
        return response()->json($model);
    }
    public function update(Request $request, $id){
        $model = $this->getModel()->find($id);
        $model->fill($request->only($this->getFillable()));
        $model->save();
        return response()->json($model);
    }
    public function delete($id){
        $model = $this->getModel()->find($id);
        $model->delete();
        return response()->json($model);
    }
    public function get($id){
        $model = $this->getModel()->find($id);
        return response()->json($model);
    }
    public function getAll(){
        $model = $this->getModel()->all();
        return response()->json($model);
    }

}
