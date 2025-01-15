<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\UserPermissionModel;
class UserPermissionModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected function setUp(): void
    {
        parent::setUp();

        // Désactiver temporairement la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate les tables avant chaque test
        $this->db->table('user_permission')->truncate();

        // Réactiver la vérification des clés étrangères après la suppression
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Désactiver temporairement la vérification des clés étrangères avant de vider les tables
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        // Truncate les tables après chaque test
        $this->db->table('user_permission')->truncate();

        // Réactiver la vérification des clés étrangères après la suppression
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testCreatePermission()
    {
        $model = new UserPermissionModel();

        $data = [
            'name' => 'Admin',
        ];

        $result = $model->createPermission($data);

        // Vérifier que la permission a été insérée
        $this->assertTrue($result > 0);
        $this->seeInDatabase('user_permission', ['name' => 'Admin']);
    }

    public function testCreatePermissionWithUniqueSlug()
    {
        $model = new UserPermissionModel();

        // Crée une permission avec le nom "Admin"
        $data1 = ['name' => 'Admin'];
        $model->createPermission($data1);

        // Crée une autre permission avec un nom similaire
        $data2 = ['name' => 'Admin'];
        $model->createPermission($data2);

        // Vérifier que les slugs sont uniques
        $permission1 = $model->where('name', 'Admin')->first();
        $permission2 = $model->where('name', 'Admin')->orderBy('id', 'desc')->first();

        $this->assertNotEquals($permission1['slug'], $permission2['slug']);
    }

    public function testUpdatePermission()
    {
        $model = new UserPermissionModel();

        // Créer une permission pour la mise à jour
        $data = ['name' => 'Editor'];
        $model->createPermission($data);

        // Mise à jour de la permission
        $permission = $model->where('name', 'Editor')->first();
        $updatedData = ['name' => 'Editor Updated'];
        $model->updatePermission($permission['id'], $updatedData);

        // Vérifier que la permission a bien été mise à jour
        $this->seeInDatabase('user_permission', ['name' => 'Editor Updated']);
        $this->dontSeeInDatabase('user_permission', ['name' => 'Editor']);
    }

    public function testDeletePermission()
    {
        $model = new UserPermissionModel();

        // Créer une permission à supprimer
        $data = ['name' => 'Manager'];
        $model->createPermission($data);

        // Récupérer la permission pour suppression
        $permission = $model->where('name', 'Manager')->first();

        // Supprimer la permission
        $model->deletePermission($permission['id']);

        // Vérifier que la permission a bien été supprimée
        $this->dontSeeInDatabase('user_permission', ['name' => 'Manager']);
    }

    public function testGetPermissions()
    {
        $model = new UserPermissionModel();

        // Créer quelques permissions pour le test
        $data1 = ['name' => 'Admin'];
        $data2 = ['name' => 'Editor'];
        $model->createPermission($data1);
        $model->createPermission($data2);

        // Récupérer toutes les permissions
        $permissions = $model->getAllPermissions();

        $this->assertCount(2, $permissions);
        $this->assertEquals('Admin', $permissions[0]['name']);
        $this->assertEquals('Editor', $permissions[1]['name']);
    }

    public function testGetPermissionById()
    {
        $model = new UserPermissionModel();

        // Créer une permission pour tester la récupération
        $data = ['name' => 'SuperAdmin'];
        $model->createPermission($data);

        // Récupérer la permission par ID
        $permission = $model->where('name', 'SuperAdmin')->first();
        $retrievedPermission = $model->getUserPermissionById($permission['id']);

        $this->assertEquals($permission['name'], $retrievedPermission['name']);
    }

    public function testPagination()
    {
        $model = new UserPermissionModel();

        // Créer quelques permissions pour tester la pagination
        for ($i = 1; $i <= 20; $i++) {
            $model->createPermission(['name' => 'Permission ' . $i]);
        }

        // Récupérer les permissions paginées (10 par page)
        $permissions = $model->getPaginatedPermission(0, 10, null, 'name', 'asc');

        $this->assertCount(10, $permissions); // Devrait retourner 10 permissions
    }

    public function testFilteredPermissions()
    {
        $model = new UserPermissionModel();

        // Créer quelques permissions pour tester la recherche
        $model->createPermission(['name' => 'Admin']);
        $model->createPermission(['name' => 'Editor']);
        $model->createPermission(['name' => 'SuperAdmin']);  // Ce cas correspond également à "Admin" en raison de "SuperAdmin"

        // Tester la recherche par nom "Admin"
        $count = $model->getFilteredPermission('Admin');

        // Vérifier que la recherche retourne 2 permissions (Admin et SuperAdmin)
        $this->assertEquals(2, $count);  // La recherche "Admin" retourne 2 résultats : "Admin" et "SuperAdmin"
    }
}
