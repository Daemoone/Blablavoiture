<?php

namespace App\Models;

use CodeIgniter\Model;

class TravelModel extends Model
{
    protected $table            = 'travel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user','id_car','nb_seat','comment'];

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

    public function createTravel($data)
    {
        return $this->insert($data);
    }

    public function updateTravel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTravel($id)
    {
        return $this->delete($id);
    }

    public function getTravelById($id)
    {
        $this->select("travel.id, u.username, u.last_name, u.first_name, u.email, u.phone, c.id, c.zip_code, c.label, c.department_name, c.department_number, c.region_name");
        $this->join('user u', 'u.id = travel.user_id');
        $this->join('city c', 'c.id = travel.city_id');
        $this->join('reservation r', 'r.id_travel = travel.id');
        return $this->find($id);
    }

    public function getTravelByUser($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }
}
