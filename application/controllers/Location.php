<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Location extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Locationinfo');
        $this->load->model('Locationtypeinfo');
        $this->load->model('Jobtittleinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['locationtype']=$this->Locationtypeinfo->getLocationtype();
        $result['jobtittle']=$this->Jobtittleinfo->getJobTittle();
		$this->load->view('Location', $result);
	}
    public function Locationinsertupdate(){
		$this->load->model('Locationinfo');
        $result=$this->Locationinfo->Locationinsertupdate();
	}
    public function Locationstatus($x, $y){
		$this->load->model('Locationinfo');
        $result=$this->Locationinfo->Locationstatus($x, $y);
	}
    public function Locationedit(){
		$this->load->model('Locationinfo');
        $result=$this->Locationinfo->Locationedit();
	}
    public function LocationContact(){
		$this->load->model('Locationinfo');
        $result=$this->Locationinfo->InsertLocationContact();
	}
    public function Locationcontactdetails(){
        $this->load->model('Locationinfo');
        $result=$this->Locationinfo->Locationcontactdetails();
    }
    public function Locationcontactstatus($x, $y){
		$this->load->model('Locationinfo');
        $result=$this->Locationinfo->Locationcontactstatus($x, $y);
	}
    

}