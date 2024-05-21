<div id="container">
<div id="head">
        <h1>GMP Checklist – Daily Self Inspection | Record #: <?php echo str_pad(intVal($id),4,"0",STR_PAD_LEFT) ?></h1>
    </div>
    <div id="body">
        <?php echo $content; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="custom-bg">
                <th class="text-center">Reviewer</th>
                <th class="text-center">Approver</th>
            </tr>
            <tr>
                <td class="text-center">
                    <div class="m-3 mb-5" style="display:flex; justify-content:center;">
                        <div>
                            <?php 
                                $reviewer_sign = '';
                                $reviewer_sign = (!empty($records[0]['reviewer_draw_sign'])) ? $records[0]['reviewer_draw_sign'] : base_url() . 'uploads/McRecall/images/' . $records[0]['reviewer_img_sign'];
                            ?>
                                <img id="actual-image-res2" width="220" height="80" src="<?=$reviewer_sign?>"/><br>
                            <hr>
                            <span class="fw-normal"><?=$records[0]['reviewer_name']?></span><br>
                            <span class="fw-normal"><?=$records[0]['reviewer_position']?></span><br>
                            <span class="fw-normal"><?=$records[0]['reviewed_date']?></span><br>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <div class="m-3 mb-5" style="display:flex; justify-content:center;">
                        <div>
                            <?php 
                                $approver_sign = '';
                                $approver_sign = (!empty($records[0]['approver_draw_sign'])) ? $records[0]['approver_draw_sign'] : base_url() . 'uploads/McRecall/images/' . $record[0]['approver_img_sign'];
                            ?>
                            <img id="actual-image-res2" width="220" height="80" src="<?=$approver_sign?>"/><br>
                            <hr>
                            <span class="fw-normal"><?=$records[0]['approver_name']?></span><br>
                            <span class="fw-normal"><?=$records[0]['approver_position']?></span><br>
                            <span class="fw-normal"><?=$records[0]['approved_date']?></span><br>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <button style="font-size: 14px" type="submit" name="updateMcRecall" class="btn btn-secondary m-2 shadow-lg">Print</button>
    </div>
</div>