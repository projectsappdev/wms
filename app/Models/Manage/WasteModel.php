<?php

namespace App\Models\Manage;

use CodeIgniter\Model;

class WasteModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'waste_type';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'waste',
		'created_at',
		'status'
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
		$builder = $this->db->table('waste_type');
		return $builder;
	}
	public function button()
	{
		$action_button = function ($row) {
			return '
			<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></button>
            &nbsp;
            <button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i> </button>
			';
		};
		return $action_button;
	}
	public function fetchWaste()
	{

		$db = db_connect();
		$builder = $db->table('waste_type');
		$query = $builder->select('waste, status')
			->where('status', '1')

			->orderBy('waste', 'DESC')
			->get();

		return $query->getResultArray();
	}
	public function countRes()
	{
		$db = db_connect();
		$builder = $db->table('waste_type');
		$builder->where('status', '1');


		return $builder->countAllResults();
	}
}
