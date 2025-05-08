<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardinfo extends CI_Model {
    public function getUser(){
        $this->db->select('`idtbl_res_user`,`name`');
        $this->db->from('tbl_res_user');
        $this->db->where('status', 1);

       return $repond = $this->db->get();
    }

    private function applyFilter($query, $year, $month, $bdm) {
        if ($year) {
            $query->where('YEAR(month)', $year); 
        }
        if ($month) {
            $query->where('MONTH(month)', $month); 
        }
        if ($bdm) {
            $query->where('tbl_job_list.tbl_med_user_id', $bdm); 
        }
        return $query;
    }
    
    public function getPostponedRecords($year = null ,$month = null, $bdm = null) {
        $query = $this->db->select('idtbl_job_list as id, start_date, start_time ,end_time, tbl_itenary_type.itenary_type, tbl_itenary_category.itenary_category, tbl_itenary_group.group')
                          ->from('tbl_job_list')
                          ->join('tbl_itenary_type', 'tbl_job_list.tbl_itenary_type_tblid_itenary_type = tbl_itenary_type.idtbl_itenary_type', 'left')
                          ->join('tbl_itenary_group', 'tbl_job_list.tbl_itenary_group_id = tbl_itenary_group.tblid_itenary_group', 'left')
                          ->join('tbl_itenary_category', 'tbl_job_list.tbl_itenary_category_id = tbl_itenary_category.idtbl_itenary_category', 'left')
                          ->where('tbl_job_list.posponed', 1);
        $query = $this->applyFilter($query, $year, $month, $bdm); 
        return $query->get()->result_array();
    }
    

    public function getCanceledRecords($year = null ,$month = null, $bdm = null) {
        $query = $this->db->select('idtbl_job_list as id, start_date,  start_time ,end_time, tbl_itenary_type.itenary_type, tbl_itenary_category.itenary_category, tbl_itenary_group.group')
                          ->from('tbl_job_list')
                          ->join('tbl_itenary_type', 'tbl_job_list.tbl_itenary_type_tblid_itenary_type = tbl_itenary_type.idtbl_itenary_type', 'left')
                          ->join('tbl_itenary_group', 'tbl_job_list.tbl_itenary_group_id = tbl_itenary_group.tblid_itenary_group', 'left')
                          ->join('tbl_itenary_category', 'tbl_job_list.tbl_itenary_category_id = tbl_itenary_category.idtbl_itenary_category', 'left')
                          ->where('tbl_job_list.confirmation', 3);
        $query = $this->applyFilter($query, $year, $month, $bdm); 
        return $query->get()->result_array();
    }

    public function getCompletedRecords($year = null ,$month = null, $bdm = null) {
        $query = $this->db->select('idtbl_job_list as id, start_date, start_time ,end_time, tbl_itenary_type.itenary_type, tbl_itenary_category.itenary_category, tbl_itenary_group.group')
                          ->from('tbl_job_list')
                          ->join('tbl_itenary_type', 'tbl_job_list.tbl_itenary_type_tblid_itenary_type = tbl_itenary_type.idtbl_itenary_type', 'left')
                          ->join('tbl_itenary_group', 'tbl_job_list.tbl_itenary_group_id = tbl_itenary_group.tblid_itenary_group', 'left')
                          ->join('tbl_itenary_category', 'tbl_job_list.tbl_itenary_category_id = tbl_itenary_category.idtbl_itenary_category', 'left')
                          ->where('tbl_job_list.completion', 1);
        $query = $this->applyFilter($query, $year, $month, $bdm); 
        return $query->get()->result_array();
    }

    public function getMissingRecords($year = null ,$month = null, $bdm = null) {
        $query = $this->db->select('idtbl_job_list as id, start_date, start_time ,end_time, tbl_itenary_type.itenary_type, tbl_itenary_category.itenary_category, tbl_itenary_group.group')
                          ->from('tbl_job_list')
                          ->join('tbl_itenary_type', 'tbl_job_list.tbl_itenary_type_tblid_itenary_type = tbl_itenary_type.idtbl_itenary_type', 'left')
                          ->join('tbl_itenary_group', 'tbl_job_list.tbl_itenary_group_id = tbl_itenary_group.tblid_itenary_group', 'left')
                          ->join('tbl_itenary_category', 'tbl_job_list.tbl_itenary_category_id = tbl_itenary_category.idtbl_itenary_category', 'left')
                          ->where('tbl_job_list.status', 1)
                          ->where('tbl_job_list.completion', 2);
        $query = $this->applyFilter($query, $year, $month, $bdm); 
        return $query->get()->result_array();
    }
}
?>
