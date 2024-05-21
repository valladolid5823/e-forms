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
			// Water Activity Tester Calibration Help
			case 'gmp_watch':
                if (!$extra) {
                    $data['records'] = $this->queries->select_where ('*', 'tbl_watch_signatures', array('gr_status_flag' => 'A'));
                    $this->content = 'consultare/gmp_water_activity_test_record';
                }

                if ($extra && strtolower($extra) == 'details') {
                    $this->content = 'consultare/gmp_water_activity_test_record_details';
                    $record_id = $this->input->get('id');
                    $data['id'] = $record_id;
                    $data['performance_checks'] = $this->queries->select_where_orderby ('*', 'tbl_watch_performance_check', array('FK_watch_signature_id' => $record_id), 'PK_id', 'desc');
                    $data['operational_calibration_verifications'] = $this->queries->select_where_orderby ('*', 'tbl_watch_operational_calibration_verification', array('FK_watch_signature_id' => $record_id), 'PK_id', 'desc');
                    $data['records'] = $this->queries->select_where ('*', 'tbl_watch_signatures', array('PK_id' => $record_id));
                    
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
