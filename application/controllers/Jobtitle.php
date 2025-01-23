<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Jobtitle extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Jobtittleinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('jobtittle', $result);
	}
    public function Jobtittleinsertupdate(){
		$this->load->model('Jobtittleinfo');
        $result=$this->Jobtittleinfo->Jobtittleinsertupdate();
	}
    public function Jobtittlestatus($x, $y){
		$this->load->model('Jobtittleinfo');
        $result=$this->Jobtittleinfo->Jobtittlestatus($x, $y);
	}
    public function Jobtittleedit(){
		$this->load->model('Jobtittleinfo');
        $result=$this->Jobtittleinfo->Jobtittleedit();
	}
}