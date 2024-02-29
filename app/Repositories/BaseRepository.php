<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/******************************************************
 * @class BaseRepository
 *  In this class we create our popular methods
 *  such as get all data , find by id and CRUD actions
 *******************************************************/
class BaseRepository implements InterfaceBaseRepository
{
    /***************************************
     * @var Model $currentModel
     *  define model type with this property
     ****************************************/
    private Model $model;

    /********************************************************
     * @param Model $model
     * We use the constructor for repository constructor type
     * So with constructor we can assign your select model
     *********************************************************/
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /***************
     * @return Model
     */
    public function query(): Model
    {
        return $this->model;
    }

    /************************
     * @method  array|Collection|\Illuminate\Support\Collection getAll()
     *  get all of your model
     ************************/
    public function getAll()
    {
        return $this->model->orderBy("id","desc");
    }

    /*************************
     * @method Model|array|Collection|null findById()
     * @param $id
     * find your select method
     *************************/
    public function findById($id): Model|array|Collection|null|bool
    {
        $model = $this->model->find($id);
        if (!@$model)
            return false;
        else
            return $model;
    }


    /******************************
     * @method Model insertData()
     * @param $data
     * new instance of your model
     ******************************/
    public function insertData($data): Model
    {
        return $this->model->create($data);
    }

    public function updateItem($identity, $data): Model|bool
    {
        $model = $this->model->find($identity);
        if (!@$model)
            return false;
        foreach ($data as $key => $value) {
            $model[$key] = $value;
        }
        return $model->save();

    }

    /*******************************
     * drop instance of model
     * @method bool deleteData()
     * @param int $identity
     *******************************/
    public function deleteData($identity): ?bool
    {
        $model = $this->model->find($identity);
        if (!@$model)
            return false;
        return $model->delete();
    }

    /*******************************************
     * Dynamic Search by table column and value
     * @param $column
     * @param $value
     * @return Model|Builder
     ********************************************/
    public function searchByColumn($column, $value): Model|Builder
    {
        return $this->model->where($column, 'like', '%' . $value . '%');//->get()
    }

}
