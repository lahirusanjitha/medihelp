<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Itenarygroup extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Itenarygroupinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('itenarygroup', $result);
	}
    public function Itenarygroupinsertupdate(){
		$this->load->model('Itenarygroupinfo');
        $result=$this->Itenarygroupinfo->Itenarygroupinsertupdate();
	}
    public function Itenarygroupstatus($x, $y){
		$this->load->model('Itenarygroupinfo');
        $result=$this->Itenarygroupinfo->Itenarygroupstatus($x, $y);
	}
    public function Itenarygroupedit(){
		$this->load->model('Itenarygroupinfo');
        $result=$this->Itenarygroupinfo->Itenarygroupedit();
	}
}