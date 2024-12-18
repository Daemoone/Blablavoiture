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

    public function getTravelByUser($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }
}
