<?php
class ChangeRequestinfo extends CI_Model{
    public function Jobstatus($x, $y){
        $this->db->trans_begin();

        $userID=$_SESSION['userid'];
        $recordID=$x;
        $type=$y;
        $updatedatetime=date('Y-m-d H:i:s');

        if($type==1){
            $data = array(
                'status' => '1',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_job_list', $recordID);
            $this->db->update('tbl_job_list', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fa fa-play';
                $actionObj->title='';
                $actionObj->message='Record Unpause Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');                
            } else {
                $this->db->trans_rollback();

                $actionObj=new stdClass();
                $actionObj->icon='fas fa-warning';
                $actionObj->title='';
                $actionObj->message='Record Error';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');
            }
        }
        else if($type==2){
         //   print_r($recordID);
            
            $data = array(
                'status' => '2',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_job_list', $recordID);
            $this->db->update('tbl_job_list', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fa fa-pause';
                $actionObj->title='';
                $actionObj->message='Record Pause Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='warning';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');                
            } else {
                $this->db->trans_rollback();

                $actionObj=new stdClass();
                $actionObj->icon='fas fa-warning';
                $actionObj->title='';
                $actionObj->message='Record Error';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');
            }
        }
        else if($type==3){
            $data = array(
                'status' => '3',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_job_list', $recordID);
            $this->db->update('tbl_job_list', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-times';
                $actionObj->title='';
                $actionObj->message='Job Canceled Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');                
            } else {
                $this->db->trans_rollback();

                $actionObj=new stdClass();
                $actionObj->icon='fas fa-warning';
                $actionObj->title='';
                $actionObj->message='Record Error';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');
            }
        }
}

    public function editRequest(){
    $this->db->trans_begin();

    $userID=$_SESSION['userid'];
    $job_id = $this->input->post('jobId');
    $reson_type = $this->input->post('reson_type');
    $comment = $this->input->post('reason');
    $type = $this->input->post('recordOption');
    $updatedatetime=date('Y-m-d H:i:s');

    if($type==1){
        $data = array(
            'request_date' => $updatedatetime,
            'comment' => $comment,
            'tbl_joblist_idtbl_joblist' => $job_id,
            'tbl_reason_type_idtbl_reason_type' => $reson_type,
            'tbl_med_user_idtbl_med_user' => $userID
        );

        $this->db->insert('tbl_edit_request', $data);
        
        $data1 = array(
            'edit_request' => '1',
            'updatedatetime'=> $updatedatetime
        );

        $this->db->where('idtbl_job_list', $job_id);
        $this->db->update('tbl_job_list', $data1);

        $logData[] = [
            'tbl_joblist_idtbl_joblist' => $recordID,
            'action' => 'editrequested',
            'datetime' => $updatedatetime
        ];

        $this->db->insert_batch('tbl_itinerary_log', $logData);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            
            $actionObj=new stdClass();
            $actionObj->icon='fas fa-check';
            $actionObj->title='';
            $actionObj->message='Change Request Successdully Send';
            $actionObj->url='';
            $actionObj->target='_blank';
            $actionObj->type='success';

            $actionJSON=json_encode($actionObj);
            
            $this->session->set_flashdata('msg', $actionJSON);
            redirect('ChangeRequest');                
        } else {
            $this->db->trans_rollback();

            $actionObj=new stdClass();
            $actionObj->icon='fas fa-warning';
            $actionObj->title='';
            $actionObj->message='Record Error';
            $actionObj->url='';
            $actionObj->target='_blank';
            $actionObj->type='danger';

            $actionJSON=json_encode($actionObj);
            
            $this->session->set_flashdata('msg', $actionJSON);
            redirect('ChangeRequest');
        }
    }
    // else if($type==2){
        
    //     $data = array(
    //         'confirmation' => '2',
    //         'approval_send'=> '0'
    //     );

    //     $this->db->where('idtbl_job_list', $recordID);
    //     $this->db->update('tbl_job_list', $data);

    //     $this->db->trans_complete();

    //     if ($this->db->trans_status() === TRUE) {
    //         $this->db->trans_commit();
            
    //         $actionObj=new stdClass();
    //         $actionObj->icon='fas fa-check';
    //         $actionObj->title='';
    //         $actionObj->message='Edit Request Approved Successfuly';
    //         $actionObj->url='';
    //         $actionObj->target='_blank';
    //         $actionObj->type='warning';

    //         $actionJSON=json_encode($actionObj);
            
    //         $this->session->set_flashdata('msg', $actionJSON);
    //         redirect('EditApproval');                
    //     } else {
    //         $this->db->trans_rollback();

