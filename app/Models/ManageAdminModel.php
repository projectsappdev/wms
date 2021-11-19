<?php

namespace App\Models;

use CodeIgniter\Model;

class ManageAdminModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'administrators';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'lname',
		'fname',
		'mname',
		'account_type',
		'username',
		'position',
		'password',
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
		$builder = $this->db->table('administrators');
		return $builder;
	}
	public function button()
	{
		$action_button = function ($row) {
			return '
			<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['id'] . '"><i class="fas fa-pencil-alt"></i> </button>
            &nbsp;
            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i> </button>
			';
		};
		return $action_button;
	}
}
