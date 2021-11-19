<?php

namespace App\Controllers;

use App\Models\ManageBarangayModel;
use App\Models\Manage\WasteModel;
use App\Controllers\BaseController;
use App\Models\WasteBarangayModel;

class WasteBarangay extends BaseController
{

    public function index()
    {
        //
        $wasteModel = new WasteModel();
        $bModel = new ManageBarangayModel();
        $data['wasteAll'] = $wasteModel->findAll();
        $data['userB'] = $bModel->ListAllB();

        return view("admin/monitoring/brgy_waste_collection", $data);
    }
    public function table_data()
    {
        $model = new WasteBarangayModel();


        $dateFrom = $this->request->getVar('dateFrom');
        $select_waste = $this->request->getVar('select_waste');
        //    $select_name = json_decode($_COOKIE[$this->request->getVar('select_names')], TRUE);
        $select_name = $this->request->getVar('select_names');
        //$this->request->getVar('select_names');

        $dateTo = $this->request->getVar('dateTo');
        $listing = $model->get_datatables($select_waste, $dateFrom, $dateTo, $select_name);
        $count_data = $model->count_data();
        $filter_data = $model->filter_data($select_waste, $dateFrom, $dateTo, $select_name);
        $data = array();
        $no = $_POST['start'];

        foreach ($listing as $key) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->brgy_name;
            $row[] = $key->waste_type;
            $row[] = $key->volume;
            $date = date_create($key->collection_date);
            //   $date = date_create("2021-08-22 11:41:15");
            $row[] = date_format($date, "Y/m/d");
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count_data->jml,
            "recordsFiltered" => $filter_data->jml,
            "data" => $data
        );
        echo json_encode($output);
    }
    public function Try1()
    {
        $select = $this->request->getPost('select_names');
        $mySelection = '';

        foreach ($select as $widget) {
            $mySelection .= $widget . ", ";
        }
        $mySelection = preg_replace("/, $/", "",     $mySelection);
        echo ($mySelection);
    }

    public function Try()
    {
        $model = new WasteBarangayModel();
        $select_name = $this->request->getVar('select_name');
        $comma_separated = implode("', '", $select_name);
        $db = db_connect();

        $builder = $db->table('waste_brgy');
        $select_waste = "brgy_name IN ('$comma_separated')";
        $query = $builder->select('brgy_name')
            ->where($select_waste)
            ->get();


        echo json_encode($query->getResult());


        // Empty string when using an empty array:

    }
}
