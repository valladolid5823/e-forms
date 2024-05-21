<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Forms</title>
    <link rel="stylesheet" href="<?php echo config_item("base_url");?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    
    <link rel="stylesheet" href="<?php echo config_item("base_url");?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo config_item("base_url");?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo config_item("base_url");?>assets/js/myscript.js"></script>
</head>
<body>
    <div class="wraper">
         <div class="page-title"> <?php echo $this->session->userdata("client_code"); ?> | QC FORM DASHBOARD</div>
                 <div class="search-file-holder">
                        
                        <div class="topnav">
                            <div class="search-container">
                                
                                <form action="#">
                                  <input type="text" placeholder="Search.." name="search">
                                  <button type="submit"><i class="fa fa-search"></i></button>
                                  
                                </form>
                                
                            </div>
                            <?php echo " Logged In as:  ".$this->session->userdata("user_name"); ?>
                       </div>
                 </div>

        
        <div class="img-area" >
            <?php $i = 0; ?>
            <?php if(!empty($forms)): foreach($forms as $f): ?>
            <div class="single-img">
                <div class="file-details">
                    <div class="file-upload-holder">
                        <img src="<?php echo config_item("base_url");?>assets/img/fileupload.png">
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#records_table" class="records_viewer" PK_id="<?php echo $f["PK_form_list_id"];?>" Form_name="<?php echo $f["genfl_form_title"];?>">
                        <label style="color:gray;"><span style="color:black;"></span> <?php echo $count[$i];?> Records </label>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#settings" class="form_settings" PK_id="<?php echo $f["PK_form_list_id"];?>" Form_name="<?php echo $f["genfl_form_title"];?>" style="float: right; margin-right: 2px;"><i class="fa fa-cog"></i></a>
                </div>
                <div class="form-details">
                    <?php echo $f["genfl_form_title"]; ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#update_form" class="form_update" PK_id="<?php echo $f["PK_form_list_id"];?>" Form_name="<?php echo $f["genfl_form_title"];?>" Form_department="<?php echo $f["genfl_form_department"];?>" Form_description="<?php echo $f["genfl_form_description"];?>"><i class="fa fa-edit"></i></a> | 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete_form" class="form_delete" PK_id="<?php echo $f["PK_form_list_id"];?>" Form_name="<?php echo $f["genfl_form_title"];?>" Option="table" style="color: red;" ><i style="display:none;" class="fa fa-trash"></i></a>
                </div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#entry" class="form_entry" PK_id="<?php echo $f["PK_form_list_id"];?>" style="text-decoration:none;" ><div class="add-entry">+</div></a>
            </div>
            <?php $i++; ?>
            <?php endforeach; ?> 
            <?php else: ?>
                <span>No Form to Show</span>
            <?php endif; ?>
        </div>
    </div>

    
    <a data-bs-toggle="modal" data-bs-target="#new_log"><div class="add-new-form">+</div></a>

    <!-- Add New Form -->
    <div class="modal fade" id="new_log" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD NEW FORM</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="createNewForm">
            <div class="modal-body ">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="form_title">Form Title</label>
                    <input type="text" name="form_title" class="form-control" id="form_title" required="" />
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="department">Department</label>
                    <input type="text" name="form_department" class="form-control" id="department" required="" />
                </div>
                <div class="input-group">
                  <label class="input-group-text" for="form_description">Description</label>
                  <textarea class="form-control" name="form_description" id="form_description" required="" ></textarea>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Form</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Add New Form -->
    
    <!-- Settings -->
    <div class="modal fade" id="settings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Settings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="createSetting">
            <div class="modal-body" style="max-height: 400px;overflow: auto;">
                
                <div class="input-group mb-3">
                    <label class="input-group-text" for="field_name">Field Name</label>
                    <input type="text" name="field_name" class="form-control" id="field_name" required="" />
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="value_type">Value Type</label>
                  <select name="value_type" class="form-select" id="value_type">
                    <option value="TEXT">TEXT</option>
                    <option value="TIME">TIME</option>
                    <option value="DATE">DATE</option>
                    <option value="INT">INTEGER</option>
                    <option value="FLOAT">DECIMAL</option>
                    <option value="VARCHAR">LIMITED CHARACTERS</option>
                  </select>
                </div>
                <div class="input-group mb-3 max_size_viewer" style="display: none;">
                    <label class="input-group-text" for="max_size">Max Size</label>
                    <input type="number" name="max_size" class="form-control" id="max_size"  />
                </div>
                <div class="input-group mb-3">
                  <label class="input-group-text" for="value_option">Value Option</label>
                  <select name="value_option" class="form-select" id="value_option">
                    <option value="M">MANUAL INPUT</option>
                    <option value="S">CHOOSE FROM OPTIONS</option>
                  </select>
                </div>
                <div class="selection_viewer" style="display: none;">                                
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>Enter Options</th>
                            </tr>
                        </thead>
                        <tbody class="add_rows">
                            <tr>
                                <td><input type="text" class="form-control selection_value" value="" name="selection_value[]" disabled="" required="" id="sv0" /></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <span style="color: green; cursor: pointer;" class="add_line"><i class="fa fa-plus"></i></span> &nbsp;
                                    <span style="color: red; cursor: pointer;" class="remove_line"><i class="fa fa-minus"></i></span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <section class="column_list"></section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn_settings">Save Setting</button>
            </div>
            <input type="hidden" id="primary_key" name="primary_key" />
            <input type="hidden" id="pk_structure_id" name="pk_structure_id" />
          </form>
        </div>
      </div>
    </div>
    <!-- END Settings -->
    
   <!-- Add Entry -->
    <div class="modal fade" id="entry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="saveRecord">
            <div class="modal-body form_entry_container" style="max-height: 400px;overflow: auto;">
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Record</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Add Entry -->
    
    <!-- Add Entry -->
    <div class="modal fade" id="records_table" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="saveRecord">
            <div class="modal-body table_container table-container">
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END Records Table -->
    
    <!-- Update Form -->
    <div class="modal fade" id="update_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADD NEW FORM</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="updateForm">
            <div class="modal-body ">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="form_title">Form Title</label>
                    <input type="text" name="form_title" class="form-control" id="update_form_title" required="" />
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="department">Department</label>
                    <input type="text" name="form_department" class="form-control" id="update_department" required="" />
                </div>
                <div class="input-group">
                  <label class="input-group-text" for="form_description">Description</label>
                  <textarea class="form-control" name="form_description" id="update_form_description" required="" ></textarea>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Form</button>
            </div>
            <input type="hidden" id="update_primary_key" name="primary_key" />
          </form>
        </div>
      </div>
    </div>
    <!-- END Update Form --> 
    
    <!-- Delete Table / Column Form -->
    <div class="modal fade" id="delete_form" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModal"></h5>
            <button type="button" class="btn-close" id="deleteCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="deleteForm">
            <div class="modal-body">
                <h5 style="color: red;">Remember: </h5> <h6 class="delete_notes"></h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Confirm</button>
            </div>
            <input type="hidden" id="delete_primary_key" name="primary_key" />
            <input type="hidden" id="delete_option" name="option" />
            
          </form>
        </div>
      </div>
    </div>
    <!-- END Delete Table / Column Form --> 
    
    <!-- Update Record Form -->
    <div class="modal fade" id="update_record" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="updateRecordModal"></h5>
            <button type="button" class="btn-close" id="updateRecordCloseBtn" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="updateRecordForm">
            <div class="modal-body" id="updateRecordBody">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
           
          </form>
        </div>
      </div>
    </div>
    <!-- Update Record Form --> 
     
</body>

<input type="hidden" id="base_url" value="<?php echo config_item("base_url");?>" />

</html>