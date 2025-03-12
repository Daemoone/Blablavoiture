<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\CityModel;
class CityModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    // Initialisation du modèle et de la base de données avant chaque test
    protected function setUp(): void
    {
        parent::setUp();

        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table before each test
        $this->db->table('city')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    // Nettoyage des données après le test
    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncature des tables
        $this->db->table('city')->truncate();


        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    // Exemple de test pour la méthode searchCityByLabel avec un paramètre de recherche
    public function testSearchCityByLabel()
    {
        // Insérer des données de test dans la table "city" pour le test
        $this->db->table('city')->insertBatch([
            [
                'zip_code' => '75001',
                'label' => 'Paris',
                'department_name' => 'Paris',
                'department_number' => '75',
                'region_name' => 'Île-de-France'
            ],
            [
                'zip_code' => '69001',
                'label' => 'Lyon',
                'department_name' => 'Rhône',
                'department_number' => '69',
                'region_name' => 'Auvergne-Rhône-Alpes'
            ],
            [
                'zip_code' => '13001',
                'label' => 'Marseille',
                'department_name' => 'Bouches-du-Rhône',
                'department_number' => '13',
                'region_name' => 'Provence-Alpes-Côte d\'Azur'
            ]
        ]);

        // Test de la méthode searchCityByLabel avec un critère de recherche
        $searchValue = 'Paris';
        $result = $this->cityModel->searchCityByLabel($searchValue);

        // Assertions pour vérifier le comportement attendu
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Paris', $result[0]['label']);
        $this->assertEquals('75001', $result[0]['zip_code']);

        // Test avec un autre critère de recherche
        $searchValue = '69'; // Code postal ou département
        $result = $this->cityModel->searchCityByLabel($searchValue);

        // Assertions pour vérifier que Lyon est trouvé
        $this->assertNotEmpty($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Lyon', $result[0]['label']);
    }

    // Test pour vérifier le cas où aucune ville ne correspond à la recherche
    public function testSearchCityByLabelNoResult()
    {
        // Test avec un critère de recherche qui n'existe pas
        $searchValue = 'NonExistantCity';
        $result = $this->cityModel->searchCityByLabel($searchValue);

        // Aucune ville ne correspond
        $this->assertEmpty($result);
    }



}