<?php

namespace App\Models;

use CodeIgniter\Model;

class TravelEtapeModel extends Model
{
    protected $table            = 'travel_etape';

    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['travel_id', 'user_id', 'car_id', 'total_seat', 'travel_comment','car_owner_id','car_model_name','car_color','departure_adress','departure_date','departure_seat','departure_order','arrival_adress','arrival_date','arrival_seat','arrival_order','departure_city_label','arrival_city_label','departure_department_number','arrival_department_number'];


    public function getTravelEtapeByUser($id_user)
    {
        return $this->where('user_id', $id_user)->findAll();
    }
}
