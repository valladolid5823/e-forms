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
			case 'gmp_gr':
                if (!$extra) {
                    $data['records'] = $this->queries->select_where ('*', 'tbl_afia_gmp_records', array('gr_status_flag' => 'A'));
                    $this->content = 'consultare/gmp_glass_register_record';
                }

                if ($extra && strtolower($extra) == 'details') {
                    $this->content = 'consultare/gmp_glass_register_record_details';
                    $record_id = $this->input->get('id');
                    $data['id'] = $record_id;
                    $data['content'] = $this->queries->select_where_orderby ('*', 'tbl_afia_gmp_glass_register', array('FK_grd_record_id' => $record_id), 'PK_id', 'desc');
                    $data['records'] = $this->queries->select_where ('*', 'tbl_afia_gmp_records', array('PK_id' => $record_id));
                    $data['comments'] = $this->queries->select_where ('comments', 'tbl_afia_gmp_glass_register_comments', array('FK_grd_record_id' => $record_id), false, true);
                    
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
