<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Itenarysubcategory extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Itenarysubcategoryinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('Itenarysubcategory', $result);
	}
    public function Itenarysubcategoryinsertupdate(){
		$this->load->model('Itenarysubcategoryinfo');
        $result=$this->Itenarysubcategoryinfo->Itenarysubcategoryinsertupdate();
	}
    public function Itenarysubcategorystatus($x, $y){
		$this->load->model('Itenarysubcategoryinfo');
        $result=$this->Itenarysubcategoryinfo->Itenarycategorystatus($x, $y);
	}
    public function Itenarysubcategorypeedit(){
		$this->load->model('Itenarysubcategoryinfo');
        $result=$this->Itenarysubcategoryinfo->Itenarysubcategoryedit();
	}
}