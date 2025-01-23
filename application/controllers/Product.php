<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Product extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Productinfo'); 
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['product']=$this->Productinfo->GetproductCategory();
		$this->load->view('product', $result);
	}
     public function Productinsertupdate(){
	    $this->load->model('Productinfo');
        $result=$this->Productinfo->Productinsertupdate();
	 }
    public function Productstatus($x, $y){
		$this->load->model('Productinfo');
        $result=$this->Productinfo->Productstatus($x, $y);
	}
    public function Productedit(){
		$this->load->model('Productinfo');
        $result=$this->Productinfo->Productedit();
	}
    public function Productimageview(){
		$this->load->model('Productinfo');
        $result=$this->Productinfo->Producimage();
	}

   
}
?>