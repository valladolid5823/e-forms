<div id="container">
<div id="head">
        <h1>Glass Register | Record #: <?php echo str_pad(intVal($id),4,"0",STR_PAD_LEFT) ?></h1>
    </div>
    <div id="body">
		<div class="mb-3">
			<div>Risk Class</div>
			<div>1. Slight Risk – No Action required</div>
			<div>2. Medium Risk – Action when Opportunity Occur</div>
			<div>3. Urgent Action Removal of Object</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Department</th>
					<th>Area</th>
					<th>Item</th>
					<th>Material</th>
					<th>Attached Image</th>
					<th>Location</th>
					<th>Risk Class</th>
					<th>Action Required</th>
					<th>Action Completed</th>
					<th>Checked Initial</th>
				</tr>
			</thead>
			<tbody >
			<?php
			if (!empty($content)): foreach ($content as $cont): ?>
                    <tr>
                        <td><?php echo $cont['department']; ?></td>
                        <td><?php echo $cont['area']; ?></td>
						<td><?php echo $cont['item']; ?></td>
                        <td><?php echo $cont['material']; ?></td>
						<td><img width="150" src="<?= $cont['attached_image']; ?>" alt="Base64 Image" /> </td>
						<td><?php echo $cont['location']; ?></td>
						<td><?php echo $cont['risk_class']; ?></td>
						<td><?php echo $cont['action_required']; ?></td>
						<td><?php echo $cont['action_completed']; ?></td>
						<td><?php echo $cont['checked_initial']; ?></td>
                    </tr>
                <?php endforeach; endif; ?>
				<tr>
					<td colspan="10">
						<label for="comments" class="form-label">Comments/Corrective Actions Taken:</label>
						<div><?= $comments ?></div>
					</td>
				</tr>
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

