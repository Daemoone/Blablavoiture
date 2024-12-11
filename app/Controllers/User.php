<?php

namespace App\Controllers;

use App\Controllers\BaseController;
class User extends BaseController
{
    protected $require_auth = true;
    public function getindex()
    {
        $um = model("UserModel");
        $utilisateur = $um->getUserById($this->session->user->id);
        $car = model('CarModel')->getCarByUser($utilisateur['id']);
        return $this->view('user/index', ['utilisateur' => $utilisateur, 'car' => $car]);
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $um = Model("UserModel");

        // Créer l'utilisateur et obtenir son ID
        $newUserId = $um->createUser($data);

        // Vérifier si la création a réussi
        if ($newUserId) {
            // Vérifier si des fichiers ont été soumis dans le formulaire
            $files = $this->request->getFiles();
            if ($files && $files->getError() !== UPLOAD_ERR_NO_FILE) {
                // Préparer les données du média
                $mediaData = [
                    'entity_type' => 'user',
                    'entity_id'   => $newUserId,   // Utiliser le nouvel ID de l'utilisateur
                ];

                // Utiliser la fonction upload_files() pour gérer l'upload et les données du média
                $uploadResult = upload_filess($files, 'avatar', $data['username'], $mediaData);

                // Vérifier le résultat de l'upload
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // Afficher un message d'erreur détaillé et rediriger
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/user/new");
                }
            }
            if ($files['license_image'] && $files['license_image']->getError() !== UPLOAD_ERR_NO_FILE) {
                $mediaData = [
                    'entity_type' => 'license',
                    'entity_id' => $data['id'],   // Utiliser l'ID de l'utilisateur
                ];

                $uploadResult = upload_filess($files['license_image'], 'license', $data['username'], $mediaData, false, ['image/jpeg', 'image/png', 'image/jpg']);
                if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                    // Afficher un message d'erreur détaillé et rediriger
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    return $this->redirect("/user");
                }
                if ($files['card_image'] && $files['card_image']->getError() !== UPLOAD_ERR_NO_FILE) {
                    $mediaData = [
                        'entity_type' => 'card',
                        'entity_id' => $data['id'],   // Utiliser l'ID de l'utilisateur
                    ];
                    $uploadResult = upload_filess($files['card_image'], 'card', $data['username'], $mediaData, false, ['image/jpeg', 'image/png', 'image/jpg']);
                    if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                        // Afficher un message d'erreur détaillé et rediriger
                        $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                        return $this->redirect("/user");
                    }
                }
            }

            $this->success("Votre compte à bien été créer");
            $this->redirect("/user");
        } else {
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
            $this->redirect("/user/new");
        }
    }


    public function postupdate() {
        // Récupération des données envoyées via POST
        $data = $this->request->getPost();

        // Récupération du modèle UserModel
        $um = Model("UserModel");

        // Vérifier si un fichier a été soumis dans le formulaire
        $files = $this->request->getFiles();
        if($files['profile_image'] && $files['profile_image']->getError() !== UPLOAD_ERR_NO_FILE)
        {
            $mm = Model('MediaModel');
            // Récupérer l'ancien média avant l'upload
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'user');

            // Préparer les données du média pour le nouvel upload
            $mediaData = [
                'entity_type' => 'user',
                'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
            ];
            // Utiliser la fonction upload_files() pour gérer l'upload et enregistrer les données du média
            $uploadResult = upload_filess($files['profile_image'], 'avatar', $data['username'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);

            // Vérifier le résultat de l'upload
            if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                // Afficher un message d'erreur détaillé et rediriger
                $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                return $this->redirect("/user");
            }

            // Si l'upload est un succès, suppression de l'ancien média
            if ($old_media) {
                $mm->deleteMedia($old_media[0]['id']);
            }
        }
        if($files['license_image'] && $files['license_image']->getError() !== UPLOAD_ERR_NO_FILE) {
            $mm = Model('MediaModel');
            // Récupérer l'ancien média avant l'upload
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'license');
            $mediaData = [
                'entity_type' => 'license',
                'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
            ];
            $uploadResult = upload_files($files['license_image'], 'license', $data['username'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
            if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                // Afficher un message d'erreur détaillé et rediriger
                $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                return $this->redirect("/user");
            }

            // Si l'upload est un succès, suppression de l'ancien média
            if ($old_media) {
                $mm->deleteMedia($old_media[0]['id']);
            }
        }
        if($files['card_image'] && $files['card_image']->getError() !== UPLOAD_ERR_NO_FILE) {
            $mm = Model('MediaModel');
            // Récupérer l'ancien média avant l'upload
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'card');
            $mediaData = [
                'entity_type' => 'card',
                'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
            ];
            $uploadResult = upload_files($files['card_image'], 'card', $data['username'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
            if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                // Afficher un message d'erreur détaillé et rediriger
                $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                return $this->redirect("/user");
            }

            // Si l'upload est un succès, suppression de l'ancien média
            if ($old_media) {
                $mm->deleteMedia($old_media[0]['id']);
            }
        }

        // Mise à jour des informations utilisateur dans la base de données
        if ($um->updateUser($data['id'], $data)) {
            // Si la mise à jour réussit
            $this->success("L'utilisateur a bien été modifié.");
        } else {
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }

        // Redirection vers la page des utilisateurs après le traitement
        return $this->redirect("/user");
    }


    public function getdeactivate($id){
        $um = Model('UserModel');
        if ($um->deleteUser($id)) {
            $this->success("Utilisateur désactivé");
        } else {
            $this->error("Utilisateur non désactivé");
        }
        $this->redirect('/admin/user');
    }

    /**
     * Renvoie pour la requete Ajax les stocks fournisseurs rechercher par SKU ( LIKE )
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function postSearchUser()
    {
        $UserModel = model('App\Models\UserModel');

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
        $data = $UserModel->getPaginatedUser($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $UserModel->getTotalUser();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $UserModel->getFilteredUser($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}