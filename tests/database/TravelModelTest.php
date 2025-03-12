<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\TravelModel;

class TravelModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    protected function setUp(): void
    {
        parent::setUp();
        $this->travelModel = new TravelModel();
        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table before each test
        $this->db->table('travel')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncature des tables
        $this->db->table('travel')->truncate();


        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    // Test de création d'un voyage
    public function testCreateTravel()
    {
        $data = [
            'id_user'   => 1,
            'id_car'    => 101,
            'nb_seat'   => 4,
            'comment'   => 'Trip to the beach'
        ];

        $this->assertTrue($this->travelModel->createTravel($data));
    }

    // Test de mise à jour d'un voyage
    public function testUpdateTravel()
    {
        $data = [
            'id_user'   => 1,
            'id_car'    => 101,
            'nb_seat'   => 4,
            'comment'   => 'Trip to the beach'
        ];

        // Créer un voyage
        $this->travelModel->createTravel($data);
        $id = $this->travelModel->getTravelByUser(1)[0]['id'];

        // Mise à jour du voyage
        $updatedData = ['comment' => 'Trip to the mountains'];
        $this->assertTrue($this->travelModel->updateTravel($id, $updatedData));

        // Vérification de la mise à jour
        $updatedTravel = $this->travelModel->getTravelByIdAndUser($id, 1);
        $this->assertEquals('Trip to the mountains', $updatedTravel['comment']);
    }

    // Test de suppression d'un voyage
    public function testDeleteTravel()
    {
        $data = [
            'id_user'   => 1,
            'id_car'    => 102,
            'nb_seat'   => 5,
            'comment'   => 'Trip to the city'
        ];

        // Créer un voyage
        $this->travelModel->createTravel($data);
        $id = $this->travelModel->getTravelByUser(1)[0]['id'];

        // Suppression du voyage
        $this->assertTrue($this->travelModel->deleteTravel($id));

        // Vérification de la suppression
        $deletedTravel = $this->travelModel->getTravelByIdAndUser($id, 1);
        $this->assertNull($deletedTravel);
    }

    // Test de récupération des voyages par utilisateur
    public function testGetTravelByUser()
    {
        $data1 = [
            'id_user'   => 1,
            'id_car'    => 103,
            'nb_seat'   => 3,
            'comment'   => 'Trip to the countryside'
        ];

        $data2 = [
            'id_user'   => 1,
            'id_car'    => 104,
            'nb_seat'   => 2,
            'comment'   => 'Trip to the mountains'
        ];

        // Créer deux voyages pour le même utilisateur
        $this->travelModel->createTravel($data1);
        $this->travelModel->createTravel($data2);

        // Récupérer les voyages de l'utilisateur avec id_user = 1
        $travels = $this->travelModel->getTravelByUser(1);

        $this->assertCount(2, $travels);
        $this->assertEquals('Trip to the countryside', $travels[0]['comment']);
        $this->assertEquals('Trip to the mountains', $travels[1]['comment']);
    }

    // Test de récupération d'un voyage par ID et utilisateur
    public function testGetTravelByIdAndUser()
    {
        $data = [
            'id_user'   => 1,
            'id_car'    => 105,
            'nb_seat'   => 4,
            'comment'   => 'Trip to the park'
        ];

        // Créer un voyage
        $this->travelModel->createTravel($data);
        $id = $this->travelModel->getTravelByUser(1)[0]['id'];

        // Récupérer le voyage par id et utilisateur
        $travel = $this->travelModel->getTravelByIdAndUser($id, 1);

        $this->assertNotEmpty($travel);
        $this->assertEquals('Trip to the park', $travel['comment']);
    }
}