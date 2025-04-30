<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Job extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Jobinfo');
        $this->load->model('Itenarycategoryinfo');
        $this->load->model('Itenarytypeinfo');
        $this->load->model('Itenarygroupinfo');
        $this->load->model('Locationinfo');
        $this->load->model('FeedbackTypeinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['itenarycategory']=$this->Itenarycategoryinfo->Getcategory(); 
        $result['Itenarygroup']=$this->Itenarygroupinfo->getGroup();
        $result['iternarytype'] = $this->Itenarytypeinfo->GetIternarytype();  
        $result['locationdetails'] = $this->Locationinfo->getLocation(); 
        $result['feedbacktype'] = $this->FeedbackTypeinfo->getFeedbackType(); 
		$this->load->view('job', $result);
	}
    public function Jobinsertupdate(){
		$this->load->model('Jobinfo');
        $result=$this->Jobinfo->Jobinsertupdate();
	}
    public function Jobstatus($x, $y){
		$this->load->model('Jobinfo');
        $result=$this->Jobinfo->Jobstatus($x, $y);
	}
    public function Jobedit(){
		$this->load->model('Jobinfo');
        $result=$this->Jobinfo->Jobedit();
	}


}