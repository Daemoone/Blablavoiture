<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TravelEtapeModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;


class Travel extends BaseController
{

    protected $require_auth = true;

    protected $requiredPermissions = ['administrateur', 'utilisateur', 'collaborateur'];

    public function getindex($id = null)
    {
        // Récupérer l'utilisateur connecté depuis la session
        $utilisateur = $this->session->user;

        // Vérifier si un utilisateur est connecté
        if (isset($utilisateur)) {

            // Récupérer l'image du permis de conduire de l'utilisateur
            $license = $this->session->user->getLicenseImage();

            // Vérifier si l'image du permis de conduire existe
            if (isset($license) && ($license !== null)) {

<<<<<<< HEAD
=======

>>>>>>> modify
                // Si le permis de conduire existe, récupérer l'image de la carte (probablement une autre pièce justificative)
                $card = $this->session->user->getCardImage();

                // Vérifier si l'image de la carte existe
                if (isset($card) && ($card !== null)) {

                    // Si la carte existe, récupérer la voiture associée à l'utilisateur
                    $car = $this->session->user->getCar();

                    // Vérifier si la voiture existe
                    if (isset($car) && ($car !== null)) {
                        // Si tout est valide (permis, carte, voiture), afficher la vue avec la voiture de l'utilisateur

<<<<<<< HEAD
                    } else {
                        $this->redirect('/user');
                    }
                } else {
                    $this->redirect('/user');
                }
            } else {
=======
                    } else { 
                        $this->error('vous avez besoin d\'un véhicule');
                        $this->redirect('/user');
                    }
                } else {
                    $this->error('vous avez besoin d\'une carte d\'identité');
                    $this->redirect('/user');
                }
            } else {
                $this->error('vous avez besoin d\'un permis');
>>>>>>> modify
                $this->redirect('/user');
            }


            if ($id == null) {

                $traveletape = $this->session->user->getTravelEtapeByUser();

                return $this->view('travel/index', ['traveletape' => $traveletape]);

            } else {

                $car = $this->session->user->getCar();

                if ($id == 'new') {

                    return $this->view('travel/new', ['car' => $car]);

                } else {


                    // Si l'ID est fourni en paramètre, récupérer les informations de voyage liées à l'utilisateur et à cet ID
                    $traveletape = model('App\Models\TravelEtapeModel')->getTravelByIdAndUser($id, $this->session->user->id);


                    if($traveletape){
                        // Retourner la vue avec la voiture de l'utilisateur et les étapes du voyage
                        return $this->view('travel/update', ['traveletape' => $traveletape]);
                    }
                    else {
                        $this->error('ce trajet n\'existe pas');
                        $this->redirect('/travel');
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function postcreate()
    {
        $data = $this->request->getPost();
        $user = $this->session->user->id;
        $travel_model = Model('TravelModel');

        $travel = [
            'nb_seat' => $data['total_seat'],
            'id_car' => $data['id_car'],
            'id_user' => $user,
            'comment' => $data['comment'],
        ];

        $id_travel = $travel_model->insert($travel);

        if ($id_travel) {

            $etape = [
                'id_travel' => $id_travel,
                'id_city_departure' => $data['id_city_departure'],
                'adress_departure' => $data['adress_departure'],
                'date_departure' => $data['date_departure'],
                'nb_seat' => $data['total_seat'],
                'order' => 1
            ];
            $first_etape = Model('EtapeModel')->createEtape($etape);

            if ($first_etape) {

                $second_etape = [
                    'id_travel' => $id_travel,
                    'id_city_departure' => $data['id_city_arrival'],
                    'date_departure' => $data['date_arrival'],
                    'adress_departure' => $data['adress_arrival'],
                    'nb_seat' => $data['total_seat'],
                    'order' => 2
                ];

                Model('EtapeModel')->createEtape($second_etape);

                $this->success('votre trajet à bien été créé');

                $this->redirect('/travel');
            }

        } else {
            $this->error('une erreur est survenue');
        }

        return $this->redirect('/travel');
    }

    public function getautocompleteCity()
    {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2
        $cityModel = Model("CityModel");

        // Appelle la méthode de recherche dans le modèle
        $cities = $cityModel->searchCityByLabel($searchValue);


        // Formatage des résultats pour Select2
        $results = [];
        foreach ($cities as $city) {
            $results[] = [
                'id' => $city['id'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $city['label'] . " " . $city['zip_code'] . " " . $city['department_name']// Ce texte sera affiché dans le dropdown de Select2
            ];
        }
        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }

    public function postupdate()
    {
        $data = $this->request->getPost();
        $user = $this->session->user->id;
        $travel_model = Model('TravelModel');

        $travel = [
            'nb_seat' => $data['total_seat'],
            'id_car' => $data['id_car'],
            'id_user' => $user,
            'comment' => $data['comment'],
        ];

        if ($travel_model->updateTravel($data['travel_id'], $travel))

        {
            $etape = [
                'id_city_departure' => $data['id_city_departure'],
                'adress_departure' => $data['adress_departure'],
                'date_departure' => $data['date_departure'],
                'nb_seat' => $data['total_seat'],
                'order' => 1
            ];
            $first_etape = model('EtapeModel')->updateEtape($data['id_etape_departure'], $etape);

            if ($first_etape) {

                $second_etape = [
                    'id_city_departure' => $data['id_city_arrival'],
                    'date_departure' => $data['date_arrival'],
                    'adress_departure' => $data['adress_arrival'],
                    'nb_seat' => $data['total_seat'],
                    'order' => 2];

                Model('EtapeModel')->updateEtape($data['id_etape_arrival'], $second_etape);
            }

            $this->success('votre trajet à bien été modifié');

        } else {
            $this->error('une erreur est survenue');
            }

        return $this->redirect('/travel');

    }

    public function getdelete($id = null)
    {


        if($id) {

            $etape = model('EtapeModel');
            $etape->deleteEtapeByIdTravel($id);
            $travel = Model('TravelModel');
            if($travel->deleteTravel($id)) {
                $this->success('le trajet à été supprimé');
            } else {
                $this->error('une erreur est survenue');
            }
            return $this->redirect('/travel');
        }
    }

    public function getsearch(){
        $id_user = $this->session->user->id;
<<<<<<< HEAD
    $all_travels = model('TravelEtapeModel')->getTravelByOthersUsers($id_user);

    return $this->view('travel/search', ['all_travels' => $all_travels]);

    }

    public function getconsult($id)
    {

        $travel = model('TravelEtapeModel')->getTravelById($id);

        return $this->view('travel/consult', ['travel' => $travel]);
=======
        $all_travels = model('TravelEtapeModel')->getTravelByOthersUsers($id_user);

        return $this->view('travel/search', ['all_travels' => $all_travels]);

    }

    public function getconsult($id_travel)
    {
        $id_user = $this->session->user->id;
        $travel = model('TravelEtapeModel')->getTravelById($id_travel);
        $reservation = model('ReservationModel')->getReservationByUser($id_user, $id_travel);

        return $this->view('travel/consult', ['travel' => $travel, 'reservation' => $reservation]);
>>>>>>> modify
    }
}
