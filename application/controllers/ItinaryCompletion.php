<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class ItinaryCompletion extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('ItinaryCompletioninfo');
        $this->load->model('Dashboardinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['user'] = $this->Dashboardinfo->getUser();
		$this->load->view('itinarycompletion', $result);
	}

//     public function ItinaryCmpletionStatus($x, $y){
// 		$this->load->model('ItinaryCompletioninfo');
//         $result=$this->ItinaryCompletioninfo->ItinaryCmpletionStatus($x, $y);


// }
public function Insertfeedback(){
    $this->load->model('ItinaryCompletioninfo');
    $result=$this->ItinaryCompletioninfo->Insertfeedback(); 
}
public function ItinaryCmpletionStatus() {
    $this->load->model('ItinaryCompletioninfo');

    $ids = $this->input->post('ids');

    if (empty($ids)) {
        echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
        return;
    }
        $result = $this->ItinaryCompletioninfo->ItinaryCmpletionStatus($ids);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
        }

}
}