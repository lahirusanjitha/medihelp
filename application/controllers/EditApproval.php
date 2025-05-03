<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class EditApproval extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('ChangeRequestinfo');
        $this->load->model('Dashboardinfo');
        $this->load->model('RejectReasoninfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
        $result['RejectReason'] = $this->RejectReasoninfo->getRejectReason();
		$this->load->view('editapproval', $result);
	}

    public function Editrequest($x, $y){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->Editrequest($x, $y);
    }
 
}