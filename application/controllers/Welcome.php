<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    private $code;
    private $user_id;
    private $name;
    
    function __construct() {
        parent::__construct();
        
        $this->code = $this->uri->segment(3);//strtoupper($this->uri->segment(3));
        $this->user_id = $this->uri->segment(4);
        $this->user_name = urldecode($this->uri->segment(5));
    }
	public function index()
	{
	    if($this->code != "" && $this->user_id != "" && $this->user_name){
	       
            $result = $this->sapdb->checkClientCode($this->code);
            if(!empty($result)){
                $check_user = $this->prpdb->checkAccountInfo($this->user_id, $this->user_name, $this->code);
                if(!empty($check_user)){
                    $this->session->set_userdata(Array("client_code" => $this->code, "user_id" => $this->user_id, "user_name" => $this->user_name));
                    redirect(site_url("forms"));
                }else{
                    $this->load->view("errors/html/error_general.php", Array("heading" => "Denied Access", "message" => "Account Does not Exists"));
                }
                
            }else{
                $this->load->view("errors/html/error_general.php", Array("heading" => "Denied Access", "message" => "Please login using your PRP Account"));
            }
            
	    }else{
	       
           echo "Denied Access";
	    }
        
	}
}
