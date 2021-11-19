<?php

namespace App\Models;

use CodeIgniter\Model;

class WasteDumpsiteModel extends Model
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
		'dump_name',
		'created_at',
		'collection_date',
		'updated_at',
		'waste_type',
		'dump_id',
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

	var $column_order = array('id', 'volume', 'dump_name', 'created_at');

	var $order = array('id' => 'asc');

	function get_datatables($select_waste, $dateFrom, $dateTo, $select_name)
	{
		date_default_timezone_set("Asia/Manila");
		$date1 = date_create($dateFrom);
		$FromDate = date_format($date1, "Y-m-d");
		$date = date_create($dateTo);
		$ToDate = date_format($date, "Y-m-d");

		$select_names = implode("', '", $select_name);
		//  $data_select_waste = "AND DATE(created_at) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
		if ($select_names == 1 && $select_waste == 1 && $dateFrom == "" && $dateTo == "") {  # 000
			$data_select_waste = "AND DATE(created_at) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
		} else if ($select_names != 1 && $select_waste != 1 && $dateFrom != "") { # 111
			$data_select_waste = "AND waste_type = '$select_waste' AND dump_id IN ('$select_names') AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} else if ($select_waste == 1 && $select_names == 1 && $dateFrom != "") {
			$data_select_waste = "AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} else if ($select_names != 1 && $select_waste != 1 && $dateFrom == "") { #Added this block of code for backlogs
			$data_select_waste = "AND waste_type = '$select_waste' AND dump_id IN ('$select_names') AND DATE(created_at) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
		} elseif ($select_waste != 1 && $select_names == 1) {   #100
			$data_select_waste = "AND waste_type = '$select_waste' AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} elseif ($select_waste == 1 && $select_names != 1) {
			$data_select_waste = " AND dump_id IN ('$select_names') AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		}

		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$data_search = "dump_name LIKE '%$search%' $data_select_waste";
		} else {
			$data_search = "id != '' $data_select_waste";
		}
		/*   if ($_POST['order']) {
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];
        } else if ($this->order) {
            $order = $this->order;
            $result_order = key($order);
            $result_dir = $order[key($order)];
        } */
		if ($_POST['length'] != -1) {
			$db = db_connect();
			$builder = $db->table('waste_dump');
			$query = $builder->select('*')
				->where($data_search)
				->orderBy('dump_name', 'ASC')
				->limit($_POST['length'], $_POST['start'])
				->get();

			return $query->getResult();
		}
		$db = db_connect();
		$builder = $db->table('waste_dump');
		$query = $builder->select('*')
			->where($data_search)
			->orderBy('dump_name', 'DESC')

			->get();

		return $query->getResult();
	}

	function count_data()
	{
		$squery = "SELECT COUNT(id) as jml FROM waste_dump";
		$db = db_connect();
		$query = $db->query($squery)->getRow();
		return $query;
	}

	function filter_data($select_waste, $dateFrom, $dateTo, $select_name)
	{
		date_default_timezone_set("Asia/Manila");
		//  $select_names = implode("', '", $select_name);
		$select_names = implode("', '", $select_name);
		$date1 = date_create($dateFrom);
		$FromDate = date_format($date1, "Y-m-d");
		$date = date_create($dateTo);
		$ToDate = date_format($date, "Y-m-d");
		if ($select_names == 1 && $select_waste == 1 && $dateFrom == "" && $dateTo == "") {  # 000
			$data_select_waste = "AND DATE(created_at) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
		} else if ($select_names != 1 && $select_waste != 1 && $dateFrom != "") { # 111
			$data_select_waste = "AND waste_type = '$select_waste' AND dump_id IN ('$select_names') AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} else if ($select_waste == 1 && $select_names == 1 && $dateFrom != "") {
			$data_select_waste = "AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} else if ($select_names != 1 && $select_waste != 1 && $dateFrom == "") { #Added this block of code for backlogs
			$data_select_waste = "AND waste_type = '$select_waste' AND dump_id IN ('$select_names') AND DATE(created_at) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
		} elseif ($select_waste != 1 && $select_names == 1) {   #100
			$data_select_waste = "AND waste_type = '$select_waste' AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		} elseif ($select_waste == 1 && $select_names != 1) {
			$data_select_waste = " AND dump_id IN ('$select_names') AND DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
		}
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$data_search = "AND dump_name LIKE '%$search%' $data_select_waste";
		} else {
			$data_search = "";
		}

		$squery = "SELECT COUNT(id) as jml FROM waste_dump WHERE id != '' $data_search";
		$db = db_connect();
		$query = $db->query($squery)->getRow();
		return $query;
	}
	public function CurrentData()
	{
		$sess = session()->get('name');
		$db = db_connect();
		$builder = $db->table('waste_dump');
		$query = $builder->select('waste_type, volume')
			->where("dump_name = '$sess' AND DATE(created_at) = CURDATE()")
			->orderBy('created_at', 'DESC')
			->get();

		return $query->getResultArray();
	}
	public function updateData()
	{
		$sess = session()->get('name');
		$where = "dump_name = '$sess' AND DATE(created_at) = CURDATE()";
		$builder = $this->db->table('waste_dump');
		$builder->where($where);


		return $builder;
	}
	public function backlogData()
	{
		$yd = date('Y-m-d', strtotime("-1 days"));
		$sess = session()->get('name');
		$where = "dump_name = '$sess' AND DATE(created_at) = '$yd' ";
		$builder = $this->db->table('waste_dump');
		$builder->where($where);


		return $builder;
	}
	public function button()
	{
		$action_button = function ($row) {
			return '
			<button type="button" name="edit" class="btn btn-info btn-sm edit" data-id="' . $row['id'] . '"><i class="fas fa-pencil-alt"></i> </button>
            &nbsp;
            			';
		};
		return $action_button;
	}
}
