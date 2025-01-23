<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class MonthlyItinaryStatus extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Dashboardinfo');
       // $this->load->model('RejectReasoninfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
        //$result['RejectReason'] = $this->RejectReasoninfo->getRejectReason();
		$this->load->view('monthlyitinarystatus', $result);
	}
    public function ItinaryStatus(){
        $this->load->model('MonthlyItinaryStatusinfo');
        $this->MonthlyItinaryStatusinfo->ItinaryStatus();
    }

  
}