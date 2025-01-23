<?php
class Locationinfo extends CI_Model{
    public function getLocation(){
        $this->db->select('`idtbl_location`,name');
        $this->db->from('tbl_location');
        $this->db->where('status',1);

        return $respond = $this->db->get();
    }
    public function Locationinsertupdate(){
        $this->db->trans_begin();

        $userID=$_SESSION['userid'];

        $name     = $this->input->post('name');
        $address = $this->input->post('address');
        $location_type = $this->input->post('locationtype');

        $recordOption=$this->input->post('recordOption');
        if(!empty($this->input->post('recordID'))){$recordID=$this->input->post('recordID');}

        $updatedatetime=date('Y-m-d H:i:s');

        if($recordOption==1){
            $data = array(
                'name'=> $name,
                'address'=>$address, 
                'status'=> '1', 
                'insertdatetime'=> $updatedatetime, 
                'tbl_location_type_idtbl_location_type'=>$location_type,
                'tbl_res_user_idtbl_res_user'=> $userID
            );

            $this->db->insert('tbl_location', $data);

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
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else{
            $data = array(
                'name'=> $name,
                'contact' => $contact, 
                'address' => $address
            );

            $this->db->where('idtbl_location', $recordID);
            $this->db->update('tbl_location', $data);

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
                redirect('Location');                
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
                redirect('Location');
            }
        }
    }
    public function Locationstatus($x, $y){
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

            $this->db->where('idtbl_location', $recordID);
            $this->db->update('tbl_location', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-check';
                $actionObj->title='';
                $actionObj->message='Record Activate Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else if($type==2){
            $data = array(
                'status' => '2',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_location', $recordID);
            $this->db->update('tbl_location', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-times';
                $actionObj->title='';
                $actionObj->message='Record Deactivate Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='warning';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else if($type==3){
            $data = array(
                'status' => '3',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_location', $recordID);
            $this->db->update('tbl_location', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-trash-alt';
                $actionObj->title='';
                $actionObj->message='Record Remove Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }
    }
    public function Locationedit(){
        $recordID=$this->input->post('recordID');

        
        $this->db->select('*');
        $this->db->from('tbl_location');
        $this->db->where('idtbl_location', $recordID);
        $this->db->where('status', 1);

        $respond=$this->db->get();

        $obj=new stdClass();
        $obj->id=$respond->row(0)->idtbl_location;
        $obj->name=$respond->row(0)->name;
        $obj->locationtype=$respond->row(0)->tbl_location_type_idtbl_location_type;
        $obj->contact=$respond->row(0)->contact;
        $obj->address=$respond->row(0)->address;


        echo json_encode($obj);
    }
    public function InsertLocationContact(){

        $this->db->trans_begin();

        $userID=$_SESSION['userid'];
        $location_id = $this->input->post('idtbl_location');
        $name     = $this->input->post('contactName');
        $contact = $this->input->post('contactPhone');
        $email = $this->input->post('email');
        $job_tittle = $this->input->post('job_tittle');

        $recordOption=$this->input->post('recordOption');
        if(!empty($this->input->post('recordID'))){$recordID=$this->input->post('recordID');}

        $updatedatetime=date('Y-m-d H:i:s');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $actionObj = new stdClass();
            $actionObj->icon = 'fas fa-warning';
            $actionObj->title = '';
            $actionObj->message = 'Failed to add Invalid email address.';
            $actionObj->url = '';
            $actionObj->target = '_blank';
            $actionObj->type = 'danger';
    
            $actionJSON = json_encode($actionObj);
            $this->session->set_flashdata('msg', $actionJSON);
            redirect('Location');
            return;
        }

        if($recordOption==1){
            $data = array(
                'name'=> $name,
                'contact'=>$contact, 
                'email'=>$email,
                'tbl_jobtittle_tblid_jobtittle'=> $job_tittle, 
                'tbl_location_tblid_location'=> $location_id,
                'insertdatetime'=> $updatedatetime, 
                'tbl_med_user_tblid_med_user'=> $userID
            );

            $this->db->insert('tbl_location_contact', $data);

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
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else{
            $data = array(
                'name'=> $name,
                'contact' => $contact, 
                'address' => $address
            );

            $this->db->where('idtbl_location', $recordID);
            $this->db->update('tbl_location', $data);

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
                redirect('Location');                
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
                redirect('Location');
            }
        } 
    }
    public function Locationcontactdetails()
    {
        $recordID = $this->input->post('recordID');  
    
        $this->db->select('*');
        $this->db->from('tbl_location_contact');
        $this->db->join('tbl_job_tittle', 'tbl_location_contact.tbl_jobtittle_tblid_jobtittle = tbl_job_tittle.tblid_job_tittle', 'left');
        $this->db->where('tbl_location_contact.tbl_location_tblid_location', $recordID);
        $this->db->where('tbl_location_contact.status', 1);
        $responddetail = $this->db->get();
        

        if ($responddetail->num_rows() == 0) {
            echo "No data found for this ID.";
            return;
        }

        $html = '
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                    foreach ($responddetail->result() as $rowdetail) {
                        $html .= '<tr>
                            <td>' . $rowdetail->name . '</td>
                            <td>' . $rowdetail->contact . '</td>
                            <td>' . $rowdetail->email . '</td>
                            <td>' . $rowdetail->job_tittle . '</td>
                            <td>
                                <a href="' . base_url() . 'Location/Locationcontactstatus/' . $rowdetail->idtbl_location_contact . '/3" 
                                onclick="return delete_confirm()" 
                                target="_self" 
                                class="btn btn-danger btn-sm ' . '">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>';
                    }
                    
        $html .= '</tbody>
                </table>
            </div>
        </div>';
    
        echo $html; 
    }
    public function Locationcontactstatus($x,$y){

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

            $this->db->where('idtbl_location_contact', $recordID);
            $this->db->update('tbl_location_contact', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-check';
                $actionObj->title='';
                $actionObj->message='Record Activate Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='success';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else if($type==2){
            $data = array(
                'status' => '2',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_location_contact', $recordID);
            $this->db->update('tbl_location_contact', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-times';
                $actionObj->title='';
                $actionObj->message='Record Deactivate Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='warning';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }
        else if($type==3){
            $data = array(
                'status' => '3',
                'updatedatetime'=> $updatedatetime
            );

            $this->db->where('idtbl_location_contact', $recordID);
            $this->db->update('tbl_location_contact', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                $this->db->trans_commit();
                
                $actionObj=new stdClass();
                $actionObj->icon='fas fa-trash-alt';
                $actionObj->title='';
                $actionObj->message='Record Remove Successfully';
                $actionObj->url='';
                $actionObj->target='_blank';
                $actionObj->type='danger';

                $actionJSON=json_encode($actionObj);
                
                $this->session->set_flashdata('msg', $actionJSON);
                redirect('Location');                
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
                redirect('Location');
            }
        }

    }
    
}