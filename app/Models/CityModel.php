<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table            = 'city';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['zip_code', 'label', 'department_name','department_number','region_name'];

    public function searchCityByLabel($searchValue, $limit = 10){
        return $this->select('id,label,zip_code,department_name')
            ->like('label', $searchValue)
            ->orLike('zip_code', $searchValue)
            ->findAll($limit);
    }
}
