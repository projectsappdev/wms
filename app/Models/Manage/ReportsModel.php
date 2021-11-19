<?php

namespace App\Models\Manage;

use CodeIgniter\Model;

class ReportsModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'signatures';
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
		'suffix',
		'position',
		'status',
		'created_at',
		'jo'
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
		$builder = $this->db->table('signatures');
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
	public function preparedByJo()
	{
		$where = "status = 1 and jo = 1";
		$builder = $this->db->table('signatures');
		$query = $builder->select('*')
			->where($where)
			->get();

		return $query->getResultArray();
	}
	public function preparedBy()
	{
		$where = "status = 1 and jo = 0";
		$builder = $this->db->table('signatures');
		$query = $builder->select('*')
			->where($where)
			->get();

		return $query->getResultArray();
	}
	public function approvedBy()
	{
		$where = "status = 3";
		$builder = $this->db->table('signatures');
		$query = $builder->select('*')
			->where($where)
			->get();
		return $query->getResultArray();
	}
	public function notedBy()
	{
		$where = "status = 2";
		$builder = $this->db->table('signatures');
		$query = $builder->select('*')
			->where($where)
			->get();
		return $query->getResultArray();
	}
}
