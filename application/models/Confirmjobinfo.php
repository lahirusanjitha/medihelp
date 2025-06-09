<?php
class Confirmjobinfo extends CI_Model {

public function updateApprovalStatus($ids) {
    $updatedatetime = date('Y-m-d H:i:s');

    if (empty($ids)) {
        return false;
    }

    $this->db->trans_start();

    $this->db->where_in('idtbl_job_list', $ids);
    $this->db->update('tbl_job_list', [
        'approval_send' => 3,
        'confirmation' => 1,
        'edit_request' => 0,
        'reject_status' => 0
    ]);

    $approvedData = [];
    foreach ($ids as $id) {
        $approvedData[] = [
            'tbl_joblist_idtbl_joblist' => $id,
            'approvedatetime' => $updatedatetime
        ];
    }

    $this->db->insert_batch('tbl_approval_list', $approvedData);

    $this->db->trans_complete();

    return $this->db->trans_status();
}


    public function rejectApproval($ids)
{
    $updatedatetime = date('Y-m-d H:i:s');

    if (empty($ids)) {
        return false;
    }

    $this->db->trans_start();

    $this->db->where_in('idtbl_job_list', $ids);
    $this->db->update('tbl_job_list', [
        'approval_send' => 0,
        'confirmation' => 2,
        'edit_request' => 0,
        'reject_status' => 1
    ]);

    $rejectedData = [];
    foreach ($ids as $id) {
        $rejectedData[] = [
            'tbl_joblist_idtbl_joblist' => $id,
            'rejecteddatetime' => $updatedatetime
        ];
    }

    $this->db->insert_batch('tbl_rejected_itinary', $rejectedData);

    $this->db->trans_complete();

    return $this->db->trans_status();
}


}
