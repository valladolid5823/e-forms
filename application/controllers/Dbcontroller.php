<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbcontroller extends CI_Controller {

	
	public function createNewForm(){
       $pattern = "/[$&+,:;=?@#|'<>.-^*()%!_-]/";
       $f = str_replace(" ", "_", strtolower($this->input->post("form_title")));
       $form = preg_replace($pattern, '', $f);

       $initials = $this->countTable($this->session->userdata("client_code"));
       
       
       if($this->queries->check_table($form, $initials)){
        
            $this->queries->insert(Array("genfl_client_code"      => $this->session->userdata("client_code"),
                                         "genfl_table_name"       => strtolower($this->session->userdata("client_code"))."_".$form,
                                         "genfl_form_title"       => $this->input->post("form_title"),
                                         "genfl_form_department"  => $this->input->post("form_department"),
                                         "genfl_form_description" => $this->input->post("form_description"),
                                         "genfl_table_code"       => $initials),
                                         
                                         "generic_forms_list");
            echo "ok";
       }else{
            echo "Form already exists!";
       }
	}
    
    public function createNewSetting(){
        
        $size = 0;
        if($this->input->post("value_type") == "INT"){
            $size = 11;
        }elseif($this->input->post("value_type") == "VARCHAR"){
            $size = $this->input->post("max_size");
        }
        
        if($this->input->post("pk_structure_id") == ""){ //insert new structure
            
            $check_exists = $this->queries->select_where("*", "generic_table_structure", Array("gents_field_name" => $this->input->post("field_name"), "gents_status_flag" => "A", "FK_gents_form_list_id" => $this->input->post("primary_key")));
        
            if(empty($check_exists)){
                
                $get_table = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("primary_key")));
                
                $initials = $this->getCode($this->input->post("primary_key"));
                /*$code = explode(" ", $get_table[0]["genfl_form_title"]);
                foreach($code as $c){
                    $initials .= $c[0];
                }*/
                $pattern = "/[$&+,:;=?@#|'<>.-^*()%!_-]/";
                $fieldn = strtolower($this->session->userdata("client_code").$initials."_".str_replace(" ", "_", $this->input->post("field_name")));
                $field_name = preg_replace($pattern, '', $fieldn);

                $id = $this->queries->insert(Array("FK_gents_form_list_id"  => $this->input->post("primary_key"),
                                                   "gents_column_name"      => $field_name,
                                                   "gents_field_name"       => $this->input->post("field_name"),
                                                   "gents_data_type"        => $this->input->post("value_type"),
                                                   "gents_size"             => $size,
                                                   "gents_value_option"     => $this->input->post("value_option") ), 
                                                   
                                                   "generic_table_structure", true);
                
                if(isset($_POST["selection_value"])){
                    $value = $this->input->post("selection_value");
                                                    
                    for($i = 0; $i < count($value); $i++){
                        $this->queries->insert(Array("FK_gensv_table_structure_id"  => $id,
                                                     "gensv_value"                  => $value[$i]), "generic_selection_values");
                    }
                }
                
                
                $structure = Array();
                
                if($this->input->post("value_type") == "TEXT" || $this->input->post("value_type") == "FLOAT"){
                    $structure = Array($field_name => Array("type" => $this->input->post("value_type")));
                }else{
                    $size = null;
                    if($this->input->post("value_type") == "VARCHAR"){
                        $size = $this->input->post("max_size");
                    }elseif($this->input->post("value_type") == "INT"){
                        $size = 11;
                    }
                    
                    $structure = Array($field_name => Array("type" => $this->input->post("value_type"), "constraint" => $size));
                }
                
                
                $this->queries->add_column($get_table[0]["genfl_table_name"], $structure);
                
                //echo "ok";
                echo json_encode(Array("message" => "ok", "columns" => $this->getColumns($this->input->post("primary_key"))));
            }else{
                
                //echo "Column Name already exists";
                echo json_encode(Array("message" => "Column Name already exists!"));
            }
        }else{ // update existing structure
            
            $check_exists = $this->queries->select_where("*", "generic_table_structure", Array("gents_field_name" => $this->input->post("field_name"), "PK_table_structure_id != " => $this->input->post("pk_structure_id"), "gents_status_flag" => "A", "FK_gents_form_list_id" => $this->input->post("primary_key")));
            
            if(empty($check_exists)){
                
                $initials = $this->getCode($this->input->post("primary_key"));
                $orig_field = $this->queries->select_where("*", "generic_table_structure", Array("PK_table_structure_id" => $this->input->post("pk_structure_id")));
                
                $field_name = strtolower($this->session->userdata("client_code").$initials."_".str_replace(" ", "_", $this->input->post("field_name")));
                    
                $this->queries->update_where(Array("gents_column_name"      => $field_name,
                                                   "gents_field_name"       => $this->input->post("field_name"),
                                                   "gents_data_type"        => $this->input->post("value_type"),
                                                   "gents_size"             => $size,
                                                   "gents_value_option"     => $this->input->post("value_option") ), 
                                                       
                                                   "generic_table_structure", Array("PK_table_structure_id" => $this->input->post("pk_structure_id")));
                
                $this->queries->delete("generic_selection_values", Array("FK_gensv_table_structure_id" => $this->input->post("pk_structure_id")));
                
                if(isset($_POST["selection_value"])){
                    $value = $this->input->post("selection_value");
                                                    
                    for($i = 0; $i < count($value); $i++){
                        $this->queries->insert(Array("FK_gensv_table_structure_id"  => $this->input->post("pk_structure_id"),
                                                     "gensv_value"                  => $value[$i]), "generic_selection_values");
                    }
                }
                
                
                
                $structure = Array();
                
                if($this->input->post("value_type") == "TEXT" || $this->input->post("value_type") == "FLOAT"){
                    $structure = Array($orig_field[0]["gents_column_name"] => Array("name" => $field_name, "type" => $this->input->post("value_type")));
                }else{
                    $size = null;
                    if($this->input->post("value_type") == "VARCHAR"){
                        $size = $this->input->post("max_size");
                    }elseif($this->input->post("value_type") == "INT"){
                        $size = 11;
                    }
                    
                    $structure = Array($orig_field[0]["gents_column_name"] => Array("name" => $field_name, "type" => $this->input->post("value_type"), "constraint" => $size));
                }
                
                
                $this->queries->alter_column($this->getTable($this->input->post("primary_key")), $structure);
                
                echo json_encode(Array("message" => "ok", "columns" => $this->getColumns($this->input->post("primary_key"))));
            }else{
                
                echo json_encode(Array("message" => "Column Name already exists!"));
            }
            
            
        }
        
        
        
    }
    
    public function showColumns(){
        
        echo $this->getColumns($this->input->post("primary_key"));
    }
    
    private function getColumns($id){
        
        $select_columns = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $id, "gents_status_flag" => "A"));
        
        $table = "<table class='table table-striped' style='width: 100%;'>";
            $table .= "<thead>";
                $table .= "<tr>";
                    $table .= "<th>No.</th>";
                    $table .= "<th>Column Name</th>";
                    $table .= "<th>Controls</th>";
                $table .= "</tr>";
            $table .= "</thead>";
            $table .= "<tbody>";
                $i = 1;
                if(!empty($select_columns)){
                    foreach($select_columns as $sc){
                        $table .= "<tr>";
                            $table .= "<td>{$i}</td>";
                            $table .= "<td>{$sc["gents_field_name"]}</td>";
                            $table .= "<td>";
                                $table .= "<a href='#' class='edit_field_structure' PK_structure_id='{$sc["PK_table_structure_id"]}'><i class='fa fa-edit text-blue'></i></a> | ";
                                $table .= "<a href='#' data-bs-toggle='modal' data-bs-target='#delete_form' class='form_delete' PK_id='{$sc["PK_table_structure_id"]}' Form_name='{$sc["gents_field_name"]}' Option='column' style='color: red;'><i class='fa fa-trash'></i></a>";
                            $table .= "</td>";
                        $table .= "</tr>";
                    $i++;
                    }
                }
            $table .= "</tbody>";
        $table .= "</table>";
        
        
        return $table;
        
    }
    
    public function getFormFields(){
        
        $select_columns = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("PK_id"), "gents_status_flag" => "A"));
        $form_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("PK_id")));
        $fields = "";
        
        if(!empty($select_columns)){
            
            
            //$fields .= "<ul class='flex-outer'>";
            foreach($select_columns as $sc){
                
                if($sc["gents_value_option"] == "M"){
                    $input_type = "text";
                    if($sc["gents_data_type"] == "TIME" || $sc["gents_data_type"] == "DATE"){
                        $input_type = strtolower($sc["gents_data_type"]);
                    }
                    //$fields .= "<li>";
                    $fields .= "<div class='input-group mb-3'>";
                        $fields .= "<label class='input-group-text' for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        $fields .= "<input type='$input_type' name='{$sc["gents_column_name"]}' class='form-control' id={$sc["gents_column_name"]}' required='' />";
                    $fields .= "</div>";
                        //$fields .= "<label for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        //$fields .= "<input type='{$input_type}' name='{$sc["gents_column_name"]}' id='{$sc["gents_column_name"]}' required='' />";
                    //$fields .= "</li>";
                }else{
                    //$fields .= "<li>";
                    $fields .= "<div class='input-group mb-3'>";
                        $fields .= "<label class='input-group-text' for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        $fields .= "<select name='{$sc["gents_column_name"]}' class='form-select' id='{$sc["gents_column_name"]}'>";
                        $select_options = $this->queries->select_where("*", "generic_selection_values", Array("FK_gensv_table_structure_id" => $sc["PK_table_structure_id"], "gensv_status_flag" => "A"));
                            foreach($select_options as $so){
                                $fields .= "<option value='{$so["gensv_value"]}'>{$so["gensv_value"]}</option>";
                            }
                        $fields .= "</select>";
                    $fields .= "</div>";
                        //$fields .= "<label for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        //$fields .= "<select name='{$sc["gents_column_name"]}' id='{$sc["gents_column_name"]}'>";
                            //$select_options = $this->queries->select_where("*", "generic_selection_values", Array("FK_gensv_table_structure_id" => $sc["PK_table_structure_id"], "gensv_status_flag" => "A"));
                            //foreach($select_options as $so){
                                //$fields .= "<option value='{$so["gensv_value"]}'>{$so["gensv_value"]}</option>";
                            //}
                            
                        //$fields .= "</select>";
                    //$fields .= "</li>";
                }
                
            }
            
                //$fields .= "<li>";
                    //$fields .= "<button type='submit'>SAVE RECORD</button>";
                //$fields .= "</li>";
                
           // $fields .= "</ul>";
            $fields .= "<input type='hidden' name='form_id' value='{$select_columns[0]["FK_gents_form_list_id"]}' />";
           
        }
        
        echo json_encode(Array("fields" => $fields, "title" => $form_name[0]["genfl_form_title"]." New Record"));
        
    }
    
    public function saveNewRecord(){
        
        $select_columns = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("form_id")));
        $default_columns = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("form_id")));
        
        $updated_by = strtolower($default_columns[0]["genfl_client_code"].$default_columns[0]["genfl_table_code"])."_lastupdated_by_id";
        $date_updated = strtolower($default_columns[0]["genfl_client_code"].$default_columns[0]["genfl_table_code"])."_lastupdated_by_name";
        
        $data = Array();
        
        if(!empty($select_columns)){
            
            foreach($select_columns as $sc){
                
                $data = $data + Array($sc["gents_column_name"] => $this->input->post($sc["gents_column_name"]));
            }
            
            $data = $data + Array($updated_by => $this->session->userdata("user_id"), $date_updated => $this->session->userdata("user_name"));
        }
        
        $this->queries->insert($data, $this->getTable($this->input->post("form_id")));
        echo "ok";
    }
    
    public function getRecords(){
        
        $table = $this->getTable($this->input->post("PK_id"));
        $data["records"] = $this->queries->select_no_where("*", $table);
        $data["columns"] = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("PK_id")));
        $data["table"] = $table;
        $PK_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("PK_id")));
        
        $data["primary_key"] = "PK_".strtolower($PK_name[0]["genfl_client_code"].$PK_name[0]["genfl_table_code"])."_id";
        $data["form_id"] = $this->input->post("PK_id");
        
        if(!empty($data["records"])){
            $this->load->view("records.php", $data);
        }else{
            echo "No Record available";
        }
        
        
    }
    
    public function updateTable(){
        
        $old_table = $this->getTable($this->input->post("primary_key"));
        $new_table = strtolower($this->session->userdata("client_code")."_".str_replace(" ", "_", $this->input->post("form_title")));
        
        $this->queries->alter_table($old_table, $new_table);
        
        $this->queries->update_where(Array("genfl_table_name"       => $new_table,
                                           "genfl_form_title"       => $this->input->post("form_title"),
                                           "genfl_form_department"  => $this->input->post("form_department"),
                                           "genfl_form_description" => $this->input->post("form_description")), 
                                            "generic_forms_list", Array("PK_form_list_id" => $this->input->post("primary_key")));
    }
    
    public function getStructureDetails(){
        
        $details = $this->queries->query("SELECT * FROM generic_table_structure
                                            	   LEFT JOIN generic_selection_values ON FK_gensv_table_structure_id = PK_table_structure_id
                                            	   WHERE PK_table_structure_id = ".$this->input->post("pk_structure_id"));
        
        $options = "";
        $i = 0;
        
        if($details[0]["gents_value_option"] == "S"){
            foreach($details as $d){
                $options .= "<tr>";
                    $options .= "<td><input type='text' class='form-control selection_value' value='{$d["gensv_value"]}' name='selection_value[]' required='' id='sv{$i}' /></td>";
                $options .= "</tr>";
                $i++;
            }
        }
        
        echo json_encode(Array("field_name" => $details[0]["gents_field_name"], "value_type" => $details[0]["gents_data_type"], "value_option" => $details[0]["gents_value_option"], "size" => $details[0]["gents_size"], "option_values" => $options));
        
    }
    
    public function deleteTableColumn(){
        
        if($this->input->post("option") == "table"){
            
            $this->queries->drop_table($this->getTable($this->input->post("primary_key")));
            $this->queries->update_where(Array("genfl_status_flag" => "X"), "generic_forms_list", Array("PK_form_list_id" => $this->input->post("primary_key")));
            $this->queries->update_where(Array("gents_status_flag" => "X"), "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("primary_key")));
            
        }else{
            $details = $this->queries->select_where("*", "generic_table_structure", Array("PK_table_structure_id" => $this->input->post("primary_key")));
            
            $this->queries->drop_column($this->getTable($details[0]["FK_gents_form_list_id"]), $details[0]["gents_column_name"]);
            $this->queries->update_where(Array("gents_status_flag" => "X"), "generic_table_structure", Array("PK_table_structure_id" => $this->input->post("primary_key")));
            $this->queries->delete("generic_selection_values", Array("FK_gensv_table_structure_id" => $this->input->post("primary_key")));
        
            echo $this->getColumns($details[0]["FK_gents_form_list_id"]);
        }
        
    }
    
    public function viewRecordsDetail(){
        
        $data = Array();
        $PK_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("Form_id")));
        
        $primary_key = "PK_".strtolower($PK_name[0]["genfl_client_code"].$PK_name[0]["genfl_table_code"]."_".str_replace(" ", "_",$PK_name[0]["genfl_form_title"]))."_id";
        
        $get_records = $this->queries->select_where("*", $this->getTable($this->input->post("Form_id")), Array($primary_key => $this->input->post("PK_id")));
        
        $select_columns = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("Form_id"), "gents_status_flag" => "A"));
        $form_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("Form_id")));
        $fields = "";
        
        if(!empty($select_columns)){
            
            foreach($select_columns as $sc){
                
                if($sc["gents_value_option"] == "M"){
                    $input_type = "text";
                    if($sc["gents_data_type"] == "TIME" || $sc["gents_data_type"] == "DATE"){
                        $input_type = strtolower($sc["gents_data_type"]);
                    }
                    
                    $fields .= "<div class='input-group mb-3'>";
                        $fields .= "<label class='input-group-text' for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        $fields .= "<input type='$input_type' name='{$sc["gents_column_name"]}' value='{$get_records[0][$sc["gents_column_name"]]}' class='form-control' id={$sc["gents_column_name"]}' required='' />";
                    $fields .= "</div>";
                }else{
                    
                    $fields .= "<div class='input-group mb-3'>";
                        $fields .= "<label class='input-group-text' for='{$sc["gents_column_name"]}'>{$sc["gents_field_name"]}</label>";
                        $fields .= "<select name='{$sc["gents_column_name"]}' class='form-select' id='{$sc["gents_column_name"]}'>";
                        $select_options = $this->queries->select_where("*", "generic_selection_values", Array("FK_gensv_table_structure_id" => $sc["PK_table_structure_id"], "gensv_status_flag" => "A"));
                            foreach($select_options as $so){
                                if($get_records[0][$sc["gents_column_name"]] == $so["gensv_value"]){
                                    $fields .= "<option value='{$so["gensv_value"]}' selected=''>{$so["gensv_value"]}</option>";
                                }else{
                                    $fields .= "<option value='{$so["gensv_value"]}'>{$so["gensv_value"]}</option>";
                                }
                                
                            }
                        $fields .= "</select>";
                    $fields .= "</div>";
                }
                
            }
            
            $fields .= "<input type='hidden' name='record_id' value='".$this->input->post("PK_id")."' />";
            $fields .= "<input type='hidden' name='form_id' value='".$this->input->post("Form_id")."' />";
           
        }
        
        //echo json_encode(Array("page" => $this->load->view("record_detail", $data, true)));
        echo json_encode(Array("page" => $fields));
        
    }
    
    public function updateRecordsDetail(){
        
        $PK_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("form_id")));
        $primary_key = "PK_".strtolower($PK_name[0]["genfl_client_code"].$PK_name[0]["genfl_table_code"]."_".str_replace(" ", "_",$PK_name[0]["genfl_form_title"]))."_id";
        
        $select_columns = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("form_id")));
        $default_columns = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("form_id")));
        
        $updated_by = strtolower($default_columns[0]["genfl_client_code"].$default_columns[0]["genfl_table_code"])."_lastupdated_by_id";
        $date_updated = strtolower($default_columns[0]["genfl_client_code"].$default_columns[0]["genfl_table_code"])."_lastupdated_by_name";
        
        $data = Array();
        
        if(!empty($select_columns)){
            
            foreach($select_columns as $sc){
                
                $data = $data + Array($sc["gents_column_name"] => $this->input->post($sc["gents_column_name"]));
            }
            
            $data = $data + Array($updated_by => $this->session->userdata("user_id"), $date_updated => $this->session->userdata("user_name"));
        }
        
        $this->queries->update_where($data, $this->getTable($this->input->post("form_id")), Array($primary_key => $this->input->post("record_id")));
    
        $data["records"] = $this->queries->select_no_where("*", $this->getTable($this->input->post("form_id")));
        $data["columns"] = $this->queries->select_where("*", "generic_table_structure", Array("FK_gents_form_list_id" => $this->input->post("form_id")));
        
        $PK_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $this->input->post("form_id")));
        
        $data["primary_key"] = "PK_".strtolower($PK_name[0]["genfl_client_code"].$PK_name[0]["genfl_table_code"]."_".str_replace(" ", "_",$PK_name[0]["genfl_form_title"]))."_id";
        $data["form_id"] = $this->input->post("form_id");
        
        if(!empty($data["records"])){
            echo json_encode(Array("page" => $this->load->view("records.php", $data, true)));
        }else{
            echo "No Record available";
        }
    
    }
    
    public function deleteRecord(){
        
        $this->queries->delete($this->input->post("table_name"), [$this->input->post("PK_column") => $this->input->post("PK_id")]);
    }
    
    private function getTable($id){
        
        $table_name = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $id));
        
        return $table_name[0]["genfl_table_name"];
    }
    
    private function countTable($code){
        
        $query = $this->queries->select_where("*", "generic_forms_list", Array("genfl_client_code" => $code));
        
        if(empty($query)){
            return "t1";
        }else{
            return "t".count($query) + 1;
        }
        return $query;
    }
    
    private function getCode($id){
        
        $query = $this->queries->select_where("*", "generic_forms_list", Array("PK_form_list_id" => $id));
        
        return $query[0]["genfl_table_code"];
    }
}
