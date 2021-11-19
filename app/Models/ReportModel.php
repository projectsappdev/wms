<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
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

	public function allData()
	{
		return $this->db->table('waste_brgy')->get()->getResultArray();
	}
	public function weeklyData($select_data)
	{
		$start = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
		$finish = (date('D') != 'Sun') ? date('Y-m-d', strtotime('next Sunday')) : date('Y-m-d');
		$format = date('N', strtotime($start));
		$formatF = date('N', strtotime($finish));
		$ranges = range($format, $formatF);

		$selects = "waste_type = '$select_data' AND DATE(created_at) BETWEEN '$start' AND '$finish'";
		$db = db_connect();
		$builder = $db->table('waste_brgy');
		$query = $builder->select(
			'waste_brgy.brgy_name,			
		    MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[1] . '" THEN ROUND(waste_brgy.volume, 2) END) "tuesday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[2] . '" THEN ROUND(waste_brgy.volume, 2) END) "wednesday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[3] . '" THEN ROUND(waste_brgy.volume, 2) END) "thursday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[4] . '" THEN ROUND(waste_brgy.volume, 2) END) "friday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[5] . '" THEN ROUND(waste_brgy.volume, 2) END) "saturday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[6] . '" THEN ROUND(waste_brgy.volume, 2) END) "sunday",
			MAX(CASE WHEN WEEKDAY(waste_brgy.created_at)+1 = "' . $ranges[0] . '" THEN ROUND(waste_brgy.volume, 2) END) "monday"'

		)
			->where($selects)
			->groupBy('waste_brgy.brgy_name')
			->orderBy('waste_brgy.brgy_name', 'ASC')

			->get();

		return $query->getResultArray();
	}
	public function monthlyData($select_data)
	{


		$selects = "MONTH(created_at) = MONTH(CURDATE()) AND waste_type ='$select_data'";
		$db = db_connect();
		$builder = $db->table('waste_brgy');
		$query = $builder->select(
			'DATE(created_at) AS date_c ,SUM(ROUND(volume, 2)) AS sumVol,brgy_name'
		)
			->where($selects)
			->groupBy('Date(created_at)')
			->orderBy('date_c', 'ASC')

			->get();

		return $query->getResultArray();
	}
	public function monthlyDataExcel($select_data)
	{


		$selects = "MONTH(created_at) = MONTH(CURDATE()) AND waste_type ='$select_data'";
		$db = db_connect();
		$builder = $db->table('waste_brgy');
		$query = $builder->select(
			'DATE(created_at) AS date_c ,SUM(ROUND(volume, 2)) AS sumVol,brgy_name'
		)
			->where($selects)
			->groupBy('Date(created_at)')
			->orderBy('date_c', 'ASC')

			->get();

		return $query->getResultArray();
	}
	public function	DailyValidationSummaryReport($select_data)
	{

		$selects = "MONTH(created_at) = MONTH(CURDATE()) AND waste_type ='$select_data'";
		$db = db_connect();
		$builder = $db->table('waste_brgy');
		$query = $builder->select(
			'DATE(created_at) AS date_c ,SUM(ROUND(volume, 2)) AS sumVol,brgy_name'
		)
			->where($selects)
			->groupBy('Date(created_at)')
			->orderBy('date_c', 'ASC')

			->get();

		return $query->getResultArray();
	}
}
