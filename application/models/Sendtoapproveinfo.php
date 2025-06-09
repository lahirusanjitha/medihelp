<?php
class Sendtoapproveinfo extends CI_Model {

    public function updateApprovalStatus($ids) {
        $updatedatetime = date('Y-m-d H:i:s');

        if (empty($ids)) {
            return false;
        }

        $this->db->trans_start();

        $this->db->where_in('idtbl_job_list', $ids);
        $this->db->update('tbl_job_list', [
            'approval_send' => 1
        ]);

        $approvaldata = [];
        foreach ($ids as $id) {
            $approvaldata[] = [
                'tbl_joblist_idtbl_joblist' => $id,
                'datetime' => $updatedatetime
            ];
        }

        $this->db->insert_batch('tbl_sendtoapproval', $approvaldata);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}
