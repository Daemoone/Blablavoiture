<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\ColorModel;
class ColorModelTest extends CIUnitTestCase
{

    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    protected function setUp(): void
    {
        parent::setUp();
        // Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate the table before each test
        $this->db->table('color')->truncate();

        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncature des tables
        $this->db->table('color')->truncate();


        // Réactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testCreateColor()
    {
        $data = ['name' => 'Red'];
        $this->assertTrue($this->colorModel->createColor($data));
    }

    // Test de mise à jour d'une couleur
    public function testUpdateColor()
    {
        $data = ['name' => 'Blue'];
        $this->colorModel->createColor(['name' => 'Green']);
        $id = $this->colorModel->getColorByName('Green')[0]['id'];

        $this->assertTrue($this->colorModel->updateColor($id, $data));

        $updatedColor = $this->colorModel->getColorById($id);
        $this->assertEquals('Blue', $updatedColor[0]['name']);
    }

    // Test de suppression d'une couleur
    public function testDeleteColor()
    {
        $data = ['name' => 'Yellow'];
        $this->colorModel->createColor($data);
        $id = $this->colorModel->getColorByName('Yellow')[0]['id'];

        $this->assertTrue($this->colorModel->deleteColor($id));

        $deletedColor = $this->colorModel->getColorById($id);
        $this->assertEmpty($deletedColor);
    }

    // Test de récupération de toutes les couleurs
    public function testGetAllColors()
    {
        $this->colorModel->createColor(['name' => 'Purple']);
        $this->colorModel->createColor(['name' => 'Orange']);

        $colors = $this->colorModel->getAllColors();
        $this->assertCount(2, $colors);
    }

    // Test de récupération d'une couleur par ID
    public function testGetColorById()
    {
        $this->colorModel->createColor(['name' => 'Pink']);
        $id = $this->colorModel->getColorByName('Pink')[0]['id'];

        $color = $this->colorModel->getColorById($id);
        $this->assertEquals('Pink', $color[0]['name']);
    }

    // Test de récupération d'une couleur par nom
    public function testGetColorByName()
    {
        $this->colorModel->createColor(['name' => 'Cyan']);

        $color = $this->colorModel->getColorByName('Cyan');
        $this->assertNotEmpty($color);
        $this->assertEquals('Cyan', $color[0]['name']);
    }

    // Test de pagination des couleurs
    public function testGetPaginated()
    {
        $this->colorModel->createColor(['name' => 'Brown']);
        $this->colorModel->createColor(['name' => 'Black']);
        $this->colorModel->createColor(['name' => 'White']);

        $colors = $this->colorModel->getPaginated(0, 2, null, 'name', 'asc');
        $this->assertCount(2, $colors);
    }

    // Test du comptage total des couleurs
    public function testGetTotal()
    {
        $this->colorModel->createColor(['name' => 'Gray']);
        $this->colorModel->createColor(['name' => 'Pink']);

        $total = $this->colorModel->getTotal();
        $this->assertEquals(2, $total);
    }

    // Test du comptage des couleurs filtrées
    public function testGetFiltered()
    {
        $this->colorModel->createColor(['name' => 'Magenta']);
        $this->colorModel->createColor(['name' => 'Lavender']);

        $filtered = $this->colorModel->getFiltered('Lavender');
        $this->assertEquals(1, $filtered);
    }
}