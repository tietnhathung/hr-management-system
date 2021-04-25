<?php


namespace App\Repositories\Classes;

use Illuminate\Support\Facades\App;
use App\Repositories\Interfaces\IBaseRepository;

abstract class BaseRepository implements IBaseRepository {

    protected $_model;

    protected $_modelClass;


    public function __construct()
    {
        $this->_model = App::make($this->_modelClass);
    }

    public function getInstance(){
        return $this->_model;
    }


    public function getAll()
    {
        return $this->_model->all();
    }


    public function findById($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }


    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }


    public function update($id, array $attributes)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }


    public function delete($id)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}
