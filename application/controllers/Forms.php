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
			// Glass Registration
			case 'gmp_at':
				if ($this->input->server('REQUEST_METHOD') === 'POST') {
					try {

						//  Define variables for signatures
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
						$data = array(

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
						$PK_signature_id = $this->queries->insert($data, 'tbl_allergen_test_signatures', true);


						// Insert help file
						if($PK_signature_id) {

							// Configure file types
							function is_valid_file($file) {
								$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
								$mime = mime_content_type($file);
								return in_array($mime, $allowed_types);
							}

							// Validate image file type
							if (!empty($_FILES['help']['tmp_name']) && !is_valid_file($_FILES['help']['tmp_name'])) {
								// Return the status of image upload
								echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
								exit();
							}

							// Convert image into base64
							$base64_data = null;
							if (!empty($_FILES['help']['tmp_name']) && is_valid_file($_FILES['help']['tmp_name'])) {
								// return a proper base64 format based on the file type
								$base64_type = $_FILES['help']['type'] == 'application/pdf' ? 'data:application/pdf;base64,' : 'data:image/jpeg;base64,';
								// convert file pdf/img file into base64
								$base64_data = $base64_type.base64_encode(file_get_contents($_FILES['help']['tmp_name']));
							} 

							// Check if insertion of help file is successful. If not, then return a detailed database error
							if (!$this->queries->insert(['FK_at_signature_id' => $PK_signature_id, 'help' => $base64_data], 'tbl_allergen_test_record_help', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion of records
							$data = [];
							// Define variables for form fields
							$allergen_name = $this->security->xss_clean($this->input->post('allergen_name'));
							$material_tested = $this->security->xss_clean($this->input->post('material_tested'));
							$test_kit_used = $this->security->xss_clean($this->input->post('test_kit_used'));
							$results = $this->security->xss_clean($this->input->post('results'));
							$deficiency = $this->security->xss_clean($this->input->post('deficiency'));
							$performed_by = $this->security->xss_clean($this->input->post('performed_by'));
							$performed_date_time = $this->security->xss_clean($this->input->post('performed_date_time'));
							$corrective_action = $this->security->xss_clean($this->input->post('corrective_action'));
							$corrected_by = $this->security->xss_clean($this->input->post('corrected_by'));
							$corrected_date_time = $this->security->xss_clean($this->input->post('corrected_date_time'));
							$notes_comments = $this->security->xss_clean($this->input->post('notes_comments'));
							$status = $this->security->xss_clean($this->input->post('status'));
							$reviewed_by = $this->security->xss_clean($this->input->post('reviewed_by'));
							$reviewed_date_time = $this->security->xss_clean($this->input->post('reviewed_date_time'));
							$files = $_FILES;

							// Prepare the array of row data
							for ($i = 0; $i < count($allergen_name); $i++) {
								$base64_data = null;

								// Validate image file type
								if (!empty($_FILES['sop_reference']['tmp_name'][$i]) && !is_valid_file($_FILES['sop_reference']['tmp_name'][$i])) {
									// Return the status of image upload
									echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
									exit();
								}

								// Convert image into base64
								if (!empty($_FILES['sop_reference']['tmp_name'][$i]) && is_valid_file($_FILES['sop_reference']['tmp_name'][$i])) {
									// return a proper base64 format based on the file type
									$base64_type = $_FILES['sop_reference']['type'][$i] == 'application/pdf' ? 'data:application/pdf;base64,' : 'data:image/jpeg;base64,';
									// convert file pdf/img file into base64
									$base64_data = $base64_type.base64_encode(file_get_contents($_FILES['sop_reference']['tmp_name'][$i]));
								} 

								// Set the organized data to insert
								$data[] = [
									'FK_at_signature_id' => $PK_signature_id,
									'allergen_name' => $allergen_name[$i],
									'sop_reference' => $base64_data,
									'material_tested' => $material_tested[$i],
									'test_kit_used' => $test_kit_used[$i],
									'results' => $results[$i],
									'deficiency' => $deficiency[$i],
									'performed_by' => $performed_by[$i],
									'performed_date_time' => $performed_date_time[$i],
									'corrective_action' => $corrective_action[$i],
									'corrected_by' => $corrected_by[$i],
									'corrected_date_time' => $corrected_date_time[$i],
									'notes_comments' => $notes_comments[$i],
									'status' => $status[$i],
									'reviewed_by' => $reviewed_by[$i],
									'reviewed_date_time' => $reviewed_date_time[$i],
								];

							}

							// Insert multiple data in one
							if ($this->queries->insert_batch($data, 'tbl_allergen_test_record')) {
								$response = ['status' => 'success', 'message' => 'Success, Data has been saved!'];
							} else {
								$response = ['status' => 'fail', 'message' => 'Fail, Saving data has an error!'];
							}

							// Return status of insert batch query
							echo json_encode($response);
							exit();

						} else {
							// Show a detailed database error
							$error = $this->db->error();
							echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
						}

						// Check if signatures insertion is successful
						if ($PK_signature_id) {

							

						} else {
							// Show a detailed database error
							$error = $this->db->error();
							echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
						}

					} catch(\Exception $e) {
						log_message('error', $e->getMessage());
						redirect(site_url('Forms/Consultare/gmp_gr'));
					}
				}
				
				// Define proper route redirection
				$this->content = 'consultare/allergen_testing_form';            
				break;
				
        }

        $this->load->view('template/header');
        $this->load->view($this->content, $data);                    
        $this->load->view('template/footer');
    }

}
