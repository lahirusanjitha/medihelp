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

    public function Insertfeedback(){
        $userID = $_SESSION['userid'];
        $idtbl_job_list = $this->input->post('idtbl_job_list');
        $feedback = $this->input->post('feedback');

        $updatedatetime=date('Y-m-d H:i:s');

        $data = array(
            'comment' => $feedback,
            'is_admin' => 1,
            'tbl_joblist_idtbl_joblist' => $idtbl_job_list,
            'insertdatetime'=> $updatedatetime,
            'tbl_med_user_idtbl_med_user' => $userID
        );

        $this->db->insert('tbl_feedback', $data);

        $data1 = array('feedback' => 1);

        $this->db->where('idtbl_job_list', $idtbl_job_list);
        $this->db->update('tbl_job_list', $data1);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            
            $actionObj=new stdClass();
            $actionObj->icon='fas fa-save';
            $actionObj->title='';
            $actionObj->message='Feed back Added Successfully';
            $actionObj->url='';
            $actionObj->target='_blank';
            $actionObj->type='success';

            $actionJSON=json_encode($actionObj);
            
            $this->session->set_flashdata('msg', $actionJSON);
            redirect('ItinaryCompletion');                
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
            redirect('ItinaryCompletion');
        }

    }
   
    }
 