<?php
class Feedbackinfo extends CI_Model{
    public function Insertfeedback(){
        $userID = $_SESSION['userid'];
        $idtbl_job_list = $this->input->post('idtbl_job_list');
        $feedbacktype = $this->input->post('feedbacktype');
        $feedback = $this->input->post('feedback');

        $updatedatetime=date('Y-m-d H:i:s');

        $data = array(
            'tbl_feedback_type_idtbl_feedback_type' => $feedbacktype,
            'comment' => $feedback,
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
            redirect('Feedback');                
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
            redirect('Feedback');
        }

    }
    public function feedbackdetails()
    {
        $recordID = $this->input->post('recordID');  
    
        $this->db->select('*');
        $this->db->from('tbl_feedback');
        $this->db->join('tbl_feedback_type', 'tbl_feedback.tbl_feedback_type_idtbl_feedback_type = tbl_feedback_type.idtbl_feedback_type', 'left');
        $this->db->where('tbl_feedback.tbl_joblist_idtbl_joblist', $recordID);
        $responddetail = $this->db->get();
        

        if ($responddetail->num_rows() == 0) {
            echo json_encode(['status' => 'nodata']);
            return;
        }

        $html = '
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Feed Back Date</th>
                            <th>Feed Back Type</th>
                            <th>Feed Back</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                    foreach ($responddetail->result() as $rowdetail) {
                        $html .= '<tr>
                            <td>' . $rowdetail->insertdatetime . '</td>
                            <td>' . $rowdetail->feedback_type . '</td>
                            <td>' . $rowdetail->comment . '</td>
                        </tr>';
                    }
                    
        $html .= '</tbody>
                </table>
            </div>
        </div>';
    
        echo json_encode(['status' => 'success', 'html' => $html]);
    }

}