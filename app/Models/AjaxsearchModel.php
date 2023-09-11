<?php

namespace App\Models;

use CodeIgniter\Model;

class AjaxsearchModel extends Model
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('pendaftaran');
    }

	public function fetch_data($query)
	{
		$this->builder->select("*");
		if($query != '')
		{
			$this->builder->like('name', $query);
			$this->builder->orLike('program_studi', $query);
		}
		$this->builder->orderBy('id', 'DESC');
		return $this->builder->get();
	}

	public function fetch_data_admin($query)
	{
		$this->builder->select("*");
		if($query != '')
		{
			$this->builder->like('name', $query);
			$this->builder->orLike('nim', $query);
			$this->builder->orLike('program_studi', $query);
		}
		$this->builder->orderBy('id', 'DESC');
		return $this->builder->get();
	}


    
}
