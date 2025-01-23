<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Itenarycategory extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Itenarycategoryinfo');
        $this->load->model('Itenarysubcategoryinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
      //  $result['subcategory'] = $this->Itenarysubcategoryinfo->getSubCategory();
        
		$this->load->view('Itenarycategory', $result);
	}
    public function Itenarycategoryinsertupdate(){
		$this->load->model('Itenarycategoryinfo');
        $result=$this->Itenarycategoryinfo->Itenarycategoryinsertupdate();
	}
    public function Itenarycategorystatus($x, $y){
		$this->load->model('Itenarycategoryinfo');
        $result=$this->Itenarycategoryinfo->Itenarycategorystatus($x, $y);
	}
    public function Itenarycategorypeedit(){
		$this->load->model('Itenarycategoryinfo');
        $result=$this->Itenarycategoryinfo->Itenarycategoryedit();
	}
}