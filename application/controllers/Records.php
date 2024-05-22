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
			case 'gmp_at':
                if (!$extra) {
                    $data['records'] = $this->queries->select_where ('*', 'tbl_allergen_test_signatures', array('gr_status_flag' => 'A'));
                    $this->content = 'consultare/allergen_test_record';
                }

                if ($extra && strtolower($extra) == 'details') {
                    $this->content = 'consultare/allergen_test_record_details';
                    $record_id = $this->input->get('id');
                    $data['id'] = $record_id;
                    $data['content'] = $this->queries->select_where_orderby ('*', 'tbl_allergen_test_record', array('FK_at_signature_id' => $record_id), 'PK_id', 'desc');
                    $data['records'] = $this->queries->select_where ('*', 'tbl_allergen_test_signatures', array('PK_id' => $record_id));                    
                    $data['help'] = $this->queries->select_where ('help', 'tbl_allergen_test_record_help', array('FK_at_signature_id' => $record_id), false, true);                    
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
