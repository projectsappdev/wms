<?php

namespace App\Models\Dashboard;

use CodeIgniter\Model;

class Dumpsite extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'waste_dump';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'volume',
		'waste_type',
		'dump_name',
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
	public function DailySubmissions()
	{
		date_default_timezone_set('Asia/Manila');
		$dayC = date('Y-m-d');
		$where = "DATE(created_at) = '$dayC'";
		$query = $this->where($where)
			->groupBy('dump_name')
			->get();

		return $query->getNumRows();
	}
	public function DailyWaste()
	{
		date_default_timezone_set('Asia/Manila');
		$dayC = date('Y-m-d');
		//	$db = db_connect();
		$where = "DATE(waste_dump.created_at) = '$dayC' AND waste_type.status = 1";
		$builder = $this->table('waste_dump');
		$builder->select('SUM(ROUND(waste_dump.volume, 2)) as vol, waste_type.waste as wasteName, waste_dump.waste_type as wasteType, waste_dump.created_at');
		$builder->join('waste_type', 'waste_dump.waste_type = waste_type.waste')
			->where($where)
			->groupBy('waste_type.waste');
		$data = $builder->get()->getResultArray();

		return $data;
	}
	public function FilteredWasteD($start_date, $end_date)
	{
		date_default_timezone_set('Asia/Manila');
		$where = "DATE( waste_dump.collection_date) BETWEEN '$start_date' AND '$end_date'";
		$builder = $this->table('waste_dump');
		$builder->select('SUM(ROUND(waste_dump.volume, 2)) as vol, waste_dump.waste_type as wasteName, waste_dump.waste_type as wasteType, waste_dump.collection_date');
		$builder->join('waste_type', 'waste_dump.waste_type = waste_type.waste')
			->where($where)
			->groupBy('waste_type.waste');

		$records = $builder->get()->getResult();

		return $records;
	}
}
