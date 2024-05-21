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
            <?php if (!empty($list)): foreach ($list as $l): ?>
            <div class="single-img">
                <div class="file-details">
                    <div class="file-upload-holder">
                        <img src="<?php echo config_item("base_url");?>assets/img/fileupload.png">
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#records_table" class="records_viewer" PK_id="<?php ?>" Form_name="<?php ?>">
                        <a href="<?php echo site_url("records/afia/{$l['afl_form_code']}")?>" target="_blank" style="color:gray; text-decoration: underline;"><span style="color:black;"></span> View Records </a>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#settings" class="form_settings" PK_id="<?php ?>" Form_name="<?php ?>" style="float: right; margin-right: 2px;"><i class="fa fa-cog"></i></a>
                </div>
                <div class="form-details">
                    <?php echo $l['afl_form_name']; ?>
                </div>
                <a href="<?php echo site_url("forms/afia/{$l['afl_form_code']}")?>" target="_blank" class="form_entry" style="text-decoration:none;" ><div class="add-entry">+</div></a>
            </div>
            <?php endforeach; endif; ?>
        </div>

        <div class="table_area">
            <table class="table">
                <thead>
                    <tr>
                        <th>Form Name</th>
                        <th>Add Record</th>
                        <th>View Record</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list)): foreach ($list as $l): ?>
                        <tr>
                            <td><?php echo $l['afl_form_name']; ?></td>
                            <td>
                                <a href="<?php echo site_url("forms/afia/{$l['afl_form_code']}")?>" target="_blank" class="form_entry" style="text-decoration:none;" ><div class="add-entry">+</div></a>
                            </td>
                            <td>
                                <a href="<?php echo site_url("records/afia/{$l['afl_form_code']}")?>" target="_blank" style="color:gray; text-decoration: underline;"><span style="color:black;"></span> View Records </a>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
     
</body>

<input type="hidden" id="base_url" value="<?php echo config_item("base_url");?>" />

</html>


