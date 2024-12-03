<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Car extends BaseController
{
    protected $require_auth = true;
    protected $require_role = ['administrateur'];

    public function getindex($id = null)
    {
        $car = model('CarModel')->getAllCars();
       if ($id == null) {
        return $this->view('/admin/car/index.php', ['car' => $car], true);
    } else {
        $car = model('CarModel')->getCarById($id);
        $modelcar = model('ModelCarModel')->getAllModelCar();
        $color = model('ColorModel')->getAllColors();
        return $this->view('/admin/car/car', ['car' => $car, 'modelcar' => $modelcar, 'color' => $color],true);
    }
    }

    public function postupdate()
    {
        $data = $this->request->getPost();
        $car = model('CarModel');
        if ($car->updateCar($data['id'], $data)) {
            $this->success("la voiture à bien été modifiée");
        } else {
            $errors = $car->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        } $this->redirect('admin/car');
    }

    public function postcreatecolor()
    {
        $data = $this->request->getPost();
        $colormodel = model('ColorModel');
        if ($colormodel->insert($data)) {
            $this->success('couleur bien ajoutée');
        } else {
            $this->error('une erreur est survenue');
        }
        $this->redirect('/admin/car/color');
    }

    public function getdeletecolor($id) {
        $color = model ('ColorModel');
        if ($color->deleteColor($id)) {
            $this->success("couleur supprimée avec succès");
        } else {
            $this->error("une erreur est survenue");
        }
        $this->redirect('/admin/car/color');
    }

    public function postupdatecolor()
    {
        $data = $this->request->getPost();
        $colormodel = model('ColorModel');
        if ($colormodel->updatecolor($data['id'], $data)) {
            $this->success('couleur bien modifiée');
        } else {
            $this->error('une erreur est survenue');
        } $this->redirect('/admin/car/color');
    }

    public function postcreatemodelcar()
    {
        $data = $this->request->getPost();
        $modelcar = model('ModelCarModel');
        if ($modelcar->insert($data)) {
            $this->success('couleur bien ajoutée');
        } else {
            $this->error('une erreur est survenue');
        }
        $this->redirect('/admin/car/modelcar');
    }
    public function postupdatemodelcar()
    {
        $data = $this->request->getPost();
        $modelcar = model('ModelCarModel');
        if ($modelcar->updatemodelcar($data['id'], $data)) {
            $this->success('couleur bien ajoutée');
        } else {
            $this->error('une erreur est survenue');
        }
        $this->redirect('/admin/car/modelcar');
    }

    public function getdeletemodelcar($id) {
        $modelcar = model('ModelCarModel');
        if ($modelcar->deletemodelcar($id)) {
            $this->success("modèle supprimé avec succès");
        } else {
            $this->error("une erreur est survenue");
        }
        $this->redirect('/admin/car/modelcar');
    }

    public function postsearchdatatable()
    {
        $model_name = $this->request->getPost('model');
        $model = model($model_name);

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';

        // Obtenez les données triées et filtrées
        $data = $model->getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $model->getTotal();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $model->getFiltered($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
    public function postSearchColor()
    {
        $ColorModel = model('App\Models\ColorModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';


        // Obtenez les données triées et filtrées
        $data = $ColorModel->getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $ColorModel->getTotal();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $ColorModel->getFiltered($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function getcolor($id=null)
    {
        if ($id == null) {
            return $this->view('/admin/car/color.php', [], true);
        } elseif( $id == 'new') {
            return $this->view('/admin/car/colorupdate.php', [], true);
        } else {
            $color = Model('ColorModel')->getColorById($id);
            if ($color){
                return $this->view('/admin/car/colorupdate.php', ['color' => $color], true);
            } else {
                $this->error('une erreur est survenue');
                return $this->view('/admin/car/color.php', [], true);
            }
        }
    }

    public function getmodelcar($id=null)
    {
        if ($id == null) {
            return $this->view('/admin/car/modelcar.php', [], true);
        } elseif( $id == 'new') {
            return $this->view('/admin/car/modelcarupdate.php', [], true);
        } else {
            $modelcar = model('ModelCarModel')->getModelCarById($id);
            if ($modelcar){
                return $this->view('/admin/car/modelcarupdate.php', ['modelcar' => $modelcar], true);
            } else {
                $this->error('une erreur est survenue');
                return $this->view('/admin/car/modelcar.php', [], true);
            }
        }
    }

    public function postSearchModelCar()
    {
        $ColorModel = model('App\Models\ModelCarModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';


        // Obtenez les données triées et filtrées
        $data = $ColorModel->getPaginated($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $ColorModel->getTotal();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $ColorModel->getFiltered($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}
