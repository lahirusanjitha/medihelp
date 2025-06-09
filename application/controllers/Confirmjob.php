<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Confirmjob extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Confirmjobinfo');
        $this->load->model('Dashboardinfo');
        $this->load->model('Confirmjobinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
		$this->load->view('jobconfirm', $result);
	}
    
    public function ApprovalStatus() {
        $this->load->model('Confirmjobinfo');
    
        $ids = $this->input->post('ids');
    
        if (empty($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
            return;
        }
            $result = $this->Confirmjobinfo->updateApprovalStatus($ids);
    
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Approval successfull.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
            }

    }
    public function rejectApproval(){
        $this->load->model('Confirmjobinfo');
    
        $ids = $this->input->post('ids');
    
        if (empty($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
            return;
        }
            $result = $this->Confirmjobinfo->rejectApproval($ids);
    
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Approval Rejected Successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
            }
    }
}