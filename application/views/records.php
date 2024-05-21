<table class="table table-striped" style="width: 100%;" id="myTable1">
    <thead>
        <tr>
            <th>No.</th>
            <?php foreach($columns as $c): ?>
                <th><?php echo $c["gents_field_name"]?></th>
            <?php endforeach; ?>
            <th>Controls</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach($records as $r): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <?php foreach($columns as $c): ?>
                    <td><?php echo $r[$c["gents_column_name"]]; ?></td>
                <?php endforeach; ?>
                <td>
                    
                    <a href="#" data-bs-toggle="modal" data-bs-target="#update_record" class="update_records_viewer" PK_id="<?php echo $r[$primary_key]; ?>" Form_id="<?php echo $form_id;?>"><i class="fa fa-edit"></i></a>
                    <?php if($this->session->userdata("user_code") == "internal"): ?>
                     | 
                        <a href="#" class="remove_record" table_name="<?php echo $table;?>" PK_id="<?php echo $r[$primary_key]; ?>" PK_column="<?php echo $primary_key; ?>" Form_id="<?php echo $form_id;?>"><i class="fa fa-trash" style="color: red;"></i></a>
                    <?php endif; ?>
                    <!--<a href="#" PK_id="<?php echo $r[$primary_key]; ?>" style="color: red;"><i class="fa fa-trash"></i></a> | 
                     <a href="#" PK_id="<?php echo $r[$primary_key]; ?>"><i class="fa fa-refresh"></i></a> !-->
                </td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
