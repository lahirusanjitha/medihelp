<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Subject extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Subjectinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('subject', $result);
	}
    public function Subjectinsertupdate(){
		$this->load->model('Subjectinfo');
        $result=$this->Subjectinfo->Subjectinsertupdate();
	}
    public function Subjectstatus($x, $y){
		$this->load->model('Subjectinfo');
        $result=$this->Subjectinfo->Subjectstatus($x, $y);
	}
    public function Subjecteidt(){
		$this->load->model('Subjectinfo');
        $result=$this->Subjectinfo->Subjecteidt();
	}
}