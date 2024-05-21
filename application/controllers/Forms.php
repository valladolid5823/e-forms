<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {
    
    protected $content = '';

    public function __construct() {
        
        parent::__construct();
    }

	public function index()
	{
        $data["forms"] = $this->queries->select_where("*", "generic_forms_list", Array("genfl_client_code" => $this->session->userdata("client_code"), "genfl_status_flag" => "A"));
	    
        if(!empty($data["forms"])){
            
            foreach($data["forms"] as $df){
                $count = 0;
                $result = $this->queries->select_no_where("*", $df["genfl_table_name"]);
                if(!empty($result)){
                    $count = count($result);
                }
                $data["count"][] = $count;
            }
        }
        if($this->session->userdata("client_code") == ""){
            $this->load->view("errors/html/error_general.php", Array("heading" => "Denied Access", "message" => "Please login using your PRP Account"));
        }else{
            $this->load->view("dashboard", $data);
        }
		
	}

    public function Consultare($form)
    {
        $_SESSION['user_role'] = "3";
        $_SESSION['user_name'] = "Marc Jhonel Tayros";
        $data = array();

        switch(strtolower($form))
        {
			//  Water Activiy Tester Calibration Help
			case 'gmp_watch':
				if ($this->input->server('REQUEST_METHOD') === 'POST') {
					try {

						// Define variables for signatures
						$approver_signature = null;
						$reviewer_signature = null;

						// Convert approver_img_sign into base64
						if (isset($_FILES['approver_img_sign']['name']) && !empty($_FILES['approver_img_sign']['name'])) {
							$approver_signature = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($_FILES['approver_img_sign']['tmp_name']));
						} 
						
						// Convert reviewer_img_sign into base64
						if (isset($_FILES['reviewer_img_sign']['name']) && !empty($_FILES['reviewer_img_sign']['name'])) {
							$reviewer_signature = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($_FILES['reviewer_img_sign']['tmp_name']));
						}

						// Set the organized data to insert
						$records_data = array(

							// reviewer section
							'reviewer_name'  =>  $this->security->xss_clean($this->input->post('reviewer_name')),
							'reviewer_draw_sign'  => $this->input->post('reviewer_draw_sign'),
							'reviewer_img_sign'  =>  $reviewer_signature,
							'reviewer_position'  =>  $this->security->xss_clean($this->input->post('reviewer_position')),
							'reviewed_date'  =>  $this->security->xss_clean($this->input->post('reviewed_date')),
		
							// approver section
							'approver_name'  =>  $this->security->xss_clean($this->input->post('approver_name')),
							'approver_draw_sign'  => $this->input->post('approver_draw_sign'),
							'approver_img_sign'  => $approver_signature,
							'approver_position'  =>  $this->security->xss_clean($this->input->post('approver_position')),
							'approved_date'  =>  $this->security->xss_clean($this->input->post('approved_date'))
						);
						
						// Save reviewer and approver signatures and other personal information
						$PK_signature_id = $this->queries->insert($records_data, 'tbl_watch_signatures', true);

						// Check if signatures insertion is successful
						if ($PK_signature_id) {
							
							$data = [
								'FK_watch_signature_id' => $PK_signature_id,
								'substance' => $this->security->xss_clean($this->input->post('substance')),
								'reading' => $this->security->xss_clean($this->input->post('reading')),
								'pass_fail' => $this->security->xss_clean($this->input->post('pass_fail')),
								'inspected_by' => $this->security->xss_clean($this->input->post('inspected_by')),
								'date_time' => $this->security->xss_clean($this->input->post('date_time'))
							];
							

							// Check if insertion of data to performance check form is successful
							if ($this->queries->insert($data, 'tbl_watch_performance_check', true)) {

								$response = ['status' => 'success', 'message' => 'Success, Data has been saved!'];

							} else {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							$data = [
								'FK_watch_signature_id' => $PK_signature_id,
								'equipment_tracking_no' => $this->security->xss_clean($this->input->post('equipment_tracking_no')),
								'equipment_description' => $this->security->xss_clean($this->input->post('equipment_description')),
								'model_no' => $this->security->xss_clean($this->input->post('model_no')),
								'serial_no' => $this->security->xss_clean($this->input->post('serial_no')),
								'calibration_certification_date' => $this->security->xss_clean($this->input->post('calibration_certification_date')),
								'calibration_certification_due_date' => $this->security->xss_clean($this->input->post('calibration_certification_due_date')),
					
							];

							// Check if insertion of data to performance check form is successful
							if ($this->queries->insert($data, 'tbl_watch_operational_calibration_verification', true)) {

								$response = ['status' => 'success', 'message' => 'Success, Data has been saved!'];
								
							} else {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Return status of insert batch query
							echo json_encode($response);
							exit();
						} else {
							// Show a detailed database error
							$error = $this->db->error();
							echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
						}
						
					} catch(\Exception $e) {
						log_message('error', $e->getMessage());
						redirect(site_url('Forms/Consultare/gmp_watch'));
					}
				}

				// Define proper route redirection
				$this->content = 'consultare/gmp_water_activity_test'; 
				break;
				
        }

        $this->load->view('template/header');
        $this->load->view($this->content, $data);                    
        $this->load->view('template/footer');
    }

}