    //         $actionObj=new stdClass();
    //         $actionObj->icon='fas fa-warning';
    //         $actionObj->title='';
    //         $actionObj->message='Record Error';
    //         $actionObj->url='';
    //         $actionObj->target='_blank';
    //         $actionObj->type='danger';

    //         $actionJSON=json_encode($actionObj);
            
    //         $this->session->set_flashdata('msg', $actionJSON);
    //         redirect('EditApproval');
    //     }
    // }
}

public function CancelRecord(){
    $this->db->trans_begin();

    $userID=$_SESSION['userid'];
    $job_id = $this->input->post('idtbl_job_list');
    $reson_type = $this->input->post('reson_type');
    $comment = $this->input->post('comment');

    $updatedatetime=date('Y-m-d H:i:s');

        $data = array(
            'comment'=> $comment,
            'tbl_reason_type_idtbl_reason_type'=>$reson_type, 
            'insertdatetime'=> $updatedatetime, 
            'tbl_reason_type_idtbl_reason_type	'=>$reson_type,
            'tbl_joblist_idtbl_joblist' =>$job_id,
            'tbl_med_user_idtbl_med_user'=> $userID

        );


        $this->db->insert('tbl_cancelation', $data);

        $data1 = array('cancel_request' => '1');
        $this->db->where('idtbl_job_list', $job_id);
        $this->db->update('tbl_job_list', $data1);

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            
            $actionObj=new stdClass();
            $actionObj->icon='fas fa-times';
            $actionObj->title='';
            $actionObj->message='Record Cancel requested successfuly';
            $actionObj->url='';
            $actionObj->target='_blank';
            $actionObj->type='danger';

            $actionJSON=json_encode($actionObj);
            
            $this->session->set_flashdata('msg', $actionJSON);
            redirect('ChangeRequest');  
        }
    }

    public function pospondRecord(){

        $this->db->trans_begin();

        $userID=$_SESSION['userid'];
        $job_id = $this->input->post('idtbl_job_list');
        $reason = $this->input->post('reason');
        $pospondDate = $this->input->post('inputDate');
        $postponedstarttime = $this->input->post('start_time');
        $postponedendtime = $this->input->post('end_time');
        $updatedatetime=date('Y-m-d H:i:s');
    
            $data = array(
                'postponed_date'=> $pospondDate, 
                'insertdatetime'=> $updatedatetime, 
                'postponed_starttime' => $postponedstarttime,
                'postponed_endtime' => $postponedendtime,
                'reason'=> $reason, 
                'status' => 2,
                'tbl_job_list_idtbl_job_list' =>$job_id,
                'tbl_res_user_idtbl_res_user'=> $userID
    
            );
    
    
            $this->db->insert('tbl_postponed', $data);
    
            $data1 = array('postponed_request' => 1);
            $this->db->where('idtbl_job_list', $job_id);
            $this->db->update('tbl_job_list', $data1);
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-pause';
                $actionObj->title='';
                $actionObj->message='Pospond Request Send successfuly';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';
    
                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');  
            }

    }
    public function getPostponedData($jobId){
        

        $this->db->select('postponed_date, postponed_starttime, postponed_endtime, reason');
        $this->db->from('tbl_postponed');
        $this->db->where('tbl_job_list_idtbl_job_list',$jobId);

        $query = $this->db->get();
        return $query->result();
        
    }
    public function getCancelData($jobId){
        
        $this->db->select('c.insertdatetime, r.reason_type, c.comment');
        $this->db->from('tbl_cancelation c');
        $this->db->join('tbl_reason_type r', 'r.idtbl_reason_type = c.tbl_reason_type_idtbl_reason_type', 'left');
        $this->db->where('tbl_joblist_idtbl_joblist',$jobId);

        $query = $this->db->get();
        return $query->result();
        
    }
    public function getEditData($jobId){
        
        $this->db->select('e.request_date, r.reason_type, e.comment');
        $this->db->from('tbl_edit_request e');
        $this->db->join('tbl_reason_type r', 'r.idtbl_reason_type = e.tbl_reason_type_idtbl_reason_type', 'left');
        $this->db->where('tbl_joblist_idtbl_joblist',$jobId);

        $query = $this->db->get();
        return $query->result();
        
    }
    public function approvePostponed($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['postponed_request' => '0','posponed' => '1']);
    }
    public function approveCancelRequest($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['cancel_request' => '0','confirmation' => '3']);
    }

    public function rejectCancelRequest($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['cancel_request' => '0']);
    }
    public function rejectPostponedRequest($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['postponed_request' => '0']);
    }

    public function approveEditRequest($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['confirmation' => '2', 'approval_send' => '0']); 
    }
    public function rejectEdit($jobId) {
        $this->db->where('idtbl_job_list', $jobId);
        return $this->db->update('tbl_job_list', ['edit_request' => '0']); 
    }



}