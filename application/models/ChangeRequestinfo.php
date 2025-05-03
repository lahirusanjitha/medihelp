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

public function Editrequest($x, $y){
    $this->db->trans_begin();

    $userID=$_SESSION['userid'];
    $recordID=$x;
    $type=$y;
    $updatedatetime=date('Y-m-d H:i:s');

    if($type==1){
        $data = array(
            'edit_request' => '1',
            'updatedatetime'=> $updatedatetime
        );

        $this->db->where('idtbl_job_list', $recordID);
        $this->db->update('tbl_job_list', $data);

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
    else if($type==2){
        
        $data = array(
            'edit_request' => '2',
            'updatedatetime'=> $updatedatetime
        );

        $this->db->where('idtbl_job_list', $recordID);
        $this->db->update('tbl_job_list', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            
            $actionObj=new stdClass();
            $actionObj->icon='fas fa-check';
            $actionObj->title='';
            $actionObj->message='Edit Request Approved Successfuly';
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

        $data1 = array('confirmation' => '3');
        $this->db->where('idtbl_job_list', $job_id);
        $this->db->update('tbl_job_list', $data1);

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            
            $actionObj=new stdClass();
            $actionObj->icon='fas fa-times';
            $actionObj->title='';
            $actionObj->message='Record Canceled successfuly';
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
    
        $updatedatetime=date('Y-m-d H:i:s');
    
            $data = array(
                'postponed_date'=> $pospondDate, 
                'insertdatetime'=> $updatedatetime, 
                'reason'=> $reason, 
                'tbl_job_list_idtbl_job_list' =>$job_id,
                'tbl_res_user_idtbl_res_user'=> $userID
    
            );
    
    
            $this->db->insert('tbl_postponed', $data);
    
            $data1 = array('posponed' => 1);
            $this->db->where('idtbl_job_list', $job_id);
            $this->db->update('tbl_job_list', $data1);
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-pause';
                $actionObj->title='';
                $actionObj->message='Record Posponded successfuly';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';
    
                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('ChangeRequest');  
            }

    }

}