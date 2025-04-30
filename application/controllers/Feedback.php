<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Feedback extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Feedbackinfo');
        $this->load->model('FeedbackTypeinfo');
        $this->load->model('RejectReasoninfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['feedbacktype'] = $this->FeedbackTypeinfo->getFeedbackType(); 
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

}