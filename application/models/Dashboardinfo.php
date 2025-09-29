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

public function getItineraryToApproveCount()
{
    $this->db->select('tbl_job_list.tbl_med_user_id, tbl_res_user.name, COUNT(tbl_job_list.idtbl_job_list) as request_count');
    $this->db->from('tbl_job_list');
    $this->db->join('tbl_res_user', 'tbl_job_list.tbl_med_user_id = tbl_res_user.idtbl_res_user');
    $this->db->where('tbl_job_list.approval_send', 1);
    $this->db->group_by('tbl_res_user.name');
    $query = $this->db->get();
    return $query->result(); 
}

 public function getPosponedToApproveCount()
    {
        $this->db->select('tbl_res_user.name, COUNT(tbl_job_list.idtbl_job_list) as request_count');
        $this->db->from('tbl_job_list');
        $this->db->join('tbl_res_user', 'tbl_job_list.tbl_med_user_id = tbl_res_user.idtbl_res_user');
        $this->db->where('tbl_job_list.postponed_request', 1);
        $this->db->group_by('tbl_res_user.name');
        $query = $this->db->get();
        return $query->result(); 
    }
 public function getEditRequestToApproveCount()
    {
        $this->db->select('tbl_res_user.name, COUNT(tbl_job_list.idtbl_job_list) as request_count');
        $this->db->from('tbl_job_list');
        $this->db->join('tbl_res_user', 'tbl_job_list.tbl_med_user_id = tbl_res_user.idtbl_res_user');
        $this->db->where('tbl_job_list.edit_request', 1);
        $this->db->group_by('tbl_res_user.name');
        $query = $this->db->get();
        return $query->result(); 
    }
 public function getECancelApproveCount()
    {
        $this->db->select('tbl_res_user.name, COUNT(tbl_job_list.idtbl_job_list) as request_count');
        $this->db->from('tbl_job_list');
        $this->db->join('tbl_res_user', 'tbl_job_list.tbl_med_user_id = tbl_res_user.idtbl_res_user');
        $this->db->where('tbl_job_list.cancel_request', 1);
        $this->db->group_by('tbl_res_user.name');
        $query = $this->db->get();
        return $query->result(); 
    }
    public function getTodayItineraryStatus()
    {
        $today   = date('Y-m-d');
        $type    = $this->session->userdata('type');
        $userid = $this->session->userdata('userid'); // adjust field if different

        $statusList = [];

        if ($type == 1 || $type == 2) {
            // Get all active users
            $this->db->select('idtbl_res_user, name');
            $this->db->where('status', 1);
            $this->db->where_not_in('idtbl_res_user', [1, 2]);
            $users = $this->db->get('tbl_res_user')->result();
        } else {
            // Only the logged-in user
            $this->db->select('idtbl_res_user, name');
            $this->db->where('status', 1);
            $this->db->where('idtbl_res_user', $userid);
            $users = $this->db->get('tbl_res_user')->result();
        }

        foreach ($users as $user) {
            $count = $this->db->from('tbl_job_list')
                ->where('tbl_med_user_id', $user->idtbl_res_user)
                ->like('instertdatetime', $today, 'after')
                ->count_all_results();

            $statusList[] = [
                'name'   => $user->name,
                'status' => ($count > 0)
            ];
        }

        return $statusList;
    }

   

}
?>
