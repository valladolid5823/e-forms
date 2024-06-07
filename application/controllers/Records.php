<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Controller {
    
    protected $content = '';

    public function __construct() {
        
        parent::__construct();
    }

    public function Consultare($form, $extra = null) {

        $data = array();

        switch (strtolower($form)) {
			// Glass Register
			case 'gmp_bmr':
                if (!$extra) {
                    $data['records'] = $this->queries->select_no_where ('*', 'tbl_batch_manufacturing_products');
                    $this->content = 'consultare/batch_manufacturing_record';
                }

                if ($extra && strtolower($extra) == 'details') {
                    $this->content = 'consultare/batch_manufacturing_record_details';
                    $record_id = $this->input->get('id');
                    $data['id'] = $record_id;

					$data['help'] = $this->queries->select_where ('help', 'tbl_batch_manufacturing_product_help', array('FK_product_id' => $record_id), false, true);       
					$data['product_details'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_products', array('PK_id' => $record_id));       
					$data['product_record_issuance'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_issuance', array('FK_product_id' => $record_id));       
					$data['reference_documents'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_reference_documents', array('FK_product_id' => $record_id));       
					$data['raw_materials'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_raw_materials', array('FK_product_id' => $record_id));       
					$data['raw_materials_retest'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_retest', array('FK_product_id' => $record_id));       
					$data['packaging_materials'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_packaging_materials', array('FK_product_id' => $record_id));       
					$data['packaging_materials_verification'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_packaging_materials_verification', array('FK_product_id' => $record_id));       
					$data['labels'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_labels', array('FK_product_id' => $record_id));       
					$data['processing_equipment'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_processing_equipment', array('FK_product_id' => $record_id));       
					$data['preoperation_verifications'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_preoperation_verification', array('FK_product_id' => $record_id));       
					$data['production_procedures'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_production_procedures', array('FK_product_id' => $record_id));       
					$data['product_deviation'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_deviation', array('FK_product_id' => $record_id));       
					$data['yield_caculation'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_yield_caculation', array('FK_product_id' => $record_id));       
					$data['yield_caculation_verification'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_yield_caculation_verification', array('FK_product_id' => $record_id));       
					$data['product_rework'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_rework', array('FK_product_id' => $record_id));       
					$data['packaging_material_trace'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_packaging_material_trace', array('FK_product_id' => $record_id));       
					$data['packaging_material_trace'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_packaging_material_trace', array('FK_product_id' => $record_id));       
					$data['label_trace'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_label_trace', array('FK_product_id' => $record_id));       
					$data['post_production_verification'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_post_production_verification', array('FK_product_id' => $record_id));       
					$data['team_members'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_team_members', array('FK_product_id' => $record_id));       
					$data['product_review'] = $this->queries->select_where ('*', 'tbl_batch_manufacturing_product_review', array('FK_product_id' => $record_id));       
                }
                if ($extra && strtolower($extra) == 'download') {

                    $this->content = 'consultare/batch_manufacturing_record_details';
                    $record_id = $this->input->get('record_id');
                    $row_id = $this->input->get('row_id');
                    $table = $this->input->get('table');

                    if ($table == "reference_documents") {
                        $document = $this->queries->select_where ('document', 'tbl_batch_manufacturing_product_reference_documents', array('PK_id' => $row_id), false, true);
                    }

                    // Decode the base64 string
                    $pdf_content = base64_decode($document);

                    // Check if the decoding was successful
                    if ($pdf_content === false) {
                        die('Base64 decode failed.');
                    }

                    // Set headers to force download
                    header('Content-Type: application/pdf');
                    header('Content-Disposition: attachment; filename="output.pdf"');
                    header('Content-Length: ' . strlen($pdf_content));

                    // Output the PDF content
                    echo $pdf_content;



                    // Close window after download
                    // echo "<script>window.close()</script>";
                    exit();
                    // redirect(site_url("Records/Consultare/gmp_bmr/details?id=".$record_id.""));
    
                }
                break;            
            default:
                redirect($this->agent->referrer());
                break;
        }

        $this->load->view('template/header');
        $this->load->view($this->content, $data);                    
        $this->load->view('template/footer');
    }
}
