<?php

namespace App\Models\Dashboard;

use CodeIgniter\Model;

class Users extends Model
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
		'name',
		'account_type'

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

	public function dailySubmission()
	{
		date_default_timezone_set('Asia/Manila');
		$dayC = date('Y-m-d');
		$where = "users.account_type = 'Barangay'	";
		$builder = $this->table('users');
		$builder->select('users.account_type, users.name as bNames, users.id, waste_brgy.brgy_id as bid, waste_brgy.brgy_name, DATE(waste_brgy.collection_date) as collections');
		$builder->join('waste_brgy', 'users.id = waste_brgy.brgy_id', 'left')
			->where($where)
			->orderBy('bNames', 'ASC')
			->groupBy('bNames');

		$data = $builder->get()->getResultArray();

		return $data;
	}
}
