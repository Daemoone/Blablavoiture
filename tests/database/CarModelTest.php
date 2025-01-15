<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\CarModel;
class CarModelTest extends CIUnitTestCase
{

    protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    use DatabaseTestTrait;

    protected $migrate = true;
    protected function setUp(): void
    {

        parent::setUp();

        $this->carModel = new CarModel();

        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table before each test
        $this->db->table('car')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver temporairement la vérification des clés étrangères avant de vider les tables
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');


        $this->db->table('car')->truncate();

        // Réactiver la vérification des clés étrangères après la suppression
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testCreateCar()
    {
        // Données à insérer
        $data = [
            'id_user'    => 1,
            'id_modelcar'=> 1,
            'id_color'   => 1
        ];

        // Tester l'insertion d'une nouvelle voiture
        $result = $this->carModel->createCar($data);

        // Vérifier que l'insertion retourne un ID valide
        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);

        // Vérifier si la voiture a bien été insérée dans la base
        $car = $this->carModel->getCarById($result);
        $this->assertEquals($data['id_user'], $car['id_user']);
        $this->assertEquals($data['id_modelcar'], $car['id_modelcar']);
        $this->assertEquals($data['id_color'], $car['id_color']);
    }

    public function testUpdateCar()
    {
        // Créer une voiture de test
        $data = [
            'id_user'    => 1,
            'id_modelcar'=> 1,
            'id_color'   => 1
        ];
        $carId = $this->carModel->createCar($data);

        // Données mises à jour
        $updatedData = [
            'id_user'    => 1,
            'id_modelcar'=> 2,
            'id_color'   => 2
        ];

        // Tester la mise à jour de la voiture
        $this->assertTrue($this->carModel->updateCar($carId, $updatedData));

        // Vérifier que les données de la voiture ont bien été mises à jour
        $car = $this->carModel->getCarById($carId);
        $this->assertEquals($updatedData['id_user'], $car['id_user']);
        $this->assertEquals($updatedData['id_modelcar'], $car['id_modelcar']);
        $this->assertEquals($updatedData['id_color'], $car['id_color']);
    }

    public function testDeleteCar()
    {
        // Créer une voiture de test
        $data = [
            'id_user'    => 1,
            'id_modelcar'=> 1,
            'id_color'   => 1
        ];
        $carId = $this->carModel->createCar($data);

        // Tester la suppression de la voiture
        $this->assertTrue($this->carModel->getdeleteCar($carId));

        // Vérifier que la voiture a bien été supprimée
        $car = $this->carModel->getCarById($carId);
        $this->assertNull($car);
    }

    public function testGetAllCars()
    {
        // Créer quelques voitures
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 2, 'id_modelcar' => 2, 'id_color' => 2]);

        // Tester la récupération de toutes les voitures
        $cars = $this->carModel->getAllCars();

        // Vérifier qu'on obtient bien les voitures créées
        $this->assertCount(2, $cars);
    }

    public function testGetCarByUser()
    {
        // Créer quelques voitures pour un utilisateur
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 2, 'id_color' => 2]);

        // Tester la récupération des voitures d'un utilisateur
        $cars = $this->carModel->getCarByUser(1);

        // Vérifier que l'utilisateur a bien les voitures créées
        $this->assertCount(2, $cars);
    }

    public function testGetCarByModel()
    {
        // Créer quelques voitures avec différents modèles
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 2, 'id_modelcar' => 2, 'id_color' => 2]);

        // Tester la récupération des voitures par modèle
        $cars = $this->carModel->getCarByModel(1);

        // Vérifier que le modèle est bien celui recherché
        $this->assertCount(1, $cars);
        $this->assertEquals(1, $cars[0]['id_modelcar']);
    }

    public function testGetPaginatedCars()
    {
        // Créer quelques voitures
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 2, 'id_modelcar' => 2, 'id_color' => 2]);
        $this->carModel->createCar(['id_user' => 3, 'id_modelcar' => 3, 'id_color' => 3]);

        // Tester la pagination
        $cars = $this->carModel->getPaginated(0, 2, null, 'id', 'ASC');

        // Vérifier que la pagination fonctionne et retourne 2 voitures
        $this->assertCount(2, $cars);
    }

    public function testGetTotalCars()
    {
        // Créer quelques voitures
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 2, 'id_modelcar' => 2, 'id_color' => 2]);

        // Tester le comptage total des voitures
        $total = $this->carModel->getTotal();

        // Vérifier que le total est bien 2
        $this->assertEquals(2, $total);
    }

    public function testGetFilteredCars()
    {
        // Créer quelques voitures
        $this->carModel->createCar(['id_user' => 1, 'id_modelcar' => 1, 'id_color' => 1]);
        $this->carModel->createCar(['id_user' => 2, 'id_modelcar' => 2, 'id_color' => 2]);

        // Tester le filtrage des voitures par modèle
        $totalFiltered = $this->carModel->getFiltered('modelcar name');

        // Vérifier que le nombre de voitures filtrées est correct
        $this->assertGreaterThan(0, $totalFiltered);
    }
}