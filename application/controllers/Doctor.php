<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Doctor extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Doctorinfo');
        $this->load->model('Subjectinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['subject']=$this->Subjectinfo->GetSubject();
		$this->load->view('Doctor', $result);
	}
    public function Doctorinsertupdate(){
		$this->load->model('Doctorinfo');
        $result=$this->Doctorinfo->Doctorinsertupdate();
	}
    public function Doctorstatus($x, $y){
		$this->load->model('Doctorinfo');
        $result=$this->Doctorinfo->Doctorstatus($x, $y);
	}
    public function Doctoredit(){
		$this->load->model('Doctorinfo');
        $result=$this->Doctorinfo->Doctoredit();
	}
}