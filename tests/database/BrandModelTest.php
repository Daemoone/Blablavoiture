<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\BrandModel;

class BrandModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';
    protected function setUp(): void
    {
        parent::setUp();

        // Initialisation du modèle BrandModel
        $this->brandModel = new BrandModel();

        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table before each test
        $this->db->table('brand')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncature des tables
        $this->db->table('brand')->truncate();


        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }


    public function testCreateBrand()
    {
        // Données à insérer
        $data = ['name' => 'Test Brand'];

        // Tester l'insertion d'une nouvelle marque
        $result = $this->brandModel->createBrand($data);

        // Vérifier que l'insertion retourne un ID valide
        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);

        // Vérifier si la marque a bien été insérée dans la base
        $brand = $this->brandModel->getBrandById($result);
        $this->assertEquals('Test Brand', $brand[0]['name']);
    }

    public function testUpdateBrand()
    {
        // Créer une marque de test
        $data = ['name' => 'Brand to Update'];
        $brandId = $this->brandModel->createBrand($data);

        // Données à mettre à jour
        $updatedData = ['name' => 'Updated Brand'];

        // Tester la mise à jour de la marque
        $this->assertTrue($this->brandModel->postupdateBrand($brandId, $updatedData));

        // Vérifier si la mise à jour a bien été effectuée
        $brand = $this->brandModel->getBrandById($brandId);
        $this->assertEquals('Updated Brand', $brand[0]['name']);
    }

    public function testDeleteBrand()
    {
        // Créer une marque de test
        $data = ['name' => 'Brand to Delete'];
        $brandId = $this->brandModel->createBrand($data);

        // Supprimer les éléments dans modelcar qui référencent cette marque
        $this->db->table('modelcar')->where('id_brand', $brandId)->delete();

        // Tester la suppression de la marque
        $this->assertTrue($this->brandModel->deleteBrand($brandId));

        // Vérifier que la marque n'existe plus
        $brand = $this->brandModel->getBrandById($brandId);
        $this->assertEmpty($brand);
    }

    public function testGetAllBrands()
    {
        // Créer quelques marques
        $this->brandModel->createBrand(['name' => 'Brand 1']);
        $this->brandModel->createBrand(['name' => 'Brand 2']);
        $this->brandModel->createBrand(['name' => 'Brand 3']);

        // Tester la récupération de toutes les marques
        $brands = $this->brandModel->getAllBrands();

        // Vérifier qu'on obtient au moins 3 marques
        $this->assertCount(3, $brands);
    }

    public function testGetBrandByName()
    {
        // Créer une marque
        $this->brandModel->createBrand(['name' => 'Brand Search']);

        // Tester la récupération de la marque par son nom
        $brand = $this->brandModel->getBrandByName('Brand Search');

        // Vérifier que la marque récupérée a bien le nom 'Brand Search'
        $this->assertEquals('Brand Search', $brand[0]['name']);
    }

    public function testGetPaginatedBrands()
    {
        // Créer quelques marques
        $this->brandModel->createBrand(['name' => 'Brand 1']);
        $this->brandModel->createBrand(['name' => 'Brand 2']);
        $this->brandModel->createBrand(['name' => 'Brand 3']);
        $this->brandModel->createBrand(['name' => 'Brand 4']);

        // Tester la pagination
        $brands = $this->brandModel->getPaginated(0, 2, null, 'name', 'ASC');

        // Vérifier qu'on obtient 2 marques pour la première page
        $this->assertCount(2, $brands);
    }

    public function testGetTotalBrands()
    {
        // Créer quelques marques
        $this->brandModel->createBrand(['name' => 'Brand 1']);
        $this->brandModel->createBrand(['name' => 'Brand 2']);

        // Tester le comptage total des marques
        $total = $this->brandModel->getTotal();

        // Vérifier que le total est bien 2
        $this->assertEquals(2, $total);
    }

    public function testGetFilteredBrands()
    {
        // Créer quelques marques
        $this->brandModel->createBrand(['name' => 'Brand A']);
        $this->brandModel->createBrand(['name' => 'Brand B']);
        $this->brandModel->createBrand(['name' => 'Brand C']);

        // Tester la recherche filtrée par nom
        $totalFiltered = $this->brandModel->getFiltered('Brand A');

        // Vérifier que le nombre de marques filtrées est 1
        $this->assertEquals(1, $totalFiltered);
    }
}