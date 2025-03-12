<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table            = 'car';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_user', 'id_modelcar', 'id_color','id_brand'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAllCars()
    {
    return $this->findAll();
    }
    public function getCarById($id)
    {
        $this->select("car.id, car.id_modelcar, u.username, m.name as model, c.name as color, b.name as brand ");
        $this->join('modelcar m', 'm.id = car.id_modelcar');
        $this->join('brand b', 'b.id = m.id_brand');
        $this->join('color c', 'c.id = car.id_color');
        $this->join('user u', 'u.id = car.id_user');
        return $this->find($id);
    }

    public function createCar($data)
    {
        return $this->insert($data);
    }

    public function updateCar($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCar($id)
    {
        return $this->delete($id);
    }

    public function getCarByUser($id_user){
        $builder = $this->builder();
        $builder->select('car.* , b.name as marque, m.name as modelname, c.name as color ');
        $builder->join('modelcar m', 'm.id = car.id_modelcar');
        $builder->join('brand b', 'b.id = m.id_brand');
        $builder->join('color c', 'c.id = car.id_color');
        return $this->where('id_user', $id_user)->findAll();
    }

    public function getCarByModel($id_modelcar){
        return $this->where('id_modelcar', $id_modelcar)->findAll();
    }
    public function getCarByColor($id_color){
        return $this->where('id_color', $id_color)->findAll();
    }
    public function getCarByModelAndColor($id_modelcar, $id_color){
        return $this->where('id_modelcar', $id_modelcar)->where('id_color', $id_color)->findAll();
    }

    public function getAllCarsByModelAndBrand(){
        $this->select("car.id, u.username, u.email, m.name as model, c.name as color, b.name as brand, car.created_at, car.updated_at, car.deleted_at ");
        $this->join('modelcar m', 'm.id = car.id_modelcar');
        $this->join('brand b', 'b.id = m.id_brand');
        $this->join('color c', 'c.id = car.id_color');
        $this->join('user u', 'u.id = car.id_user');
        return $this->findAll();
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();
        $builder->select("car.id,  u.username, u.email, car.id_user , m.name as model, c.name as color, b.name as brand, car.created_at, car.updated_at, car.deleted_at ");
        $builder->join('modelcar m', 'm.id = car.id_modelcar');
        $builder->join('brand b', 'b.id = m.id_brand');
        $builder->join('color c', 'c.id = car.id_color');
        $builder->join('user u', 'u.id = car.id_user');
        // Recherche
        if ($searchValue != null) {
            $builder->like('modelcar.name', $searchValue);
            $builder->like('brand.name', $searchValue);
            $builder->like('color.name', $searchValue);
            $builder->like('user.username', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotal()
    {
        $builder = $this->builder();
        $builder->select("car.id, u.username, u.email, m.name as model, c.name as color, b.name as brand, car.created_at, car.updated_at, car.deleted_at ");
        $builder->join('modelcar m', 'm.id = car.id_modelcar');
        $builder->join('brand b', 'b.id = m.id_brand');
        $builder->join('color c', 'c.id = car.id_color');
        $builder->join('user u', 'u.id = car.id_user');
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();
        $builder->select("car.id, u.username, u.email, m.name as model, c.name as color, b.name as brand, car.created_at, car.updated_at, car.deleted_at ");
        $builder->join('modelcar m', 'm.id = car.id_modelcar');
        $builder->join('brand b', 'b.id = m.id_brand');
        $builder->join('color c', 'c.id = car.id_color');
        $builder->join('user u', 'u.id = car.id_user');
        // Recherche
        if ($searchValue != null) {
            $builder->like('modelcar.name', $searchValue);
            $builder->like('brand.name', $searchValue);
            $builder->like('color.name', $searchValue);
            $builder->like('user.username', $searchValue);
        }

        return $builder->countAllResults();
    }
}
