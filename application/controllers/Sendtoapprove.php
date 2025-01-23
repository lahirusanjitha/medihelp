<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendtoapprove extends CI_Controller {

    public function index() {
        $this->load->model('Commeninfo');
        $this->load->model('Dashboardinfo'); 
        $this->load->model('Sendtoapproveinfo');
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser(); 
        $this->load->view('sendtoapprove', $result);
    }
    public function updateApprovalStatus() {
        $this->load->model('Sendtoapproveinfo');
    
        $ids = $this->input->post('ids');
    
        if (empty($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
            return;
        }
            $result = $this->Sendtoapproveinfo->updateApprovalStatus($ids);
    
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
            }

    }
    
}
