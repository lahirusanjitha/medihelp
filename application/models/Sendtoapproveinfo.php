<?php
class Sendtoapproveinfo extends CI_Model {

    public function updateApprovalStatus($ids) {
        if (empty($ids)) {
            return false;
        }

            $this->db->where_in('idtbl_job_list', $ids);
        return $this->db->update('tbl_job_list', ['approval_send' => 1]);

    }

}
