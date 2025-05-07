<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('Authorization_Token');
        $this->load->model("ApiInfo");
    }

    /**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login_post() {
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
            $this->response(['Validation rules violated'], REST_Controller::HTTP_OK);

		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->ApiInfo->resolve_user_login($username, $password)) {
				$user    = $this->ApiInfo->get_user($username, $password);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->idtbl_res_user;
				$_SESSION['name']     = (string)$user->name;
				$_SESSION['logged_in']    = (bool)true;
				
				// user login ok
                $token_data['uid'] = $user->idtbl_res_user;
                $token_data['username'] = $user->name;
                $tokenData = $this->authorization_token->generateToken($token_data);
                $final = array();
                $final['access_token'] = $tokenData;
                $final['status'] = true;
                $final['message'] = 'Login success!';
                $final['user_id'] = $user->idtbl_res_user;
                $final['access_token'] = $tokenData;

                $this->response($final, REST_Controller::HTTP_OK); 
				
			} else {
				
				// login failed
                $this->response(['Wrong username or password.'], REST_Controller::HTTP_OK);
				
			}
			
		}
		
	}
    
    /**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout_post() {

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
            $this->response(['Logout success!'], REST_Controller::HTTP_OK);
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			// redirect('/');
            $this->response(['There was a problem. Please try again.'], REST_Controller::HTTP_OK);	
		}
		
	}

    public function ReGenToken_post() {

		// set variables from the form
		$username = $this->input->post('username');
		if(!empty($username)) {
			$user_id = $this->ApiInfo->get_user_id_from_username($username);
			if (!empty($user_id)) {

				// token regeneration process
				$token_data['uid'] = $user_id;
				$token_data['username'] = $username; 
				$tokenData = $this->authorization_token->generateToken($token_data);
				$final = array();
				$final['access_token'] = $tokenData;
				$final['status'] = true;

				$this->response($final, REST_Controller::HTTP_OK); 
			}
			else
				$this->response(['username not valid'], REST_Controller::HTTP_BAD_REQUEST);
		}
		else
			$this->response(['username is required to regenerate token.'], REST_Controller::HTTP_BAD_REQUEST);
	}

    /**
	 * Get IteneryAPI List function.
	 * 
	 * @access public
	 * @return void
	 */
    
    public function getIteneryType_post(){
        $headers = $this->input->request_headers(); 
        //var_dump($headers);die;
		if (isset($headers['Authorization'])) {//echo $headers['Authorization'];die;
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']){
                // ------- Start -------
                $result=$this->ApiInfo->getIteneryType();
                
                $this->response($result, REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
    }

    public function getIteneryCategory_post(){
        $headers = $this->input->request_headers(); 
        
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']){
                // ------- Start -------
                $result=$this->ApiInfo->getIteneryCategory();
                
                $this->response($result, REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }    
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
    }

    public function getIteneryStatus_post(){
        $headers = $this->input->request_headers(); 
        
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']){
                // ------- Start -------
                $result=$this->ApiInfo->getIteneryStatus();
                
                $this->response($result, REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
    }

    public function getIteneryLocation_post(){
        $headers = $this->input->request_headers(); 
        
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']){
                // ------- Start -------
                $result=$this->ApiInfo->getIteneryLocation();
                
                $this->response($result, REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
    }

    public function getIteneryFeedbackType_post(){
        $headers = $this->input->request_headers(); 
        
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']){
                // ------- Start -------
                $result=$this->ApiInfo->getIteneryFeedbackType();
                
                $this->response($result, REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
		}
    }

    public function getAllMonthlyPlans_post() {
        $headers = $this->input->request_headers(); 
        
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']) {
                $userId = $decodedToken['data']->uid;  
                $result = $this->ApiInfo->getAllMonthlyPlans($userId);
                $this->response($result, REST_Controller::HTTP_OK);
            } else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
        } else {
            $this->response(['error' => 'Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    
    public function editPlan_post() {
        $headers = $this->input->request_headers(); 
        
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']) {
                $recordID = $this->post('recordID'); 
                $data = $this->post(); 
    
                $result = $this->ApiInfo->editPlan($recordID, $data);
                $this->response($result, REST_Controller::HTTP_OK);
            } else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
        } else {
            $this->response(['error' => 'Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }    

    public function deletePlan_post() {
        $headers = $this->input->request_headers(); 
        
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']) {
                $recordID = $this->post('recordID');
                $result = $this->ApiInfo->deletePlan($recordID);
                $this->response($result, REST_Controller::HTTP_OK);
            } else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
        } else {
            $this->response(['error' => 'Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function Jobinsertupdate_post() {
        $this->form_validation->set_rules('month', 'Month', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');
        $this->form_validation->set_rules('type', 'Itinerary Type', 'required');
        $this->form_validation->set_rules('category', 'Itinerary Category', 'required');
        $this->form_validation->set_rules('group', 'Itinerary Status', 'required');
        $this->form_validation->set_rules('itenary', 'Itinerary', 'required');
        $this->form_validation->set_rules('task', 'Task', 'required|numeric');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('meet_location', 'Meet Location', 'required');
        $this->form_validation->set_rules('reason', 'Reason');
        $this->form_validation->set_rules('comment', 'Comment');
        
        if ($this->form_validation->run() == false) {
            $this->response([
                'status' => false,
                'message' => 'Validation rules violated',
                'errors' => validation_errors()
            ], REST_Controller::HTTP_OK);
            return;
        }
    
        $headers = $this->input->request_headers();
        if (!isset($headers['Authorization'])) {
            $this->response([
                'status' => false,
                'message' => 'Authorization token is required.'
            ], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
    
        try {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);   
            if (!isset($decodedToken['data']->uid)) {
                throw new Exception('User ID not found in token.');
            }    
            $user_id = $decodedToken['data']->uid;  
    
        } catch (Exception $e) {
            $this->response([
                'status' => false,
                'message' => 'Invalid or expired token: ' . $e->getMessage()
            ], REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }
    
        $data = $this->input->post();
        $data['userid'] = $user_id;
    
        $result = $this->ApiInfo->Jobinsertupdate($data);
        
        if ($result['status'] == 'success') {
            $this->response([
                'status' => true,
                'message' => $result['message'],
                'data' => $result['data']
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => $result['message']
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function insertDisplayedData_post() {
        $headers = $this->input->request_headers(); 
    
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            
            if ($decodedToken['status']) {
                $jobs = $this->post('jobs');
                
                if (empty($jobs)) {
                    $this->response(["status" => "error", "message" => "No itinerary to approve"], REST_Controller::HTTP_BAD_REQUEST);
                    return;
                }
    
                $this->load->model('Sendtoapproveinfo');
                
                foreach ($jobs as $job) {
                    $insertData = [
                        'idtbl_job_list'    => $job['idtbl_job_list'],
                        'start_date'        => $job['start_date'],
                        'start_time'        => $job['start_time'],
                        'end_time'          => $job['end_time'],
                        'itenary_type'      => $job['itenary_type'],
                        'itenary_category'  => $job['itenary_category'],
                        'group'             => $job['group'],
                        'task'              => $job['task'],
                        'name'              => $job['name'],
                        'itenary'           => $job['itenary'],
                        'meet_location'     => $job['meet_location'],
                    ];
    
                    $this->Sendtoapproveinfo->insert_into_tbl_send_data($insertData);
                    $this->Sendtoapproveinfo->update_aprroval_send($job['idtbl_job_list']);
                }
    
                $this->response(["status" => "success", "message" => "Itinerary approved successfully"], REST_Controller::HTTP_OK);
    
            } else {
                if (isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire') {
                    $this->response(['error' => 'Token has expired'], REST_Controller::HTTP_UNAUTHORIZED);
                } else {
                    $this->response(['error' => 'Invalid token or access denied'], REST_Controller::HTTP_FORBIDDEN);
                }
            }
        } else {
            $this->response(['error' => 'Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    
    public function insertFeedback_post() {
        $headers = $this->input->request_headers();
    
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']) {
                $userID = $decodedToken['data']->uid; 
                $idtbl_job_list = $this->post('idtbl_job_list');
                $feedbacktype = $this->post('feedbacktype');
                $feedback = $this->post('feedback');
    
                if (!$idtbl_job_list || !$feedbacktype || !$feedback) {
                    $this->response([
                        "status" => "error",
                        "message" => "Missing required fields: idtbl_job_list, feedbacktype, or feedback"
                    ], REST_Controller::HTTP_BAD_REQUEST);
                    return;
                }
    
                $updatedatetime = date('Y-m-d H:i:s');
    
                $data = [
                    'comment' => $feedback,
                    'tbl_feedback_type_idtbl_feedback_type' => $feedbacktype,
                    'tbl_joblist_idtbl_joblist' => $idtbl_job_list,
                    'insertdatetime' => $updatedatetime,
                    'tbl_med_user_idtbl_med_user' => $userID
                ];
    
                $result = $this->ApiInfo->insertFeedback($data, $idtbl_job_list);
    
                if ($result) {
                    $this->response([
                        "status" => "success",
                        "message" => "Feedback added successfully"
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        "status" => "error",
                        "message" => "Failed to add feedback"
                    ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                $this->response([
                    "error" => isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire' ?
                        "Token has expired" : "Invalid token or access denied"
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(["error" => "Authentication failed"], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function viewFeedbacks_post() {
        $headers = $this->input->request_headers();
    
        if (isset($headers['Authorization'])) {
            $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status']) {
                $idtbl_job_list = $this->post('idtbl_job_list');
    
                if (!$idtbl_job_list) {
                    $this->response([
                        "status" => "error",
                        "message" => "Missing required field: idtbl_job_list"
                    ], REST_Controller::HTTP_BAD_REQUEST);
                    return;
                }
    
                $feedbacks = $this->ApiInfo->getFeedbacksByJobList($idtbl_job_list);
    
                if ($feedbacks) {
                    $this->response([
                        "status" => "success",
                        "feedbacks" => $feedbacks
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        "status" => "success",
                        "feedbacks" => [],
                        "message" => "No feedbacks found for this job list"
                    ], REST_Controller::HTTP_OK);
                }
            } else {
                $this->response([
                    "error" => isset($decodedToken['message']) && $decodedToken['message'] === 'Token Time expire' ?
                        "Token has expired" : "Invalid token or access denied"
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response(["error" => "Authentication failed"], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    
       
}