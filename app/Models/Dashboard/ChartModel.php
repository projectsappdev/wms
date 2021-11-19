<?php

namespace App\Models\Dashboard;

use CodeIgniter\Model;

class ChartModel extends Model
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
		'created_at',
		'waste_type',
		'brgy_name',
		'volume'
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

	public function fetch_day()
	{
		$builder = $this->table('waste_brgy');
		$query = $builder->select('created_at, volume, waste_type')
			->groupBy('waste_type')
			->orderBy('created_at', 'DESC')
			->get();

		return $query->getResultArray();
	}
	public function fetch_chart_data($waste)
	{
		$where = "waste_type = '$waste' AND WEEK(collection_date) = WEEK(NOW())";
		$builder = $this->table('waste_brgy');
		$query = $builder->select('DAYNAME(collection_date) as collection_date, SUM(ROUND(volume, 2)) as volume, waste_type')
			->where($where)
			->groupBy('DAYNAME(collection_date)')
			->orderBy('collection_date', 'ASC')
			->get();
		return $query->getResultArray();
	}
}
