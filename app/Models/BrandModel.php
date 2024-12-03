<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table            = 'brands';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function createBrand($data)
    {
        return $this->insert($data);
    }

    public function postupdateBrand($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBrand($id)
    {
        return $this->delete($id);
    }

    public function getAllBrands()
    {
        return $this->findAll();
    }

    public function getBrandById($id)
    {
        return $this->where('id', $id)->find();
    }

    public function getBrandByName($name)
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
