<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_agama_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Unitkerja.Masters.View',
			'description' => 'View Unitkerja Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Unitkerja.Masters.Create',
			'description' => 'Create Unitkerja Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Unitkerja.Masters.Edit',
			'description' => 'Edit Unitkerja Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Unitkerja.Masters.Delete',
			'description' => 'Delete Unitkerja Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Agama.Masters.View',
			'description' => 'View Agama Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Agama.Masters.Create',
			'description' => 'Create Agama Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Agama.Masters.Edit',
			'description' => 'Edit Agama Masters',
			'status' => 'active',
		),
		array(
			'name' => 'Agama.Masters.Delete',
			'description' => 'Delete Agama Masters',
			'status' => 'active',
		),
    );

    /**
     * @var string The name of the permission key in the role_permissions table
     */
    private $permissionKey = 'permission_id';

    /**
     * @var string The name of the permission name field in the permissions table
     */
    private $permissionNameField = 'name';

	/**
	 * @var string The name of the role/permissions ref table
	 */
	private $rolePermissionsTable = 'role_permissions';

    /**
     * @var numeric The role id to which the permissions will be applied
     */
    private $roleId = '1';

    /**
     * @var string The name of the role key in the role_permissions table
     */
    private $roleKey = 'role_id';

	/**
	 * @var string The name of the permissions table
	 */
	private $tableName = 'permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$rolePermissionsData = array();
		foreach ($this->permissionValues as $permissionValue) {
			$this->db->insert($this->tableName, $permissionValue);

			$rolePermissionsData[] = array(
                $this->roleKey       => $this->roleId,
                $this->permissionKey => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->rolePermissionsTable, $rolePermissionsData);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
        $permissionNames = array();
		foreach ($this->permissionValues as $permissionValue) {
            $permissionNames[] = $permissionValue[$this->permissionNameField];
        }

        $query = $this->db->select($this->permissionKey)
                          ->where_in($this->permissionNameField, $permissionNames)
                          ->get($this->tableName);

        if ( ! $query->num_rows()) {
            return;
        }

        $permissionIds = array();
        foreach ($query->result() as $row) {
            $permissionIds[] = $row->{$this->permissionKey};
        }

        $this->db->where_in($this->permissionKey, $permissionIds)
                 ->delete($this->rolePermissionsTable);

        $this->db->where_in($this->permissionNameField, $permissionNames)
                 ->delete($this->tableName);
	}
}