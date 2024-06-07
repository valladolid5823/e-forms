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

			// Batch Manufacturing
			case 'gmp_bmr':
				if ($this->input->server('REQUEST_METHOD') === 'POST') {
					try {
						// Set product details
						$product = array(
							'batch_number'  =>  $this->security->xss_clean($this->input->post('batch_number')),
							'product_name'  =>  $this->security->xss_clean($this->input->post('product_name')),
							'product_code'  =>  $this->security->xss_clean($this->input->post('product_code')),
							'formula_code'  =>  $this->security->xss_clean($this->input->post('formula_code')),
							'product_label'  =>  $this->security->xss_clean($this->input->post('product_label')),
							'mfg_date'  =>  $this->security->xss_clean($this->input->post('mfg_date')),
							'expiry_date'  =>  $this->security->xss_clean($this->input->post('product_expiry_date')),
							'description'  =>  $this->security->xss_clean($this->input->post('product_condition_description')),
							'batch_quantity'  =>  $this->security->xss_clean($this->input->post('product_batch_quantity')),
							'packaging'  =>  $this->security->xss_clean($this->input->post('product_packaging')),
							'storage_condition'  =>  $this->security->xss_clean($this->input->post('product_storage_condition')),
							'prepared_by'  =>  $this->security->xss_clean($this->input->post('product_verification_prepared_by')),
							'prepared_date_time'  =>  $this->security->xss_clean($this->input->post('product_verification_prepared_date_time')),
							'approved_by'  =>  $this->security->xss_clean($this->input->post('product_verification_approved_by')),
							'approved_date_time'  =>  $this->security->xss_clean($this->input->post('product_verification_approved_date_time')),
						);

						// Check if batch number already exist
						$result = $this->queries->select_where("*", 'tbl_batch_manufacturing_products', ['batch_number' => $product['batch_number']], true);
						if ($result) {
							$response = ['status' => 'fail', 'message' => 'Fail, Batch number already exist! ('.$product['batch_number'].')'];
							echo json_encode($response);
							exit();
						}
						// Insert products
						$product_id = $this->queries->insert($product, 'tbl_batch_manufacturing_products', true);

						// Check if product insertion is successful
						if ($product_id) {

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
							$document = null;
							if (!empty($_FILES['help']['tmp_name']) && is_valid_file($_FILES['help']['tmp_name'])) {
								// return a proper base64 format based on the file type
								$base64_type = $_FILES['help']['type'] == 'application/pdf' ? 'data:application/pdf;base64,' : 'data:image/jpeg;base64,';
								// convert file pdf/img file into base64
								$document = $base64_type.base64_encode(file_get_contents($_FILES['help']['tmp_name']));
							} 

							// Check if insertion of help file is successful. If not, then return a detailed database error
							if (!$this->queries->insert(['FK_product_id' => $product_id, 'help' => $document], 'tbl_batch_manufacturing_product_help', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							$product_issuance = array(
								'FK_product_id' => $product_id,
								'issued_by'  =>  $this->security->xss_clean($this->input->post('product_issuance_issued_by')),
								'issued_date_time'  =>  $this->security->xss_clean($this->input->post('product_issuance_issued_date_time')),
								'accepted_by'  =>  $this->security->xss_clean($this->input->post('product_issuance_accepted_by')),
								'accepted_date_time'  =>  $this->security->xss_clean($this->input->post('product_issuance_accepted_date_time')),
							);

							if (!$this->queries->insert($product_issuance, 'tbl_batch_manufacturing_product_issuance', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion product referernce documents
							$product_reference = [];
							// Define variables for form fields
							$sop_name = $this->security->xss_clean($this->input->post('product_reference_sop_name'));
							$sop_number = $this->security->xss_clean($this->input->post('product_reference_sop_number'));
							$product_reference_description = $this->security->xss_clean($this->input->post('product_reference_description'));
							$verified_by = $this->security->xss_clean($this->input->post('product_reference_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('product_reference_verified_date_time'));

							// Prepare the array of row data
							for ($i = 0; $i < count($sop_name); $i++) {
								$document = null;

								// Validate image file type
								if (!empty($_FILES['product_reference_document']['tmp_name'][$i]) && !is_valid_file($_FILES['product_reference_document']['tmp_name'][$i])) {
									// Return the status of image upload
									echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
									exit();
								}

								// Convert image into base64
								if (!empty($_FILES['product_reference_document']['tmp_name'][$i]) && is_valid_file($_FILES['product_reference_document']['tmp_name'][$i])) {
									// return a proper base64 format based on the file type
									$base64_type = $_FILES['product_reference_document']['type'][$i] == 'application/pdf' ? 'data:application/pdf;base64,' : 'data:image/jpeg;base64,';
									// convert file pdf/img file into base64
									$document = $base64_type.base64_encode(file_get_contents($_FILES['product_reference_document']['tmp_name'][$i]));
								} 

								// Set the organized data to insert
								$product_reference[] = [
									'FK_product_id' => $product_id,
									'sop_name' => $sop_name[$i],
									'sop_number' => $sop_number[$i],
									'description' => $product_reference_description[$i],
									'document' => $document,
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert product_references
							if (!$this->queries->insert_batch($product_reference, 'tbl_batch_manufacturing_product_reference_documents')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion of product raw materials
							$product_raw_materials = [];
							// Define variables for form fields
							$raw_materials_name = $this->security->xss_clean($this->input->post('raw_materials_name'));
							$product_raw_material_description = $this->security->xss_clean($this->input->post('product_raw_material_description'));
							$lot_number = $this->security->xss_clean($this->input->post('raw_material_lot_number'));
							$supplier_name = $this->security->xss_clean($this->input->post('raw_material_supplier_name'));
							$supplier_code = $this->security->xss_clean($this->input->post('raw_material_supplier_code'));
							$expiration_date = $this->security->xss_clean($this->input->post('raw_material_expiration_date'));
						
							// Prepare the array of row data
							for ($i = 0; $i < count($raw_materials_name); $i++) {

								// Set the organized data to insert
								$product_raw_materials[] = [
									'FK_product_id' => $product_id,
									'raw_materials_name' => $raw_materials_name[$i],
									'description' => $product_raw_material_description[$i],
									'lot_number' => $lot_number[$i],
									'supplier_name' => $supplier_name[$i],
									'supplier_code' => $supplier_code[$i],
									'expiration_date' => $expiration_date[$i],
								];

							}

							// Insert product raw materials
							if (!$this->queries->insert_batch($product_raw_materials, 'tbl_batch_manufacturing_product_raw_materials')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 


							// Insertion of product retest record
							$product_retest = array(
								'FK_product_id' => $product_id,
								'retest_date'  =>  $this->security->xss_clean($this->input->post('product_retest_date')),
								'quantity_staged'  =>  $this->security->xss_clean($this->input->post('product_retest_quantity_staged')),
								'performed_by'  =>  $this->security->xss_clean($this->input->post('product_retest_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('product_retest_performed_date_time')),
								'verified_by'  =>  $this->security->xss_clean($this->input->post('product_retest_verified_by')),
								'verified_date_time'  =>  $this->security->xss_clean($this->input->post('product_retest_verified_date_time')),
								'total_quantity_staged'  =>  $this->security->xss_clean($this->input->post('product_retest_total_quantity_staged')),
							);

							if (!$this->queries->insert($product_retest, 'tbl_batch_manufacturing_product_retest', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}
							
							// Insertion of product packaging materials
							$product_packaging_materials = [];
							// Define variables for form fields
							$packaging_material_name = $this->security->xss_clean($this->input->post('packaging_material_name'));
							$product_packaging_material_description = $this->security->xss_clean($this->input->post('packaging_material_description'));
							$lot_number = $this->security->xss_clean($this->input->post('packaging_material_lot_number'));
							$supplier_name = $this->security->xss_clean($this->input->post('packaging_material_supplier_name'));
							$supplier_code = $this->security->xss_clean($this->input->post('packaging_material_supplier_code'));
						
							// Prepare the array of row data
							for ($i = 0; $i < count($packaging_material_name); $i++) {

								// Set the organized data to insert
								$product_packaging_materials[] = [
									'FK_product_id' => $product_id,
									'packaging_material_name' => $packaging_material_name[$i],
									'description' => $product_packaging_material_description[$i],
									'lot_number' => $lot_number[$i],
									'supplier_name' => $supplier_name[$i],
									'supplier_code' => $supplier_code[$i],
								];

							}

							// Insert product packaging materials
							if (!$this->queries->insert_batch($product_packaging_materials, 'tbl_batch_manufacturing_product_packaging_materials')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion of product material verification record
							$product_material_verification = array(
								'FK_product_id' => $product_id,
								'quantity_staged'  =>  $this->security->xss_clean($this->input->post('packaging_material_quantity_staged')),
								'performed_by'  =>  $this->security->xss_clean($this->input->post('packaging_material_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('packaging_material_performed_date_time')),
								'verified_by'  =>  $this->security->xss_clean($this->input->post('packaging_material_verified_by')),
								'verified_date_time'  =>  $this->security->xss_clean($this->input->post('packaging_material_verified_date_time')),
							);

							if (!$this->queries->insert($product_material_verification, 'tbl_batch_manufacturing_product_packaging_materials_verification', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion of product labels record
							$product_labels = array(
								'FK_product_id' => $product_id,
								'label_name'  =>  $this->security->xss_clean($this->input->post('label_name')),
								'description'  =>  $this->security->xss_clean($this->input->post('label_description')),
								'lot_number'  =>  $this->security->xss_clean($this->input->post('label_lot_number')),
								'supplier_name'  =>  $this->security->xss_clean($this->input->post('label_supplier_name')),
								'supplier_code'  =>  $this->security->xss_clean($this->input->post('label_supplier_code')),
								'quantity_staged'  =>  $this->security->xss_clean($this->input->post('label_quantity_staged')),
								'performed_by'  =>  $this->security->xss_clean($this->input->post('label_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('label_performed_date_time')),
								'verified_by'  =>  $this->security->xss_clean($this->input->post('label_verified_by')),
								'verified_date_time'  =>  $this->security->xss_clean($this->input->post('label_verified_date_time')),
								'total_quantity_staged'  =>  $this->security->xss_clean($this->input->post('label_total_quantity_staged')),
							);

							if (!$this->queries->insert($product_labels, 'tbl_batch_manufacturing_product_labels', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion of processing equipment record
							$processing_equipment = array(
								'FK_product_id' => $product_id,
								'equipment_name'  =>  $this->security->xss_clean($this->input->post('processing_equipment_name')),
								'description'  =>  $this->security->xss_clean($this->input->post('processing_equipment_description')),
								'equipment_id_number'  =>  $this->security->xss_clean($this->input->post('processing_equipment_id_number')),
								'calibration_date'  =>  $this->security->xss_clean($this->input->post('processing_equipment_calibration_date')),
								'calibration_required'  =>  $this->security->xss_clean($this->input->post('processing_equipment_calibration_required')),
								'performed_by'  =>  $this->security->xss_clean($this->input->post('processing_equipment_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('processing_equipment_performed_date_time')),
								'verified_by'  =>  $this->security->xss_clean($this->input->post('processing_equipment_verified_by')),
								'verified_date_time'  =>  $this->security->xss_clean($this->input->post('processing_equipment_verified_date_time')),
								
							);

							if (!$this->queries->insert($processing_equipment, 'tbl_batch_manufacturing_product_processing_equipment', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}


							// Insertion pre_operation_verifications
							$pre_operation_verification = [];
							// Define variables for form fields
							$pov = $this->security->xss_clean($this->input->post('pre_operation_verification'));
							$status = $this->security->xss_clean($this->input->post('pov_status'));
							$performed_by = $this->security->xss_clean($this->input->post('pov_performed_by'));
							$performed_date_time = $this->security->xss_clean($this->input->post('pov_performed_date_time'));
							$verified_by = $this->security->xss_clean($this->input->post('pov_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('pov_verified_date_time'));

							// Prepare the array of row data
							for ($i = 0; $i < count($pov); $i++) {
								$sop_reference = null;

								// Validate file type
								if (!empty($_FILES['pov_sop_reference']['tmp_name'][$i]) && !is_valid_file($_FILES['pov_sop_reference']['tmp_name'][$i])) {
									// Return the status of image upload
									echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
									exit();
								}

								// Convert image into base64
								if (!empty($_FILES['pov_sop_reference']['tmp_name'][$i]) && is_valid_file($_FILES['pov_sop_reference']['tmp_name'][$i])) {
									// convert file pdf/img file into base64
									$sop_reference = 'data:application/pdf;base64,'.base64_encode(file_get_contents($_FILES['pov_sop_reference']['tmp_name'][$i]));
								} 

								// Set the organized data to insert
								$pre_operation_verification[] = [
									'FK_product_id' => $product_id,
									'pre_operation_verification' => $pov[$i],
									'status' => $status[$i],
									'sop_reference' => $sop_reference,
									'performed_by' => $performed_by[$i],
									'performed_date_time' => $performed_date_time[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i]
								];

							}

							// Insert pre_operation_verifications
							if (!$this->queries->insert_batch($pre_operation_verification, 'tbl_batch_manufacturing_product_preoperation_verification')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion production_procedure
							$production_procedure = [];
							// Define variables for form fields
							$processing_step = $this->security->xss_clean($this->input->post('procedure_processing_step'));
							$procedure_description = $this->security->xss_clean($this->input->post('procedure_description'));
							$performed_by = $this->security->xss_clean($this->input->post('procedure_performed_by'));
							$performed_date_time = $this->security->xss_clean($this->input->post('procedure_performed_date_time'));
							$verified_by = $this->security->xss_clean($this->input->post('procedure_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('procedure_verified_date_time'));

							// Prepare the array of row data
							for ($i = 0; $i < count($processing_step); $i++) {
								$sop_reference = null;

								// Validate file type
								if (!empty($_FILES['procedure_sop_reference']['tmp_name'][$i]) && !is_valid_file($_FILES['procedure_sop_reference']['tmp_name'][$i])) {
									// Return the status of image upload
									echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
									exit();
								}

								// Convert image into base64
								if (!empty($_FILES['procedure_sop_reference']['tmp_name'][$i]) && is_valid_file($_FILES['procedure_sop_reference']['tmp_name'][$i])) {
									// convert file pdf/img file into base64
									$sop_reference = 'data:application/pdf;base64,'.base64_encode(file_get_contents($_FILES['procedure_sop_reference']['tmp_name'][$i]));
								} 

								// Set the organized data to insert
								$production_procedure[] = [
									'FK_product_id' => $product_id,
									'processing_step' => $processing_step[$i],
									'procedure_description' => $procedure_description[$i],
									'sop_reference' => $sop_reference,
									'performed_by' => $performed_by[$i],
									'performed_date_time' => $performed_date_time[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i]
								];

							}

							// Insert pre_operation_verifications
							if (!$this->queries->insert_batch($production_procedure, 'tbl_batch_manufacturing_production_procedures')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion of deviation record
							$deviation = array(
								'FK_product_id' => $product_id,
								'deviation_classification'  =>  $this->security->xss_clean($this->input->post('deviation_classification')),
								'description'  =>  $this->security->xss_clean($this->input->post('deviation_description')),
								'requested_by'  =>  $this->security->xss_clean($this->input->post('deviation_requested_by')),
								'requested_date_time'  =>  $this->security->xss_clean($this->input->post('deviation_requested_date_time')),
								'notes'  =>  $this->security->xss_clean($this->input->post('deviation_notes')),
								'performed_by'  =>  $this->security->xss_clean($this->input->post('deviation_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('deviation_performed_date_time')),
								'approved_by'  =>  $this->security->xss_clean($this->input->post('deviation_approved_by')),
								'approved_date_time'  =>  $this->security->xss_clean($this->input->post('deviation_approved_date_time')),
								
							);

							$sop_reference = null;

							// Validate file type
							if (!empty($_FILES['deviation_sop_reference']['tmp_name']) && !is_valid_file($_FILES['deviation_sop_reference']['tmp_name'])) {
								// Return the status of image upload
								echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
								exit();
							}

							// Convert image into base64
							if (!empty($_FILES['deviation_sop_reference']['tmp_name']) && is_valid_file($_FILES['deviation_sop_reference']['tmp_name'])) {
								// convert file pdf/img file into base64
								$sop_reference = 'data:application/pdf;base64,'.base64_encode(file_get_contents($_FILES['deviation_sop_reference']['tmp_name']));
							} 

							$deviation['sop_reference'] = $sop_reference;

							if (!$this->queries->insert($deviation, 'tbl_batch_manufacturing_product_deviation', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion yield_calculation
							$yield_calculation = [];
							// Define variables for form fields
							$starting_weight_of_raw_materials = $this->security->xss_clean($this->input->post('starting_weight_of_raw_materials'));
							$usable_weight_of_products = $this->security->xss_clean($this->input->post('usable_weight_of_products'));
							$yield_process_loss = $this->security->xss_clean($this->input->post('yield_process_loss'));
							$yield_percentage = $this->security->xss_clean($this->input->post('yield_percentage'));
							

							// Prepare the array of row data
							for ($i = 0; $i < count($starting_weight_of_raw_materials); $i++) {
								
								// Set the organized data to insert
								$yield_calculation[] = [
									'FK_product_id' => $product_id,
									'starting_weight_of_raw_materials' => $starting_weight_of_raw_materials[$i],
									'usable_weight_of_products' => $usable_weight_of_products[$i],
									'process_loss' => $yield_process_loss[$i],
									'yield_percentage' => $yield_percentage[$i],
								];

							}

							// Insert pre_operation_verifications
							if (!$this->queries->insert_batch($yield_calculation, 'tbl_batch_manufacturing_product_yield_caculation')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion of yield_calculation_verification record
							$yield_calculation_verification = array(
								'FK_product_id' => $product_id,
								'performed_by'  =>  $this->security->xss_clean($this->input->post('yield_calculation_performed_by')),
								'performed_date_time'  =>  $this->security->xss_clean($this->input->post('yield_calculation_performed_date_time')),
								'verified_by'  =>  $this->security->xss_clean($this->input->post('yield_calculation_verified_by')),
								'verified_date_time'  =>  $this->security->xss_clean($this->input->post('yield_calculation_verified_date_time')),
							);

							if (!$this->queries->insert($yield_calculation_verification, 'tbl_batch_manufacturing_product_yield_caculation_verification', true)) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							}

							// Insertion rework_reprocess
							$rework_reprocess = [];
							// Define variables for form fields
							$material_quantity_for_reprocessing = $this->security->xss_clean($this->input->post('material_quantity_for_reprocessing'));
							$material_quantity_for_rework = $this->security->xss_clean($this->input->post('material_quantity_for_rework'));
							$performed_by = $this->security->xss_clean($this->input->post('rework_performed_by'));
							$performed_date_time = $this->security->xss_clean($this->input->post('rework_performed_date_time'));
							$verified_by = $this->security->xss_clean($this->input->post('rework_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('rework_verified_date_time'));
							

							// Prepare the array of row data
							for ($i = 0; $i < count($material_quantity_for_reprocessing); $i++) {
								
								// Set the organized data to insert
								$rework_reprocess[] = [
									'FK_product_id' => $product_id,
									'material_quantity_for_reprocessing' => $material_quantity_for_reprocessing[$i],
									'material_quantity_for_rework' => $material_quantity_for_rework[$i],
									'performed_by' => $performed_by[$i],
									'performed_date_time' => $performed_date_time[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert pre_operation_verifications
							if (!$this->queries->insert_batch($rework_reprocess, 'tbl_batch_manufacturing_product_rework')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion packaging_material_trace
							$packaging_material_trace = [];
							// Define variables for form fields
							$packaging_material_name = $this->security->xss_clean($this->input->post('material_trace_packaging_material_name'));
							$total_quantity_staged = $this->security->xss_clean($this->input->post('material_trace_total_quantity_staged'));
							$total_used = $this->security->xss_clean($this->input->post('material_trace_total_used'));
							$disposed = $this->security->xss_clean($this->input->post('material_trace_disposed'));
							$total_remains = $this->security->xss_clean($this->input->post('material_trace_total_remains'));
							$verified_by = $this->security->xss_clean($this->input->post('material_trace_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('material_trace_verified_date_time'));
							

							// Prepare the array of row data
							for ($i = 0; $i < count($packaging_material_name); $i++) {
								
								// Set the organized data to insert
								$packaging_material_trace[] = [
									'FK_product_id' => $product_id,
									'packaging_material_name' => $packaging_material_name[$i],
									'total_quantity_staged' => $total_quantity_staged[$i],
									'total_used' => $total_used[$i],
									'disposed' => $disposed[$i],
									'total_remains' => $total_remains[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert pre_operation_verifications
							if (!$this->queries->insert_batch($packaging_material_trace, 'tbl_batch_manufacturing_product_packaging_material_trace')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion label_trace
							$label_trace = [];
							// Define variables for form fields
							$label_name = $this->security->xss_clean($this->input->post('label_trace_label_name'));
							$total_quantity_staged = $this->security->xss_clean($this->input->post('label_trace_total_quantity_staged'));
							$total_used = $this->security->xss_clean($this->input->post('label_trace_total_used'));
							$disposed = $this->security->xss_clean($this->input->post('label_trace_disposed'));
							$total_remains = $this->security->xss_clean($this->input->post('label_trace_total_remains'));
							$verified_by = $this->security->xss_clean($this->input->post('label_trace_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('label_trace_verified_date_time'));
							

							// Prepare the array of row data
							for ($i = 0; $i < count($label_name); $i++) {
								
								// Set the organized data to insert
								$label_trace[] = [
									'FK_product_id' => $product_id,
									'label_name' => $label_name[$i],
									'total_quantity_staged' => $total_quantity_staged[$i],
									'total_used' => $total_used[$i],
									'disposed' => $disposed[$i],
									'total_remains' => $total_remains[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert label_trace
							if (!$this->queries->insert_batch($label_trace, 'tbl_batch_manufacturing_product_label_trace')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion post_production_verification
							$post_production_verification = [];
							// Define variables for form fields
							$post_production = $this->security->xss_clean($this->input->post('post_production_verification'));
							$performed_by = $this->security->xss_clean($this->input->post('post_production_performed_by'));
							$performed_date_time = $this->security->xss_clean($this->input->post('post_production_performed_date_time'));
							$verified_by = $this->security->xss_clean($this->input->post('post_production_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('post_production_verified_date_time'));
							
							
							// Prepare the array of row data
							for ($i = 0; $i < count($post_production); $i++) {

								$sop_reference = null;

								// Validate file type
								if (!empty($_FILES['post_production_sop_reference']['tmp_name'][$i]) && !is_valid_file($_FILES['post_production_sop_reference']['tmp_name'][$i])) {
									// Return the status of image upload
									echo json_encode(['status' => 'fail', 'message' => 'FIle is not a valid image/pdf!']);
									exit();
								}

								// Convert image into base64
								if (!empty($_FILES['post_production_sop_reference']['tmp_name'][$i]) && is_valid_file($_FILES['post_production_sop_reference']['tmp_name'][$i])) {
									// convert file pdf/img file into base64
									$sop_reference = 'data:application/pdf;base64,'.base64_encode(file_get_contents($_FILES['post_production_sop_reference']['tmp_name'][$i]));
								} 

								// Set the organized data to insert
								$post_production_verification[] = [
									'FK_product_id' => $product_id,
									'post_production_verification' => $post_production[$i],
									'sop_reference' => $sop_reference,
									'performed_by' => $performed_by[$i],
									'performed_date_time' => $performed_date_time[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert label_trace
							if (!$this->queries->insert_batch($post_production_verification, 'tbl_batch_manufacturing_product_post_production_verification')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion production_team_members
							$production_team_members = [];
							// Define variables for form fields
							$member_name = $this->security->xss_clean($this->input->post('team_member_name'));
							$position = $this->security->xss_clean($this->input->post('team_member_position'));
							$qualified = $this->security->xss_clean($this->input->post('team_member_qualified'));
							$notes = $this->security->xss_clean($this->input->post('team_member_notes'));
							$training_record_reference = $this->security->xss_clean($this->input->post('team_member_training_record_reference'));
							$verified_by = $this->security->xss_clean($this->input->post('team_member_verified_by'));
							$verified_date_time = $this->security->xss_clean($this->input->post('team_member_verified_date_time'));
							
							
							// Prepare the array of row data
							for ($i = 0; $i < count($member_name); $i++) {

								// Set the organized data to insert
								$production_team_members[] = [
									'FK_product_id' => $product_id,
									'member_name' => $member_name[$i],
									'position' => $position[$i],
									'qualified' => $qualified[$i],
									'notes' => $notes[$i],
									'training_record_reference' => $training_record_reference[$i],
									'verified_by' => $verified_by[$i],
									'verified_date_time' => $verified_date_time[$i],
								];

							}

							// Insert production_team_members
							if (!$this->queries->insert_batch($production_team_members, ' tbl_batch_manufacturing_product_team_members')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

							// Insertion production_team_members
							$post_production_review = [];
							// Define variables for form fields
							$production_review = $this->security->xss_clean($this->input->post('post_production_review'));
							$production_reviewed_by = $this->security->xss_clean($this->input->post('production_reviewed_by'));
							$production_reviewed_date_time = $this->security->xss_clean($this->input->post('production_reviewed_date_time'));
							$qa_reviewed_by = $this->security->xss_clean($this->input->post('production_review_qa_reviewed_by'));
							$qa_reviewed_date_time = $this->security->xss_clean($this->input->post('production_review_qa_reviewed_date_time'));
							
							
							// Prepare the array of row data
							for ($i = 0; $i < count($production_review); $i++) {

								// Set the organized data to insert
								$post_production_review[] = [
									'FK_product_id' => $product_id,
									'post_production_review' => $production_review[$i],
									'production_reviewed_by' => $production_reviewed_by[$i],
									'production_reviewed_date_time' => $production_reviewed_date_time[$i],
									'qa_reviewed_by' => $qa_reviewed_by[$i],
									'qa_reviewed_date_time' => $qa_reviewed_date_time[$i],
								];

							}

							// Insert post_production_review
							if (!$this->queries->insert_batch($post_production_review, ' tbl_batch_manufacturing_product_review')) {
								// Show a detailed database error
								$error = $this->db->error();
								echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
								exit();
							} 

						} else {
							// Show a detailed database error
							$error = $this->db->error();
							echo json_encode(['error code' => $error['code'], 'error message' => $error['message']]);
							exit();
						}

						$response = ['status' => 'success', 'message' => 'Success, Data has been saved!'];
						// Return status of insert batch query
						echo json_encode($response);
						exit();
					} catch(\Exception $e) {
						log_message('error', $e->getMessage());
						redirect(site_url('Forms/Consultare/gmp_bmr'));
					}
				}
				
				// Define proper route redirection
				$this->content = 'consultare/batch_manufacturing_record_form';            
				break;
				
        }

        $this->load->view('template/header');
        $this->load->view($this->content, $data);                    
        $this->load->view('template/footer');
    }

}
