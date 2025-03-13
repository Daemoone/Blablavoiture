<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reservation extends BaseController
{
    public function getindex($id = null)
    {
        $utilisateur = $this->session->user->id;
        $reservations = model('ReservationModel')->getAllReservationsByUser($utilisateur);
        if($reservations[0]['id'] != null) {
        foreach ($reservations as $index => $reservation) :
            $adresses = explode(',', $reservation['adresses']);
            $dates = explode(',', $reservation['dates']);
            foreach ($dates as $i => $date) {
                $dates[$i]=strtotime($date);
            }
            $reservations[$index]['adresses'] = $adresses;
            $reservations[$index]['dates'] = $dates;
        endforeach; } else {
            $reservations = [];
        }
        return $this->view('reservation/index', ['reservations' => $reservations , 'user' => $utilisateur]);
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
}
