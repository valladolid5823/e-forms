<style>
        body, html {
            margin: 0;
            padding: 0;
        }
        @media print {
            #container {
                margin: 0;
                padding: 0;
            }
            #pageprint {
                margin: 0;
                padding: 0;
            }
			.table {
                margin: 0;
                padding: 0;
            }
        }
    </style>
<div id="container">
	<div id="pageprint">
		<div id="head">
			<h1>Batch Manufacturing | Record #: <?php echo str_pad(intVal($id),4,"0",STR_PAD_LEFT) ?></h1>
			<div class="mb-3" ><button onclick="showFileUpload(0)" id="view-file-upload0" value="<?= $help ?>" type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">Help</button></div>
		</div>
		<div id="body">
			<hr>
			<div class="my-3 text-center"><h6><b>Product Details</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Batch Record No.</th>
						<th>Product Name</th>
						<th>Product Code</th>
						<th>Formula Code</th>
						<th>Product Label</th>
						<th>MFG Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (!empty($product_details)): foreach ($product_details as $prod): ?>
						<tr>
							<td><?php echo $prod['batch_number']; ?></td>
							<td><?php echo $prod['product_name']; ?></td>
							<td><?php echo $prod['product_code']; ?></td>
							<td><?php echo $prod['formula_code']; ?></td>
							<td><?php echo $prod['product_label']; ?></td>
							<td><?php echo $prod['mfg_date']; ?></td>
							
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Expiry Date</th>
						<th>Description</th>
						<th>Batch Quantity</th>
						<th>Packaging</th>
						<th>Storage Conditions</th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (!empty($product_details)): foreach ($product_details as $prod): ?>
						<tr>
							<td><?php echo $prod['expiry_date']; ?></td>
							<td><?php echo $prod['description']; ?></td>
							<td><?php echo $prod['batch_quantity']; ?></td>
							<td><?php echo $prod['packaging']; ?></td>
							<td><?php echo $prod['storage_condition']; ?></td>
							
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Prepared by</th>
						<th>Prepared Date and Time</th>
						<th>Approved by</th>
						<th>Approved Date and Time</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($product_details)): foreach ($product_details as $prod): ?>
						<tr>
							<td><?php echo $prod['prepared_by']; ?></td>
							<td><?php echo $prod['prepared_date_time']; ?></td>
							<td><?php echo $prod['approved_by']; ?></td>
							<td><?php echo $prod['approved_date_time']; ?></td>
							
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<hr>
			<div class="my-3 text-center"><h6><b>Product Record Issuance</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="2">Issued By – Issuer has reviewed the Batch Record to ensure that the copy is a complete, accurate copy 
						of the Master Batch Record.</th>
					</tr>
					<tr>
						<th>Issued by</th>
						<th>Date and Time</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($product_record_issuance)): foreach ($product_record_issuance as $pri): ?>
						<tr>
							<td><?php echo $pri['issued_by']; ?></td>
							<td><?php echo $pri['issued_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th colspan="2">Issued To – Production has reviewed the Batch Record to ensure that the copy is a complete and correct. Production is responsible for the Batch Record following issuance.</th>
					</tr>
					<tr>
						<th>Accepted by</th>
						<th>Date and Time</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($product_record_issuance)): foreach ($product_record_issuance as $pri): ?>
						<tr>
							<td><?php echo $pri['accepted_by']; ?></td>
							<td><?php echo $pri['accepted_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<hr>
			<div class="my-3 text-center"><h6><b>Reference Documents</b></h6></div>
			<div style="overflow-x: scroll">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>SOP Name</th>
							<th>SOP No.</th>
							<th>Description</th>
							<th>Document</th>
							<th>Verified By</th>
							<th>Verified Date and Time</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$row = 0;
					if (!empty($reference_documents)): foreach ($reference_documents as $rd): $row++; ?>
						<tr>
							<td><?php echo $rd['sop_name']; ?></td>
							<td><?php echo $rd['sop_number']; ?></td>
							<td><?php echo $rd['description']; ?></td>
							<td><a href="<?php $table="reference_documents"; echo site_url("Records/Consultare/gmp_bmr/download?record_id=".$id."&row_id=".$rd['PK_id']."&table=".$table."") ?>" target="_blank">document</a></td>
							<!-- <td><button onclick="showFileUpload(<?= $row ?>)" id="view-file-upload<?= $row ?>" value="<?= $rd['document'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td> -->
							<td><?php echo $rd['verified_by']; ?></td>
							<td><?php echo $rd['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="my-3 text-center"><h6><b>Raw Materials</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Raw Materials Name</th>
						<th>Description</th>
						<th>Lot No.</th>
						<th>Supplier Name</th>
						<th>Supplier Code</th>
						<th>Expiration Date</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($raw_materials)): foreach ($raw_materials as $rm): ?>
						<tr>
							<td><?php echo $rm['raw_materials_name']; ?></td>
							<td><?php echo $rm['description']; ?></td>
							<td><?php echo $rm['lot_number']; ?></td>
							<td><?php echo $rm['supplier_name']; ?></td>
							<td><?php echo $rm['supplier_code']; ?></td>
							<td><?php echo $rm['expiration_date']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Retest Date</th>
						<th>Quantity Stage</th>
						<th>Peformed By</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($raw_materials_retest)): foreach ($raw_materials_retest as $rmr): ?>
						<tr>
							<td><?php echo $rmr['retest_date']; ?></td>
							<td><?php echo $rmr['quantity_staged']; ?></td>
							<td><?php echo $rmr['performed_by']; ?></td>
							<td><?php echo $rmr['performed_date_time']; ?></td>
							<td><?php echo $rmr['verified_by']; ?></td>
							<td><?php echo $rmr['verified_date_time']; ?></td>
							
						</tr>
						<tr>
							<td colspan="5"></td>
							<td><div class="mb-2"><b>Total: Quantity Staged</b></div><div><?php echo $rmr['total_quantity_staged']; ?></div></td>
						</tr>
					<?php  endforeach; endif; ?>
					
				</tbody>
			</table>
			<hr>
			<div class="my-3 text-center"><h6><b>Packaging Materials</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Packaging Materials Name</th>
						<th>Description</th>
						<th>Lot No.</th>
						<th>Supplier Name</th>
						<th colspan="2">Supplier Code</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($packaging_materials)): foreach ($packaging_materials as $pm): ?>
						<tr>
							<td><?php echo $pm['packaging_material_name']; ?></td>
							<td><?php echo $pm['description']; ?></td>
							<td><?php echo $pm['lot_number']; ?></td>
							<td><?php echo $pm['supplier_name']; ?></td>
							<td><?php echo $pm['supplier_code']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Quantity Stage</th>
						<th>Peformed By</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($packaging_materials_verification)): foreach ($packaging_materials_verification as $pmv): ?>
						<tr>
							<td><?php echo $pmv['quantity_staged']; ?></td>
							<td><?php echo $pmv['performed_by']; ?></td>
							<td><?php echo $pmv['performed_date_time']; ?></td>
							<td><?php echo $pmv['verified_by']; ?></td>
							<td><?php echo $pmv['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>

			<hr>
			<div class="my-3 text-center"><h6><b>Labels</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Labels Name</th>
						<th>Description</th>
						<th>Lot Number</th>
						<th>Supplier Name</th>
						<th>Supplier Code</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($labels)): foreach ($labels as $label): ?>
						<tr>
							<td><?php echo $label['label_name']; ?></td>
							<td><?php echo $label['description']; ?></td>
							<td><?php echo $label['lot_number']; ?></td>
							<td><?php echo $label['supplier_name']; ?></td>
							<td><?php echo $label['supplier_code']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Quantity Staged</th>
						<th>Performed_by</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($labels)): foreach ($labels as $label): ?>
						<tr>
							<td><?php echo $label['quantity_staged']; ?></td>
							<td><?php echo $label['performed_by']; ?></td>
							<td><?php echo $label['performed_date_time']; ?></td>
							<td><?php echo $label['verified_by']; ?></td>
							<td><?php echo $label['verified_date_time']; ?></td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td>
								<div class="mb-2"><b>Total: Quantity Staged</b></div>
								<div><?php echo $label['total_quantity_staged']; ?></div>
							</td>
						</tr>
					<?php  endforeach; endif; ?>
					
				</tbody>
			</table>
			<div class="my-3 text-center"><h6><b>Processing Equipment</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Equipment Name</th>
						<th>Description</th>
						<th>Equipment ID No.</th>
						<th>Calibration Date</th>
						<th>Calibration Required</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($processing_equipment)): foreach ($processing_equipment as $pe): ?>
						<tr>
							<td><?php echo $pe['equipment_name']; ?></td>
							<td><?php echo $pe['description']; ?></td>
							<td><?php echo $pe['equipment_id_number']; ?></td>
							<td><?php echo $pe['calibration_date']; ?></td>
							<td><?php echo $pe['calibration_required']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Performed By</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($processing_equipment)): foreach ($processing_equipment as $pe): ?>
						<tr>
							<td><?php echo $pe['performed_by']; ?></td>
							<td><?php echo $pe['performed_date_time']; ?></td>
							<td><?php echo $pe['verified_by']; ?></td>
							<td><?php echo $pe['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<div class="my-3 text-center"><h6><b>Pre-Operations Verifications</b></h6></div>
			<div style="overflow-x: scroll">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Pre-Operations Verifications</th>
							<th>Compliant/Non Compliant</th>
							<th>SOP Reference</th>
							<th>Performed By</th>
							<th>Performed Date and Time</th>
							<th>Verified By</th>
							<th colspan="6">Verified Date and Time</th>
						</tr>
					</thead>
					<tbody >
					<?php
					if (!empty($preoperation_verifications)): foreach ($preoperation_verifications as $pv): $row++; ?>
						<tr>
							<td><?php echo $pv['pre_operation_verification']; ?></td>
							<td><?php echo $pv['status']; ?></td>
							<td><button onclick="showFileUpload(<?= $row ?>)" id="view-file-upload<?= $row ?>" value="<?= $pv['sop_reference'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td>
							<td><?php echo $pv['performed_by']; ?></td>
							<td><?php echo $pv['performed_date_time']; ?></td>
							<td><?php echo $pv['verified_by']; ?></td>
							<td><?php echo $pv['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="my-3 text-center"><h6><b>Production Procedures</b></h6></div>
			<div style="overflow-x: scroll">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Processing Step</th>
							<th>Procedure Description</th>
							<th>SOP Reference</th>
							<th>Performed By</th>
							<th>Performed Date and Time</th>
							<th>Verified By</th>
							<th colspan="6">Verified Date and Time</th>
						</tr>
					</thead>
					<tbody >
					<?php
					if (!empty($production_procedures)): foreach ($production_procedures as $pp): $row++; ?>
						<tr>
							<td><?php echo $pp['processing_step']; ?></td>
							<td><?php echo $pp['procedure_description']; ?></td>
							<td><button onclick="showFileUpload(<?= $row ?>)" id="view-file-upload<?= $row ?>" value="<?= $pp['sop_reference'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td>
							<td><?php echo $pp['performed_by']; ?></td>
							<td><?php echo $pp['performed_date_time']; ?></td>
							<td><?php echo $pp['verified_by']; ?></td>
							<td><?php echo $pp['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="my-3 text-center"><h6><b>Deviation Record</b></h6></div>
			<div style="overflow-x: scroll">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Deviation Classification</th>
						<th>Description</th>
						<th>SOP Reference</th>
						<th>Requested By</th>
						<th>Requested Date and Time</th>
						<th>Notes/Comments</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($product_deviation)): foreach ($product_deviation as $pd): $row++; ?>
						<tr>
							<td><?php echo $pd['deviation_classification']; ?></td>
							<td><?php echo $pd['description']; ?></td>
							<td><button onclick="showFileUpload(<?= $row ?>)" id="view-file-upload<?= $row ?>" value="<?= $pd['sop_reference'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td>
							<td><?php echo $pd['requested_by']; ?></td>
							<td><?php echo $pd['requested_date_time']; ?></td>
							<td><?php echo $pd['notes']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			</div>
			<table class="table table-bordered mt-3">
				<thead>
					<tr>
						<th>Performed By</th>
						<th>Performed Date and Time</th>
						<th>Approved By</th>
						<th>Approved Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($product_deviation)): foreach ($product_deviation as $pd): ?>
						<tr>
							<td><?php echo $pd['performed_by']; ?></td>
							<td><?php echo $pd['performed_date_time']; ?></td>
							<td><?php echo $pd['approved_by']; ?></td>
							<td><?php echo $pd['approved_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<hr>
			<div class="my-3 text-center"><h6><b>Yield Calculation</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Starting Weight of Raw Materials</th>
						<th>Usable Weight of Products</th>
						<th>Process Loss</th>
						<th>Yield Percentage</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($yield_caculation)): foreach ($yield_caculation as $yc): ?>
						<tr>
							<td><?php echo $yc['starting_weight_of_raw_materials']; ?></td>
							<td><?php echo $yc['usable_weight_of_products']; ?></td>
							<td><?php echo $yc['process_loss']; ?></td>
							<td><?php echo $yc['yield_percentage']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Performed By</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody >
				<?php
					if (!empty($yield_caculation_verification)): foreach ($yield_caculation_verification as $ycv): ?>
						<tr>
							<td><?php echo $ycv['performed_by']; ?></td>
							<td><?php echo $ycv['performed_date_time']; ?></td>
							<td><?php echo $ycv['verified_by']; ?></td>
							<td><?php echo $ycv['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<h6><b><i>Usable weight of products DEVIDED BY Raw Materials / Total QTY Staged MULTIPLIED BY 100 = Total Yield</i></b></h6>

			<hr>
			<div class="my-3 text-center"><h6><b>Rework / Reprocess Documentation</b></h6></div>
			<h6 class="mt-3"><b><i>
			This section is for processed finish product material only that is not packaged and earmarked for reprocessing or rework procedures</i></b></h6>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Material Qty for Reprocessing</th>
						<th>Material Qty for Rework</th>
						<th>Performed By</th>
						<th>Performed Date and Time</th>
						<th>Verified By</th>
						<th colspan="2">Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($product_rework)): foreach ($product_rework as $pr): ?>
						<tr>
							<td><?php echo $pr['material_quantity_for_reprocessing']; ?></td>
							<td><?php echo $pr['material_quantity_for_rework']; ?></td>
							<td><?php echo $pr['performed_by']; ?></td>
							<td><?php echo $pr['performed_date_time']; ?></td>
							<td><?php echo $pr['verified_by']; ?></td>
							<td><?php echo $pr['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
			</table>
			<hr>
			<div class="my-3 text-center"><h6><b>Packaging Material Trace</b></h6></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Packaging Material Name</th>
						<th>Total: Qty Staged</th>
						<th>Total Used</th>
						<th>Disposed</th>
						<th>Total Remains</th>
						<th>Verified By</th>
						<th>Verified Date and Time</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (!empty($packaging_material_trace)): foreach ($packaging_material_trace as $pmt): ?>
						<tr>
							<td><?php echo $pmt['packaging_material_name']; ?></td>
							<td><?php echo $pmt['total_quantity_staged']; ?></td>
							<td><?php echo $pmt['total_used']; ?></td>
							<td><?php echo $pmt['disposed']; ?></td>
							<td><?php echo $pmt['total_remains']; ?></td>
							<td><?php echo $pmt['verified_by']; ?></td>
							<td><?php echo $pmt['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
				</tbody>
				</table>
				<hr>
				<div class="my-3 text-center"><h6><b>Label Trace</b></h6></div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Label Name</th>
							<th>Total: Qty Staged</th>
							<th>Total Used</th>
							<th>Disposed</th>
							<th>Total Remains</th>
							<th>Verified By</th>
							<th>Verified Date and Time</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if (!empty($label_trace)): foreach ($label_trace as $lt): ?>
						<tr>
							<td><?php echo $lt['label_name']; ?></td>
							<td><?php echo $lt['total_quantity_staged']; ?></td>
							<td><?php echo $lt['total_used']; ?></td>
							<td><?php echo $lt['disposed']; ?></td>
							<td><?php echo $lt['total_remains']; ?></td>
							<td><?php echo $lt['verified_by']; ?></td>
							<td><?php echo $lt['verified_date_time']; ?></td>
						</tr>
					<?php  endforeach; endif; ?>
					</tbody>
				</table>
				<hr>
				<div class="my-3 text-center"><h6><b>Post Production Verification</b></h6></div>
				<div style="overflow-x: scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Post Production Verification</th>
								<th>SOP Reference</th>
								<th>Performed By</th>
								<th>Performed Date and Time</th>
								<th>Verified By</th>
								<th>Verified Date and Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($post_production_verification)): foreach ($post_production_verification as $ppv): $row++; ?>
								<tr>
									<td><?php echo $ppv['post_production_verification']; ?></td>
									<td><button onclick="showFileUpload(<?= $row ?>)" id="view-file-upload<?= $row ?>" value="<?= $ppv['sop_reference'] ?>" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#full-screen-modal">view</button></td>
									<td><?php echo $ppv['performed_by']; ?></td>
									<td><?php echo $ppv['performed_date_time']; ?></td>
									<td><?php echo $ppv['verified_by']; ?></td>
									<td><?php echo $ppv['verified_date_time']; ?></td>
								</tr>
							<?php  endforeach; endif; ?>
						</tbody>
					</table>
				</div>
				<hr>
				<div class="my-3 text-center"><h6><b>Production Team Members</b></h6></div>
				<div style="overflow-x: scroll">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Team Member Name</th>
								<th>Position</th>
								<th>Qualified?</th>
								<th>Notes/Comments</th>
								<th>Training Record Reference</th>
								<th>Verified By</th>
								<th>Verified Date and Time</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($team_members)): foreach ($team_members as $tm): ?>
								<tr>
									<td><?php echo $tm['member_name']; ?></td>
									<td><?php echo $tm['position']; ?></td>
									<td><?php echo $tm['qualified']; ?></td>
									<td><?php echo $tm['notes']; ?></td>
									<td><?php echo $tm['training_record_reference']; ?></td>
									<td><?php echo $tm['verified_by']; ?></td>
									<td><?php echo $tm['verified_date_time']; ?></td>
									
								</tr>
							<?php  endforeach; endif; ?>
						</tbody>
					</table>
				</div>
				<hr>
				<div class="my-3 text-center"><h6><b>Post Production Review</b></h6></div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Post Production Review</th>
							<th>Production Reviewed By</th>
							<th>Reviewed Date and Time</th>
							<th>QA/QC Reviewed By</th>
							<th>Reviewed Date and Time</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if (!empty($product_review)): foreach ($product_review as $pr): ?>
								<tr>
									<td><?php echo $pr['post_production_review']; ?></td>
									<td><?php echo $pr['production_reviewed_by']; ?></td>
									<td><?php echo $pr['production_reviewed_date_time']; ?></td>
									<td><?php echo $pr['qa_reviewed_by']; ?></td>
									<td><?php echo $pr['qa_reviewed_date_time']; ?></td>
									
								</tr>
							<?php  endforeach; endif; ?>
					</tbody>
				</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="full-screen-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="full-screen-modal-label" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="full-screen-modal-label">Attachment</h5>
				<button id="dialog-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
			<div class="modal-body" style="padding: 0" id="file-upload">
				<!-- Dynamically insert a content here -->
			</div>
			</div>
		</div>
	</div>
	<div class="d-flex justify-content-center">
		<button style="font-size: 14px"  class="btn btn-secondary m-2 shadow-lg" onclick="downloadCode()" id="print-doc">Print</button>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

	const showFileUpload = (row) => {
		// Get base64 value
		let file_upload = document.getElementById(`view-file-upload${row}`).value;
		// define empty variables
		let type, width, height;
		// Check if file type is pdf or image
		if (file_upload.startsWith('data:application/pdf')) {
			type = 'application/pdf';
			width = '100%';
			height = '100%';
		} else if (file_upload.startsWith('data:image/jpeg')) {
			type = 'image/jpeg';
			width = '600';
			height = '600';
		} else {
			return;
		}

		// Append appropriate embed file
		let embed = `<div id="embedded-file" class="d-flex align-items-center justify-content-center h-100"><embed src="${file_upload}" width="${width}" height="${height}" type="${type}"></div>`;
		document.getElementById('file-upload').insertAdjacentHTML('beforeend', embed);

		// Reset embed container
		document.getElementById('dialog-close').addEventListener('click', function () {
			let embeddedFile = document.getElementById('embedded-file');
			if (embeddedFile) {
				embeddedFile.remove();
			}
		});
	}

	// Display buttons if print is not active
	window.addEventListener('afterprint', function() {
		$('#view-file-upload0').show();
		$('#print-doc').show();
	});

	// Hide buttons if print is active
	// function printDoc() {
	// 	$('#view-file-upload0').hide();
	// 	$('#print-doc').hide();
	// 	window.print();
	// }

	// function generatePDF() {
    //     $('#view-file-upload0').hide();
    //     $('#print-doc').hide();

    //     const element = document.getElementById("pageprint");
    //     html2pdf().set({
    //         margin: [0, 0, 0, 0],
    //         filename: 'download.pdf',
    //         html2canvas: { scale: 2, scrollY: 0 },
    //         jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    //     }).from(element).save().then(() => {
    //         $('#view-file-upload0').show();
    //         $('#print-doc').show();
    //     });
    // }

	function generatePDF() {
        $('#view-file-upload0').hide();
        $('#print-doc').hide();

        const element = document.getElementById("pageprint");
        html2pdf().set({
            margin: [0, 0, 0, 0],
            filename: 'download.pdf',
            html2canvas: { scale: 2, scrollY: 0 },
            jsPDF: { unit: 'pt', format: 'letter', orientation: 'portrait' }
        }).from(element).toPdf().get('pdf').then(function (pdf) {
            var totalPages = pdf.internal.getNumberOfPages();

			for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);
                pdf.text(" ", 20, 20); // Padding Top
                pdf.text(" ", 20, pdf.internal.pageSize.getHeight() - 20); // Padding Bottom
            }
        }).save().then(() => {
            $('#view-file-upload0').show();
            $('#print-doc').show();
        });
    }

    function downloadCode(){
        generatePDF();
        setTimeout(function() { window.location = window.location; }, 3000);
    }
    
 </script>

</script>
