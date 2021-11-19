<?php

namespace App\Models;

use CodeIgniter\Model;

class ManageBarangayModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'account_type',
		'name',
		'email',
		'phone_no',
		'username',
		'password',
		'superadmin_id',
		'created_at'
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function noticeFunction()
	{
		$builder = $this->db->table('users');
		return $builder;
	}
	public function button()
	{
		$action_button = function ($row) {
			return '
			<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i> Edit</button>
            &nbsp;
            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i> Delete</button>
			';
		};
		return $action_button;
	}
	public function listUser()
	{

		$db = db_connect();
		$builder = $db->table('users');
		$query = $builder->select('name, id')
			->where('account_type', 'Dumpsite')
			->orderBy('created_at', 'DESC')
			->get();

		return $query->getResultArray();
	}
	public function listAllB()
	{

		$db = db_connect();
		$builder = $db->table('users');
		$query = $builder->select('name, id')
			->where('account_type', 'Barangay')
			->orderBy('name', 'ASC')
			->get();

		return $query->getResultArray();
	}
	public function BrgyNumUsers()
	{

		$where = "account_type = 'Barangay'";
		$query = $this->where($where)
			->get();

		return $query->getNumRows();
	}
	public function DumpNumUsers()
	{

		$where = "account_type = 'Dumpsite'";
		$query = $this->where($where)
			->get();

		return $query->getNumRows();
	}
}
