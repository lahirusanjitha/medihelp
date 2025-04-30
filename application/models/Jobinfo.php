<?php
class Jobinfo extends CI_Model{
    public function Jobinsertupdate(){
        $this->db->trans_begin();

        $userID=$_SESSION['userid'];
        $month= $this->input->post('month');
        $date= $this->input->post('date');
        $start_time= $this->input->post('start_time');
        $end_time= $this->input->post('end_time');
        $itenary_type= $this->input->post('type');
        $category= $this->input->post('category');
        $group= $this->input->post('group');
        $task= $this->input->post('task');
        $location= $this->input->post('location');
        $itenary= $this->input->post('itenary');
        $meet_location= $this->input->post('meet_location');

        $recordOption=$this->input->post('recordOption');
        if(!empty($this->input->post('recordID'))){$recordID=$this->input->post('recordID');}

        $month_date = $month . '-01';
        $updatedatetime=date('Y-m-d H:i:s');

        if($recordOption==1){
            $data = array(
                'month'=>$month_date,
                'start_date'=>$date,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'tbl_itenary_type_tblid_itenary_type'=>$itenary_type,
                'tbl_itenary_category_id'=>$category,
                'tbl_itenary_group_id'=>$group,
                'task'=>$task,
                'tblid_location'=>$location,
                'itenary'=>$itenary,
                'meet_location'=>$meet_location,
                'status'=> '1', 
                'completion'=> '2', 
                'confirmation'=> '2',
                'instertdatetime' => $updatedatetime,
                'tbl_med_user_id'=> $userID

               
            );

            $this->db->insert('tbl_job_list', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-save';
                $actionObj->title='';
                $actionObj->message='Record Added Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Job');                
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
                redirect('Job');
            }
        }
        else{
            $data = array(

                'start_date'=>$date,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
                'tbl_itenary_type_tblid_itenary_type'=>$itenary_type,
                'tbl_itenary_category_id'=>$category,
                'tbl_itenary_group_id'=>$group,
                'task'=>$task,
                'itenary'=>$itenary,
                'tblid_location'=>$location,
                'meet_location'=>$meet_location,
                'updatedatetime' => $updatedatetime,
                
            );

            $this->db->where('idtbl_job_list', $recordID);
            $this->db->update('tbl_job_list', $data);

            $this->db->set('edit_request', 0);
            $this->db->where('idtbl_job_list', $recordID);
            $this->db->update('tbl_job_list');

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-save';
                $actionObj->title='';
                $actionObj->message='Record Update Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='primary';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Job');                
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
                redirect('Job');
            }
        }
    }
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
                redirect('Confirmjob');                
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
                redirect('Job');
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
                redirect('Confirmjob');                
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
                redirect('Job');
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
                redirect('Confirmjob');                
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
                redirect('Confirmjob');
            }
        }
    }
    public function Jobedit(){
        $recordID=$this->input->post('recordID');

        $this->db->select('*');
        $this->db->from('tbl_job_list');
        $this->db->where('idtbl_job_list', $recordID);
        $this->db->where('status', 1);

        $respond=$this->db->get();

        $obj=new stdClass();

        $fullDate = $respond->row(0)->month; 
        $obj->month = date('Y-m', strtotime($fullDate));
        $obj->id=$respond->row(0)->idtbl_job_list;
        $obj->start_date=$respond->row(0)->start_date;
        $obj->start_time=$respond->row(0)->start_time;
        $obj->end_time=$respond->row(0)->end_time;
        $obj->itenary_type=$respond->row(0)->tbl_itenary_type_tblid_itenary_type;
        $obj->itenary_category=$respond->row(0)->tbl_itenary_category_id;
        $obj->task=$respond->row(0)->task;
        $obj->itenary=$respond->row(0)->itenary;
        $obj->group=$respond->row(0)->tbl_itenary_group_id;
        $obj->meet_location=$respond->row(0)->meet_location;
        $obj->location=$respond->row(0)->tblid_location;


        echo json_encode($obj);



    }
    
    
    
        
}