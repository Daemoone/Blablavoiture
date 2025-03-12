<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservation';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user','id_travel','id_etape_departure','id_etape_arrival','nb_seat', 'created_at'];

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

    public function createReservation($data)
    {
        return $this->insert($data);
    }

    public function deleteReservation($id){
        return $this->delete($id);
    }

    public function getAllReservationsByUser($id_user){
        $this->select('reservation.*, t.*, e.adress_departure');
        $this->join('travel t', 't.id = reservation.id_travel');
        $this->where('reservation.id_user' , $id_user);
        return $this->findAll();
    }

    public function getReservationByUser ($id_user, $id_travel){
        $this->select('COUNT(*) as total');
        $this->where('id_user' , $id_user);
        $this->where('id_travel' , $id_travel);
        return $this->first();
    }
}
