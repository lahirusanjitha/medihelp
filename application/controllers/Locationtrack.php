<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locationtrack extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LocationtrackModel');
    }

    public function get_locations() {
        $locations = $this->LocationtrackModel->get_all_locations();
        echo json_encode($locations);
    }

    public function index() {
        $this->load->model('Commeninfo');
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $this->load->view('locationmap',$result); 
    }
}
?>
