<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reservation extends BaseController
{
    public function getindex($id = null)
    {
        $utilisateur = $this->session->user->id;
        $reservation = model("ReservationModel")->getAllReservation();
        
        return $this->view('reservation/index', ['reservation' => $reservation, 'user' => $utilisateur]);
    }

    public function postcreate(){
        $utilisateur = $this->session->user->id;
        $data = $this->request->getPost();
        $data['id_user'] = $utilisateur;
        $reservation = model('ReservationModel');
        if ($reservation->createReservation($data)){
            $this->success('ce trajet vous est réservez');
        } else {
            $this->error('une erreur est survenue');
        }
        $this->redirect('/reservation');
    }

    public function getdelete($id){
        $reservation = model('ReservationModel');
        if ($reservation->deleteReservation($id)){
            $this->success('la reservation a été annulée');
        } else {
            $this->error('une erreur est survenue');
        }
        $this->redirect('/reservation');
    }

    public function getuser_reservations(){
        $utilisateur = $this->session->user->id;
        $reservations = model('ReservationModel')->getAllReservationsByUser($utilisateur);
        return $this->view('reservation/user_reservations', ['reservations' => $reservations]);
    }
}
