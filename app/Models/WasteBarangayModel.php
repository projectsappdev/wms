<?php

namespace App\Models;

use CodeIgniter\Model;

class WasteBarangayModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'waste_brgy';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [

        'volume',
        'waste_type',
        'brgy_name',
        'collection_date',
        'created_at',
        'brgy_id',
        'status',
        'attempt',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    /*function getAttempt()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $sess = session()->get('id');
        $where = "DATE(collection_date) = '$date' AND brgy_id = '$sess'";
        $query = $this->where($where)
            ->get();

        return $query->getResultArray();
    } */
    function timeStamps()
    {
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $query = $builder->select('*')
            ->orderBy('id', 'DESC')
            ->get();
        //   $query = $db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
        //     $result = $query->getRow();
        return $query->getRowArray();
    }
    function updateStatus()
    {
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $data = [
            'status' => 0,
        ];
        $builder->where('status', '1');
        $builder->update($data);
    }
    function seen_notif()
    {
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $query = $builder->select('status, brgy_id')
            ->where("status", "1")
            ->groupBy("brgy_id")
            ->get();

        return $query->getResultArray();
    }

    var $column_order = array('id', 'volume', 'brgy_name', 'collection_date');

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
            $data_select_waste = "AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } else if ($select_names != 1 && $select_waste != 1 && $dateFrom != "") { # 111
            $data_select_waste = "AND waste_type = '$select_waste' AND brgy_id IN ('$select_names') AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } else if ($select_waste == 1 && $select_names == 1 && $dateFrom != "") {
            $data_select_waste = "AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } else if ($select_names != 1 && $select_waste != 1 && $dateFrom == "") { #Added this block of code for backlogs
            $data_select_waste = "AND waste_type = '$select_waste' AND brgy_id IN ('$select_names') AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } elseif ($select_waste != 1 && $select_names == 1 && $dateFrom != "") {   #100
            $data_select_waste = "AND waste_type = '$select_waste' AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } elseif ($select_waste == 1 && $select_names != 1 && $dateFrom != "") {
            $data_select_waste = " AND brgy_id IN ('$select_names') AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } elseif ($select_waste != 1 && $select_names == 1 && $dateFrom == "") {   #100
            $data_select_waste = "AND waste_type = '$select_waste' AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } elseif ($select_waste == 1 && $select_names != 1 && $dateFrom == "") {
            $data_select_waste = " AND brgy_id IN ('$select_names') AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        }


        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $data_search = "brgy_name LIKE '%$search%' '$data_select_waste'";
        } else {
            $data_search = "id != '' $data_select_waste";
        }

        if ($_POST['length'] != -1) {
            $db = db_connect();
            $builder = $db->table('waste_brgy');
            $query = $builder->select('*')
                ->where($data_search)
                ->orderBy('collection_date', 'DESC')
                ->limit($_POST['length'], $_POST['start'])
                ->get();

            return $query->getResult();
        }
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $query = $builder->select('*')
            ->where($data_search)
            ->orderBy('collection_date', 'DESC')

            ->get();

        return $query->getResult();
    }

    function count_data()
    {
        $squery = "SELECT COUNT(id) as jml FROM waste_brgy";
        $db = db_connect();
        $query = $db->query($squery)->getRow();
        return $query;
    }

    function filter_data($select_waste, $dateFrom, $dateTo,  $select_name)
    {
        date_default_timezone_set("Asia/Manila");
        //  $select_names = implode("', '", $select_name);
        $select_names = implode("', '", $select_name);
        $date1 = date_create($dateFrom);
        $FromDate = date_format($date1, "Y-m-d");
        $date = date_create($dateTo);
        $ToDate = date_format($date, "Y-m-d");
        if ($select_names == 1 && $select_waste == 1 && $dateFrom == "" && $dateTo == "") {  # 000
            $data_select_waste = "AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } else if ($select_names != 1 && $select_waste != 1 && $dateFrom != "") { # 111
            $data_select_waste = "AND waste_type = '$select_waste' AND brgy_id IN ('$select_names') AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } else if ($select_waste == 1 && $select_names == 1 && $dateFrom != "") {
            $data_select_waste = "AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } else if ($select_names != 1 && $select_waste != 1 && $dateFrom == "") { #Added this block of code for backlogs
            $data_select_waste = "AND waste_type = '$select_waste' AND brgy_id IN ('$select_names') AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } elseif ($select_waste != 1 && $select_names == 1 && $dateFrom != "") {   #100
            $data_select_waste = "AND waste_type = '$select_waste' AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } elseif ($select_waste == 1 && $select_names != 1 && $dateFrom != "") {
            $data_select_waste = " AND brgy_id IN ('$select_names') AND DATE_FORMAT(collection_date, '%Y-%m-%d') BETWEEN DATE('$FromDate') AND DATE('$ToDate')";
        } elseif ($select_waste != 1 && $select_names == 1 && $dateFrom == "") {   #100
            $data_select_waste = "AND waste_type = '$select_waste' AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        } elseif ($select_waste == 1 && $select_names != 1 && $dateFrom == "") {
            $data_select_waste = " AND brgy_id IN ('$select_names') AND DATE(collection_date) BETWEEN DATE(SUBDATE(NOW(), INTERVAL 1 DAY)) AND CURDATE()";
        }


        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $data_search = "AND brgy_name LIKE '%$search%' $data_select_waste";
        } else {
            $data_search = "";
        }

        $squery = "SELECT COUNT(id) as jml FROM waste_brgy WHERE id != '' $data_search";
        $db = db_connect();
        $query = $db->query($squery)->getRow();
        return $query;
    }

    public function getWasteType()
    {
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $query = $builder->select('waste_type')
            ->orderBy('collection_date', 'DESC')
            ->groupBy('waste_type')
            ->get();

        return $query->getResult();
    }
    public function CurrentData()
    {
        $sess = session()->get('name');
        $db = db_connect();
        $builder = $db->table('waste_brgy');
        $query = $builder->select('waste_type, volume, attempt')
            ->where("brgy_name = '$sess' AND DATE(collection_date) = CURDATE()")
            ->orderBy('collection_date', 'DESC')
            ->get();

        return $query->getResultArray();
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
    public function getRowsubmittedData()
    {
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $sess = session()->get('id');
        $where = "DATE(collection_date) = '$date' AND brgy_id = '$sess'";
        $query = $this->where($where)
            ->groupBy("brgy_id")
            ->get();

        return $query->getNumRows();
    }
    public function viewN()
    {
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');
        $db = db_connect();

        $where = "status = 0 AND DATE(collection_date) = '$date' ";
        $builder = $db->table('waste_brgy');
        $query = $builder->select('*')
            ->where($where)
            ->groupBy('brgy_name')
            ->orderBy('collection_date', 'DESC')
            // 
            ->get();

        return $query->getResultArray();
    }
    public function updateData()
    {
        $sess = session()->get('name');
        $where = "brgy_name = '$sess' AND DATE(collection_date) = CURDATE()";
        $builder = $this->db->table('waste_brgy');
        $builder->where($where);


        return $builder;
    }
    public function getSubmissionDateDB($varBacklog)
    {

        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d');
        $bid = session()->get('id');
        $where = "brgy_id = '$bid' AND DATE(collection_date) = '$varBacklog' ";
        $builder = $this->db->table('waste_brgy');
        $query = $builder->select('*')
            ->where($where)
            ->orderBy('collection_date', 'DESC')
            // 
            ->get();

        return $query->getResult();
    }
}
