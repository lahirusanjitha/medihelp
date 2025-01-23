<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class RejectReason extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('RejectReasoninfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('rejectreason', $result);
	}
    public function RejectReasoninsertupdate(){
		$this->load->model('RejectReasoninfo');
        $result=$this->RejectReasoninfo->RejectReasoninsertupdate();
	}
    public function RejectReasonstatus($x, $y){
		$this->load->model('RejectReasoninfo');
        $result=$this->RejectReasoninfo->RejectReasonstatus($x, $y);
	}
    public function RejectReasonedit(){
		$this->load->model('RejectReasoninfo');
        $result=$this->RejectReasoninfo->RejectReasonedit();
	}
}