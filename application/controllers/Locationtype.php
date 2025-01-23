<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Locationtype extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Locationtypeinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('Locationtype', $result);
	}
    public function Locationtypeinsertupdate(){
		$this->load->model('Locationtypeinfo');
        $result=$this->Locationtypeinfo->Locationtypeinsertupdate();
	}
    public function Locationtypestatus($x, $y){
		$this->load->model('Locationtypeinfo');
        $result=$this->Locationtypeinfo->Locationtypestatus($x, $y);
	}
    public function Locationtypeedit(){
		$this->load->model('Locationtypeinfo');
        $result=$this->Locationtypeinfo->Locationtypeedit();
	}
}