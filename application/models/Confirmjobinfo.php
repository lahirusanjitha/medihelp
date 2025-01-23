<?php
class Confirmjobinfo extends CI_Model {

    public function updateApprovalStatus($ids) {
        if (empty($ids)) {
            return false;
        }

        $this->db->where_in('idtbl_job_list', $ids);
        return $this->db->update('tbl_job_list', ['approval_send' => 3 ,'confirmation' => 1 ,'edit_request' => 0]);

    }

}
