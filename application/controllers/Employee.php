<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Employee extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Employeeinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('Employee', $result);
	}
    public function Employeeinsertupdate(){
		$this->load->model('Employeeinfo');
        $result=$this->Employeeinfo->Employeeinsertupdate();
	}
    public function Employeestatus($x, $y){
		$this->load->model('Employeeinfo');
        $result=$this->Employeeinfo->Emploeestatus($x, $y);
	}
    public function Employeeedit(){
		$this->load->model('Employeeinfo');
        $result=$this->Employeeinfo->Employeeedit();
	}
}