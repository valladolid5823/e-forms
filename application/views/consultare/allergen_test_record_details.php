<div id="container">
<div id="head">
        <h1>Allergen Tests | Record #: <?php echo str_pad(intVal($id),4,"0",STR_PAD_LEFT) ?></h1>
		<div class="mb-3" ><button onclick="showSOPReference(0)" id="view-sop-reference0" value="<?= $help ?>" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">Help</button></div>
    </div>
    <div id="body">
		<div style="overflow-x: scroll">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Allergen Name</th>
						<th>SOP Reference</th>
						<th>Material Tested</th>
						<th>Test Kit Used</th>
						<th>Results</th>
						<th>Deficiency</th>
						<th>Performed By</th>
						<th>Date and Time</th>
						<th>Corrective Action</th>
						<th>Corrected By</th>
						<th>Date and Time</th>
						<th>Notes/Comments</th>
						<th>Status</th>
						<th>Reviewed By</th>
						<th>Date and Time</th>
					</tr>
				</thead>
				<tbody >
				<?php
				$row = 0;
				if (!empty($content)): foreach ($content as $cont): $row++; ?>
						<tr>
							<td><?php echo $cont['allergen_name']; ?></td>
							<td><button onclick="showSOPReference(<?= $row ?>)" id="view-sop-reference<?= $row ?>" value="<?= $cont['sop_reference'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td>
							<td><?php echo $cont['material_tested']; ?></td>
							<td><?php echo $cont['test_kit_used']; ?></td>
							<td><?php echo $cont['results']; ?></td>
							<td><?php echo $cont['deficiency']; ?></td>
							<td><?php echo $cont['performed_by']; ?></td>
							<td><?php echo $cont['performed_date_time']; ?></td>
							<td><?php echo $cont['corrective_action']; ?></td>
							<td><?php echo $cont['corrected_by']; ?></td>
							<td><?php echo $cont['corrected_date_time']; ?></td>
							<td><?php echo $cont['notes_comments']; ?></td>
							<td><?php echo $cont['status']; ?></td>
							<td><?php echo $cont['reviewed_by']; ?></td>
							<td><?php echo $cont['reviewed_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			
			<!-- Modal -->
			<div class="modal fade" id="full-screen-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="full-screen-modal-label" aria-hidden="true">
				<div class="modal-dialog modal-fullscreen">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="full-screen-modal-label">SOP Reference</h5>
						<button id="dialog-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
					<div class="modal-body" style="padding: 0" id="sop-reference">
						<!-- Dynamically insert a content here -->
					</div>
					</div>
				</div>
			</div>
		</div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>

	const showSOPReference = (row) => {
		// Get base64 value
		let sop_reference = document.getElementById(`view-sop-reference${row}`).value;
		// define empty variables
		let type, width, height;
		// Check if file type is pdf or image
		if (sop_reference.startsWith('data:application/pdf')) {
			type = 'application/pdf';
			width = '100%';
			height = '100%';
		} else if (sop_reference.startsWith('data:image/jpeg')) {
			type = 'image/jpeg';
			width = '600';
			height = '600';
		} else {
			return;
		}

		// Append appropriate embed file
		let embed = `<div id="embedded-file" class="d-flex align-items-center justify-content-center h-100"><embed src="${sop_reference}" width="${width}" height="${height}" type="${type}"></div>`;
		document.getElementById('sop-reference').insertAdjacentHTML('beforeend', embed);

		// Reset embed container
		document.getElementById('dialog-close').addEventListener('click', function () {
			let embeddedFile = document.getElementById('embedded-file');
			if (embeddedFile) {
				embeddedFile.remove();
			}
		});
	}

</script>
