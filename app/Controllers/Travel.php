<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;


class Travel extends BaseController
{

    protected $require_auth = true;

    protected $requiredPermissions = ['administrateur','utilisateur','collaborateur'];
    public function getindex()
    {
        $utilisateur = $this->session->user;

        // vérifier si il y a un utilisateur
        if (isset($utilisateur))
        {
            //vérifier si la personne connectée à un permis
            $license = $this->session->user->getLicenseImage();
                if (isset($license) && ($license !== null )) {

                $card = $this->session->user->getCardImage();

                if (isset($card) && ($card !== null)) {

                    $car = $this->session->user->getCar();
                    if (isset($car) && ($car !== null )) {
                        return $this->view('travel/index', ['car'=> $car]);
                    }
                }
            }
        }

         else {
            return $this->redirect('index');
        }
    }

    public function postcreatetravel()
    {
        $data = $this->request->getPost();
        $user = $this->session->user->id;
        $travel_model = Model('TravelModel');

        $travel = [
            'nb_seat' => $data['nb_seat'],
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
               'nb_seat' => $data['nb_seat'],
               'order' => 1
           ];
           $first_etape = Model('EtapeModel')->createEtape($etape);

           if($first_etape){

               $second_etape = [
                   'id_travel' => $id_travel,
                   'id_city_departure' => $data['id_city_arrival'],
                   'date_departure' => $data['date_arrival'],
                   'adress_departure' => $data['adress_arrival'],
                    'nb_seat' => $data['nb_seat'],
                   'order' => 2
                   ];

               Model('EtapeModel')->createEtape($second_etape);

               $this->success('votre trajet à bien été créé');

               $this->redirect('/index');
           }

       } else {
           $this->error('une erreur est survenue');
       }

       return $this->redirect('/travel');
    }

    public function getresume()
    {
        $traveletape = $this->session->user->getTravelEtapeByUser();
        return $this->view('travel/resume', ['traveletape' => $traveletape]);
    }

    public function getautocompleteCity() {
        $searchValue = $this->request->getGet('q'); // Récupère le terme de recherche envoyé par Select2
        $cityModel = Model("CityModel");

        // Appelle la méthode de recherche dans le modèle
        $cities = $cityModel->searchCityByLabel($searchValue);


        // Formatage des résultats pour Select2
        $results = [];
        foreach ($cities as $city) {
            $results[] = [
                'id' => $city['id'],  // Utilise le slug comme ID pour redirection ultérieure
                'text' => $city['label']." ".$city['zip_code']." ".$city['department_name']// Ce texte sera affiché dans le dropdown de Select2
            ];
        }
        // Retourne les résultats sous forme JSON pour Select2
        return $this->response->setJSON($results);
    }

}
