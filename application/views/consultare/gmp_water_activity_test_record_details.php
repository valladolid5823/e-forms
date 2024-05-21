<div id="container">
<div id="head">
        <h1>Water Activity Tester Calibration Help | Record #: <?php echo str_pad(intVal($id),4,"0",STR_PAD_LEFT) ?></h1>
    </div>
    <div id="body">
		<div class="mt-5 mb-3 text-center">
			<b>Performance Check Form</b>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Substance</th>
					<th>Reading</th>
					<th>Pass/Fail</th>
					<th>Inspected By (Initials)</th>
					<th>Date/Time</th>
				</tr>
			</thead>
			<tbody >
			<?php
			if (!empty($performance_checks)): foreach ($performance_checks as $pc): ?>
                    <tr>
                        <td><?php echo $pc['substance']; ?></td>
                        <td><?php echo $pc['reading']; ?></td>
                        <td><?php echo $pc['pass_fail']; ?></td>
                        <td><?php echo $pc['inspected_by']; ?></td>
                        <td><?php echo $pc['date_time']; ?></td>
                       
                    </tr>
                <?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="mt-5 mb-3 text-center">
			<b>Pre-Operational Calibration Verification</b>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Equipment Tracking No.</th>
					<th>Equioment Description(s)</th>
					<th>Model #</th>
					<th>Serial #</th>
					<th>Calibration Certification Date</th>
					<th>Calibration Certification Due Date</th>
				</tr>
			</thead>
			<tbody >
			<?php
			if (!empty($operational_calibration_verifications)): foreach ($operational_calibration_verifications as $ocv): ?>
                    <tr>
                        <td><?php echo $ocv['equipment_tracking_no']; ?></td>
                        <td><?php echo $ocv['equipment_description']; ?></td>
                        <td><?php echo $ocv['model_no']; ?></td>
                        <td><?php echo $ocv['serial_no']; ?></td>
                        <td><?php echo $ocv['calibration_certification_date']; ?></td>
                        <td><?php echo $ocv['calibration_certification_due_date']; ?></td>
                       
                    </tr>
                <?php endforeach; endif; ?>
			</tbody>
		</table>
		
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
                            <img id="actual-image-res2" width="220" height="80" src="<?= !empty($records[0]['reviewer_draw_sign']) ? $records[0]['reviewer_draw_sign'] : $records[0]['reviewer_img_sign'] ?>"/><br>
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
                            <img id="actual-image-res2" width="220" height="80" src="<?= !empty($records[0]['approver_draw_sign']) ? $records[0]['approver_draw_sign'] : $records[0]['approver_img_sign'] ?>"/><br>
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
        <button style="font-size: 14px" type="submit" name="updateMcRecall" class="btn btn-secondary m-2 shadow-lg" onclick="window.print()">Print</button>
    </div>
</div>

<script></script>

