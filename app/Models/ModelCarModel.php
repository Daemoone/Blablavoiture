<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCarModel extends Model
{
    protected $table            = 'modelcar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name', 'id_brand'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function createModelCar($data)
    {
        return $this->insert($data);
    }

    public function updateModelCar($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteModelCar($id)
    {
        return $this->delete($id);
    }

    public function getAllModelCar(){
        return $this->findAll();
    }

    public function getModelCarById($id)
    {
        return $this->where('id', $id)->find();
    }

    public function getModelCarByName($name)
    {
        return $this->where('name', $name)->find();
    }

    public function getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();

        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
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
        return $builder->countAllResults();
    }

    public function getFiltered($searchValue)
    {
        $builder = $this->builder();

        // @phpstan-ignore-next-line
        if (! empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }
}