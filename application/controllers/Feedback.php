<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Feedback extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Feedbackinfo');
        $this->load->model('FeedbackTypeinfo');
        $this->load->model('RejectReasoninfo');
        $this->load->model('Dashboardinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['feedbacktype'] = $this->FeedbackTypeinfo->getFeedbackType(); 
        $result['user'] = $this->Dashboardinfo->getUser();
		$this->load->view('feedback', $result);
	}

    public function Insertfeedback(){
        $this->load->model('Feedbackinfo');
        $result=$this->Feedbackinfo->Insertfeedback(); 
    }
    public function feedbackdetails(){
        $this->load->model('Feedbackinfo');
        $result=$this->Feedbackinfo->feedbackdetails();
    }
    public function updateFeedback(){
        $feedbackID = $this->input->post('feedbackID');
        $newComment = $this->input->post('comment');
        $updatedBy  = $this->session->userdata('userid');

        $this->load->model('Feedbackinfo');

        $result = $this->Feedbackinfo->updateFeedback($feedbackID, $newComment, $updatedBy);

        if ($result['status'] === 'success') {
            echo json_encode(['status' => 'success', 'message' => $result['message']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    }


}