<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class ChangeRequest extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('ChangeRequestinfo');
        $this->load->model('Dashboardinfo');
        $this->load->model('RejectReasoninfo');
        $this->load->model('Itenarycategoryinfo');
        $this->load->model('Itenarygroupinfo');
        $this->load->model('Itenarytypeinfo');
        $this->load->model('Locationinfo');
        $this->load->model('Jobinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['itenarycategory']=$this->Itenarycategoryinfo->Getcategory(); 
        $result['Itenarygroup']=$this->Itenarygroupinfo->getGroup();
        $result['iternarytype'] = $this->Itenarytypeinfo->GetIternarytype();  
        $result['locationdetails'] = $this->Locationinfo->getLocation(); 
        $result['user'] = $this->Dashboardinfo->getUser();
        $result['RejectReason'] = $this->RejectReasoninfo->getRejectReason();
        $result['time'] = $this->Jobinfo->generateFullDayTimeOptions(); 
		$this->load->view('changerequest', $result);
	}

    public function Jobstatus($x, $y){
		$this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->Jobstatus($x, $y);
	}
    public function Jobconfirmstatus($x, $y){
		$this->load->model('ChangeRequestinfo');
        $result=$this->Confirmjobinfo->Jobconfirmstatus($x, $y);
	}
    public function Editrequest($x, $y){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->Editrequest($x, $y);
    }
    public function ApproveAllJob(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->Confirmjobinfo->ApproveAllJob();
    }
    public function CancelRecord(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->CancelRecord();
    }
    public function pospondRecord(){
        $this->load->model('ChangeRequestinfo');
        $result=$this->ChangeRequestinfo->pospondRecord();
    }
}