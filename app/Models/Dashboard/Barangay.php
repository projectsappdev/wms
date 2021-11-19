<?php

namespace App\Models\Dashboard;

use CodeIgniter\Model;

class Barangay extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'waste_brgy';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'volume',
		'waste_type',
		'brgy_name',
		'created_at',
		'collection_date',
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

	public function DailySubmissions()
	{
		date_default_timezone_set('Asia/Manila');
		$dayC = date('Y-m-d');
		$where = "DATE(created_at) = '$dayC'";
		$query = $this->where($where)
			->groupBy('brgy_name')
			->get();

		return $query->getNumRows();
	}
	public function DailyWaste()
	{
		date_default_timezone_set('Asia/Manila');
		$dayC = date('Y-m-d');
		//	$db = db_connect();
		$builder = $this->table('waste_brgy');
		$builder->select('SUM(ROUND(waste_brgy.volume, 2)) as vol, waste_type.waste as wasteName, waste_brgy.waste_type as wasteType, waste_brgy.collection_date');
		$builder->join('waste_type', 'waste_brgy.waste_type = waste_type.waste')
			->where('DATE( waste_brgy.collection_date)', $dayC)
			->groupBy('waste_type.waste');
		$data = $builder->get()->getResultArray();

		return $data;
	}
	public function FilteredWasteB($start_date, $end_date)
	{
		date_default_timezone_set('Asia/Manila');
		$where = "DATE( waste_brgy.collection_date) BETWEEN '$start_date' AND '$end_date'";
		$builder = $this->table('waste_brgy');
		$builder->select('SUM(ROUND(waste_brgy.volume, 2)) as vol, waste_type.waste as wasteName, waste_brgy.waste_type as wasteType, waste_brgy.collection_date');
		$builder->join('waste_type', 'waste_brgy.waste_type = waste_type.waste')
			->where($where)
			->groupBy('waste_type.waste');

		$records = $builder->get()->getResult();

		return $records;
	}
}
