<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class FeedbackType extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('FeedbackTypeinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('feedbacktype', $result);
	}
    public function FeedbackTypeinsertupdate(){
		$this->load->model('FeedbackTypeinfo');
        $result=$this->FeedbackTypeinfo->FeedbackTypeinsertupdate();
	}
    public function FeedbackTypestatus($x, $y){
		$this->load->model('FeedbackTypeinfo');
        $result=$this->FeedbackTypeinfo->FeedbackTypestatus($x, $y);
	}
    public function FeedbackTypeedit(){
		$this->load->model('FeedbackTypeinfo');
        $result=$this->FeedbackTypeinfo->FeedbackTypeedit();
	}
}