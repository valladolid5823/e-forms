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
			case 'gmp_gr':
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
						$PK_record_id = $this->queries->insert($records_data, 'tbl_afia_gmp_records', true);

						// Check if signatures insertion is successful
						if ($PK_record_id) {

							// Save comments for glass registration
							$comments = ['FK_grd_record_id' => $PK_record_id, 'comments' => $this->security->xss_clean($this->input->post('comments'))];
							$PK_comment_id = $this->queries->insert($comments, 'tbl_afia_gmp_glass_register_comments', true);
							
							// Check if comments insertion is successful
							if ($PK_comment_id) {
								$data = [];
								// Define variables for form fields
								$departments = $this->security->xss_clean($this->input->post('department'));
								$areas = $this->security->xss_clean($this->input->post('area'));
								$items = $this->security->xss_clean($this->input->post('item'));
								$materials = $this->security->xss_clean($this->input->post('material'));
								$locations = $this->security->xss_clean($this->input->post('location'));
								$risk_class = $this->security->xss_clean($this->input->post('risk_class'));
								$actions_required = $this->security->xss_clean($this->input->post('action_required'));
								$actions_completed = $this->security->xss_clean($this->input->post('action_completed'));
								$checked_initials = $this->security->xss_clean($this->input->post('checked_initial'));
								$files = $_FILES;

								// Configure image file types
								function is_image($file) {
									$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
									$mime = mime_content_type($file);
									return in_array($mime, $allowed_types);
								}

								// Prepare the array of row data
								for ($i = 0; $i < count($departments); $i++) {
									$image_data = null;

									// Validate image file type
									if (!empty($_FILES['attached_image']['tmp_name'][$i]) && !is_image($_FILES['attached_image']['tmp_name'][$i])) {
										// Return the status of image upload
										echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image!']);
										exit();
									}

									// Convert image into base64
									if (!empty($_FILES['attached_image']['tmp_name'][$i]) && is_image($_FILES['attached_image']['tmp_name'][$i])) {
										$image_data = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($_FILES['attached_image']['tmp_name'][$i]));
									} 

									// Set the organized data to insert
									$data[] = [
										'FK_grd_record_id' => $PK_record_id,
										'FK_gr_comment_id' => $PK_comment_id,
										'department' => $departments[$i],
										'area' => $areas[$i],
										'item' => $items[$i],
										'material' => $materials[$i],
										'attached_image' => $image_data,
										'location' => $locations[$i],
										'risk_class' => $risk_class[$i],
										'action_required' => $actions_required[$i],
										'action_completed' => $actions_completed[$i],
										'checked_initial' => $checked_initials[$i],
									];
								}

								// Insert multiple data in one
								if ($this->queries->insert_batch($data, 'tbl_afia_gmp_glass_register')) {
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
				$this->content = 'consultare/gmp_glass_register_form';            
				break;
				
        }

        $this->load->view('template/header');
        $this->load->view($this->content, $data);                    
        $this->load->view('template/footer');
    }

}
