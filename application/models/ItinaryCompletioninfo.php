<?php
class ItinaryCompletioninfo extends CI_Model{
    
    public function ItinaryCmpletionStatus($ids){
        $updatedatetime=date('Y-m-d H:i:s');

        if (empty($ids)) {
            return false;
        }

        $this->db->where_in('idtbl_job_list', $ids);
        return $this->db->update('tbl_job_list',[
        'completion' => 1,
        'updatedatetime'=> $updatedatetime
        ]);

    }
   
    }
 