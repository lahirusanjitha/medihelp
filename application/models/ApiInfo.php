<?php
class ApiInfo extends CI_Model{

    /**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		$password=md5($password);
		$this->db->select('idtbl_res_user');
		$this->db->from('tbl_res_user');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$respond = $this->db->get();
		
		if(!empty($respond->row(0)->idtbl_res_user)){
			return true;
		}
		else{
			return false;
		}		
	}

    public function get_user_id_from_username($username){
		$this->db->select('*');
        $this->db->from('tbl_res_user');
        $this->db->where('username', $username);
        $this->db->where('status', 1);

        $respond=$this->db->get();

		if($respond->num_rows()==1){
			return $respond->row(0)->idtbl_res_user;
		}else{ 
			return false;
		}
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($username, $password) {
		$password=md5($password);

		$this->db->select('*');
		$this->db->from('tbl_res_user');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		return $this->db->get()->row();
	}

    public function getIteneryType(){
        $this->db->select('idtbl_itenary_type, itenary_type');
        $this->db->from('tbl_itenary_type');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        return $respond->result();
    }

    public function getIteneryCategory(){
        $this->db->select('idtbl_itenary_category, itenary_category');
        $this->db->from('tbl_itenary_category');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        return $respond->result();
    }

    public function getIteneryStatus(){
        $this->db->select('tblid_itenary_group, group');
        $this->db->from('tbl_itenary_group');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        return $respond->result();
    }

    public function getIteneryLocation(){
        $this->db->select('idtbl_location, name');
        $this->db->from('tbl_location');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        return $respond->result();
    }

    public function getIteneryFeedbackType(){
        $this->db->select('idtbl_feedback_type, feedback_type');
        $this->db->from('tbl_feedback_type');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        return $respond->result();
    }

    public function getAllMonthlyPlans($userId) {
        $this->db->select('u.idtbl_job_list, u.start_date, u.start_time, u.end_time, ua.itenary_type, u.task, ud.name AS location, ub.itenary_category, uc.group, u.itenary, u.meet_location, u.status, u.confirmation, u.edit_request, u.feedback');
        $this->db->from('tbl_job_list AS u');
        $this->db->join('tbl_itenary_category AS ub', 'ub.idtbl_itenary_category = u.tbl_itenary_category_id', 'left');
        $this->db->join('tbl_itenary_group AS uc', 'uc.tblid_itenary_group = u.tbl_itenary_group_id', 'left');
        $this->db->join('tbl_itenary_type AS ua', 'ua.idtbl_itenary_type = u.tbl_itenary_type_tblid_itenary_type', 'left');
        $this->db->join('tbl_location AS ud', 'ud.idtbl_location = u.tblid_location', 'left');
        $this->db->where_in('u.status', [1, 2]);
    
        if ($userId != 1) {
            $this->db->where('u.tbl_med_user_id', $userId);
        }
    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return ['status' => true, 'data' => $query->result_array()];
        } else {
            return ['status' => false, 'message' => 'No data found'];
        }
    }

    public function getItenariesToInsertFeedback($userid) {
        $this->db->select('
            u.idtbl_job_list, u.start_date, u.start_time, u.end_time, ua.itenary_type, u.task,ud.name as location,
            ub.itenary_category, uc.group,u.itenary, u.meet_location, u.status, u.confirmation, u.edit_request,
            u.tbl_med_user_id,u.feedback
        ');
        $this->db->from('tbl_job_list u');
        $this->db->join('tbl_itenary_category ub', 'ub.idtbl_itenary_category = u.tbl_itenary_category_id', 'left');
        $this->db->join('tbl_itenary_group uc', 'uc.tblid_itenary_group = u.tbl_itenary_group_id', 'left');
        $this->db->join('tbl_itenary_type ua', 'ua.idtbl_itenary_type = u.tbl_itenary_type_tblid_itenary_type', 'left');
        $this->db->join('tbl_location ud', 'ud.idtbl_location = u.tblid_location', 'left');
        $this->db->where_in('u.status', [1, 2]);
        $this->db->where_in('u.confirmation', 1);
        $this->db->where('u.tbl_med_user_id', $userid);
    
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllCompletedRecords() {
        $this->db->select('u.idtbl_job_list, u.start_date, u.start_time, u.end_time, ua.itenary_type,
                            ub.itenary_category, uc.group, u.task, u.itenary, u.meet_location, u.status, u.confirmation,
                            u.edit_request, u.tbl_med_user_id, u.feedback, ud.name as location');
        $this->db->from('tbl_job_list u');
        $this->db->join('tbl_itenary_type ua', 'ua.idtbl_itenary_type = u.tbl_itenary_type_tblid_itenary_type', 'left');
        $this->db->join('tbl_itenary_category ub', 'ub.idtbl_itenary_category = u.tbl_itenary_category_id', 'left');
        $this->db->join('tbl_itenary_group uc', 'uc.tblid_itenary_group = u.tbl_itenary_group_id', 'left');
        $this->db->join('tbl_location ud', 'ud.idtbl_location = u.tblid_location', 'left');
        $this->db->where('u.completion', 1);

        $query = $this->db->get();
        return $query->result_array();
    }


    
    public function editPlan($recordID, $data) {
        $data = array(
            'start_date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'tbl_itenary_type_tblid_itenary_type' => $data['type'],
            'tbl_itenary_category_id' => $data['category'],
            'tbl_itenary_group_id' => $data['group'],
            'task' => $data['task'],
            'itenary' => $data['itenary'],
            'tblid_location' => $data['location'],
            'meet_location' => $data['meet_location'],
            'reason' => $data['reason'],
            'comment' => $data['comment'],
            'updatedatetime' => date('Y-m-d H:i:s')
        );

        $this->db->where('idtbl_job_list', $recordID);
        if ($this->db->update('tbl_job_list', $data)) {
            return ['status' => true, 'message' => 'Plan updated successfully'];
        } else {
            return ['status' => false, 'message' => 'Failed to update plan'];
        }
    }
    

    public function deletePlan($recordID) {
        $this->db->where('idtbl_job_list', $recordID);
        if ($this->db->update('tbl_job_list', ['status' => 3])) {
            return ['status' => true, 'message' => 'Plan deleted successfully'];
        } else {
            return ['status' => false, 'message' => 'Failed to delete plan'];
        }
    }

    public function Jobinsertupdate($input) {
        $this->db->trans_begin();

        $userID = $input['userid'];
        $month = $input['month'];
        $date = $input['date'];
        $start_time = $input['start_time'];
        $end_time = $input['end_time'];
        $itenary_type = $input['type'];
        $category = $input['category'];
        $group = $input['group'];
        $task = $input['task'];
        $location = $input['location'];
        $itenary = $input['itenary'];
        $meet_location = $input['meet_location'];
        $reason = $input['reason'];
        $comment = $input['comment'];
        $recordOption = $input['recordOption'];
        $recordID = $input['recordID'] ?? null;

        $month_date = $month . '-01';
        $updatedatetime = date('Y-m-d H:i:s');

        try {
            if ($recordOption == 1) { 
                $data = [
                    'month' => $month_date,
                    'start_date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'tbl_itenary_type_tblid_itenary_type' => $itenary_type,
                    'tbl_itenary_category_id' => $category,
                    'tbl_itenary_group_id' => $group,
                    'task' => $task,
                    'tblid_location' => $location,
                    'itenary' => $itenary,
                    'meet_location' => $meet_location,
                    'reason' => $reason,
                    'comment' => $comment,
                    'status' => '1',
                    'completion' => '2',
                    'confirmation' => '2',
                    'instertdatetime' => $updatedatetime,
                    'tbl_med_user_id' => $userID
                ];
                $this->db->insert('tbl_job_list', $data);

            } else { 
                $data = [
                    'start_date' => $date,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'tbl_itenary_type_tblid_itenary_type' => $itenary_type,
                    'tbl_itenary_category_id' => $category,
                    'tbl_itenary_group_id' => $group,
                    'task' => $task,
                    'itenary' => $itenary,
                    'meet_location' => $location,
                    'reason' => $reason,
                    'comment' => $comment,
                    'updatedatetime' => $updatedatetime,
                ];
                $this->db->where('idtbl_job_list', $recordID);
                $this->db->update('tbl_job_list', $data);

                $this->db->set('edit_request', 0);
                $this->db->where('idtbl_job_list', $recordID);
                $this->db->update('tbl_job_list');
            }

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed.');
            }

            $this->db->trans_commit();
            return [
                'status' => 'success',
                'message' => $recordOption == 1 ? 'Record added successfully.' : 'Record updated successfully.',
                'data' => $data
            ];

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function insert_into_tbl_send_data($data) {
        $this->db->insert('tbl_send_data', $data);
    }
    
    public function update_aprroval_send($idtbl_job_list) {
        $this->db->set('approval_send', 1);
        $this->db->where('idtbl_job_list', $idtbl_job_list); 
        $this->db->update('tbl_job_list');
    }

    public function insertFeedback($data, $idtbl_job_list) {
        $this->db->trans_start();
    
        $this->db->insert('tbl_feedback', $data);
    
        $updateData = ['feedback' => 1];
        $this->db->where('idtbl_job_list', $idtbl_job_list);
        $this->db->update('tbl_job_list', $updateData);
    
        $this->db->trans_complete();
    
        return $this->db->trans_status(); 
    }

    public function getFeedbacksByJobList($idtbl_job_list) {
        $this->db->select('f.idtbl_feedback, f.comment, ft.feedback_type');
        $this->db->from('tbl_feedback f');
        $this->db->join('tbl_feedback_type ft', 'f.tbl_feedback_type_idtbl_feedback_type = ft.idtbl_feedback_type', 'left');
        $this->db->where('f.tbl_joblist_idtbl_joblist', $idtbl_job_list);
        $this->db->order_by('f.insertdatetime', 'DESC');
    
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
}
