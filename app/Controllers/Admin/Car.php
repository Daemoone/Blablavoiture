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
    return $this->view('/admin/car/index.php', ['car' => $car], true);
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
}
