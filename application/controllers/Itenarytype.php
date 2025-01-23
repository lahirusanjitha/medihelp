<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Itenarytype extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Itenarytypeinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('Itenarytype', $result);
	}
    public function Itenarytypeinsertupdate(){
		$this->load->model('Itenarytypeinfo');
        $result=$this->Itenarytypeinfo->Itenarytypeinsertupdate();
	}
    public function Itenarytypestatus($x, $y){
		$this->load->model('Itenarytypeinfo');
        $result=$this->Itenarytypeinfo->Itenarytypestatus($x, $y);
	}
    public function Itenarytypeedit(){
		$this->load->model('Itenarytypeinfo');
        $result=$this->Itenarytypeinfo->Itenarytypeedit();
	}
}