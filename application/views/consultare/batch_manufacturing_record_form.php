
<style>
    .signature-pad {
        border-radius: 2px;
        border: 1px dashed #ccc;
        cursor: crosshair;
        width:300px;
        height: auto;
    }
	table thead tr th {
		min-width: 150px
	}
	textarea {
        min-width: 300px
    }
</style>
<div id="container">
	<form autocomplete="off" method="POST" action="?" id="batchManufaturingForm">
		<div id="head">
			<h1>Batch Manufacturing Record Form</h1>
			<div class="d-flex justify-content-center mb-2">
				<div class="ml-5">
					Help: 
					<input type="file" class="form-control-file" accept=".png, .jpg, .jpeg, .pdf" name="help" required>
				</div>
			</div>
            <hr>
            <div class="my-3"><h6><b>Product Details</b></h6></div>
		</div>
		<div id="body">
		
			<div>
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
                        <tr>
                            <td><input type="number" class="form-control" name="batch_number" required></td>
                            <td><input type="text" class="form-control" name="product_name" required></td>
                            <td><input type="text" class="form-control" name="product_code" required></td>
                            <td><input type="text" class="form-control" name="formula_code" required></td>
                            <td><input type="text" class="form-control" name="product_label" required></td>
                            <td><input type="date" class="form-control" name="mfg_date" required></td>
                        </tr>
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
                        <tr>
                            <td><input type="date" class="form-control" name="product_expiry_date" required></td>
                            <td><input type="text" class="form-control" name="product_condition_description" required></td>
                            <td><input type="number" class="form-control" name="product_batch_quantity" required></td>
                            <td><input type="text" class="form-control" name="product_packaging" required></td>
                            <td>
                                <select class="form-control" name="product_storage_condition" required>
                                    <option value=""></option>
                                    <option value="Ambient">Ambient</option>
                                    <option value="Archive/Retention">Archive/Retention</option>
                                    <option value="Cold">Cold</option>
                                    <option value="Controlled">Controlled</option>
                                    <option value="Dry">Dry</option>
                                    <option value="Frozen">Frozen</option>
                                    <option value="Humidity Controlled">Humidity Controlled</option>
                                    <option value="IQF">IQF</option>
                                    <option value="Refrigerated">Refrigerated</option>
                                    <option value="Room Temperature">Room Temperature</option>
                                </select>
                            </td>
                        </tr>
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
                        <tr>
                            <td><input type="text" class="form-control" name="product_verification_prepared_by" required></td>
                            <td><input type="datetime-local" class="form-control" name="product_verification_prepared_date_time" required></td>
                            <td><input type="text" class="form-control" name="product_verification_approved_by" required></td>
                            <td><input type="datetime-local" class="form-control" name="product_verification_approved_date_time" required></td>
                        </tr>
					</tbody>
				</table>
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
                        <tr>
                            <td><input type="text" class="form-control" name="product_issuance_issued_by" required></td>
                            <td><input type="datetime-local" class="form-control" name="product_issuance_issued_date_time" required></td>
                        </tr>
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
                        <tr>
                            <td><input type="text" class="form-control" name="product_issuance_accepted_by" required></td>
                            <td><input type="datetime-local" class="form-control" name="product_issuance_accepted_date_time" required></td>
                        </tr>
					</tbody>
				</table>
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
								<th colspan="2">Verified Date and Time</th>
							</tr>
						</thead>
						<tbody id="referenceDocumentsData">
							<!-- Data will be dynamically inserted here -->
						</tbody>
					</table>
				</div>
                <button id="addReferenceDocumentRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
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
							<th colspan="2">Expiration Date</th>
						</tr>
					</thead>
					<tbody id="rawMaterialsData">
						<!-- Data will be dynamically inserted here -->
					</tbody>
				</table>
                <button id="addRawMaterialsRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
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
						<tr>
                            <td><input type="date"  class="form-control" name="product_retest_date"></td>
                            <td><input type="number"  class="form-control" name="product_retest_quantity_staged"></td>
                            <td><input type="text"  class="form-control" name="product_retest_performed_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="product_retest_performed_date_time"></td>
                            <td><input type="text"  class="form-control" name="product_retest_verified_by" ></td>
                            <td><input type="datetime-local"  class="form-control" name="product_retest_verified_date_time"></td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                            <td><b class="mb-2">Total: Quantity Staged</b><input type="number"  class="form-control" name="product_retest_total_quantity_staged" required></td>
                        </tr>
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
					<tbody id="packagingMaterialsData">
						<!-- Data will be dynamically inserted here -->
					</tbody>
				</table>
                <button id="addPackagingMaterialsRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
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
						<tr>
                            <td><input type="number"  class="form-control" name="packaging_material_quantity_staged"></td>
                            <td><input type="text"  class="form-control" name="packaging_material_performed_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="packaging_material_performed_date_time"></td>
                            <td><input type="text"  class="form-control" name="packaging_material_verified_by" ></td>
                            <td><input type="datetime-local"  class="form-control" name="packaging_material_verified_date_time"></td>
                        </tr>
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
						<tr>
                            <td><input type="text"  class="form-control" name="label_name"></td>
                            <td><textarea class="form-control" name="label_description"></textarea></td>
                            <td><input type="number"  class="form-control" name="label_lot_number" ></td>
                            <td><input type="text"  class="form-control" name="label_supplier_name" ></td>
                            <td><input type="text"  class="form-control" name="label_supplier_code" ></td>
                        </tr>
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
						<tr>
                            <td><input type="number"  class="form-control" name="label_quantity_staged" ></td>
                            <td><input type="text"  class="form-control" name="label_performed_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="label_performed_date_time" ></td>
                            <td><input type="text"  class="form-control" name="label_verified_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="label_verified_date_time" ></td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td><b class="mb-2">Total: Quantity Staged</b><input type="number"  class="form-control" name="label_total_quantity_staged" required></td>
                        </tr>
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
						<tr>
                            <td><input type="text"  class="form-control" name="processing_equipment_name"></td>
                            <td><textarea class="form-control" name="processing_equipment_description"></textarea></td>
                            <td><input type="number"  class="form-control" name="processing_equipment_id_number" ></td>
                            <td><input type="date"  class="form-control" name="processing_equipment_calibration_date" ></td>
                            <td><input type="text"  class="form-control" name="processing_equipment_calibration_required" ></td>
                        </tr>
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
						<tr>
                            <td><input type="text"  class="form-control" name="processing_equipment_performed_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="processing_equipment_performed_date_time" ></td>
                            <td><input type="text"  class="form-control" name="processing_equipment_verified_by"></td>
                            <td><input type="datetime-local"  class="form-control" name="processing_equipment_verified_date_time" ></td>
                        </tr>
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
                        <tbody id="preoperationsVerificationData">
                            <!-- Data will dynamically insert here -->
                        </tbody>
                    </table>
                </div>
                <button id="addPreOperationVerificationRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
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
                        <tbody id="productionProcedureData">
                            <!-- Data will dynamically insert here -->
                        </tbody>
                    </table>
                </div>
                <button id="addProductionProcedureRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
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
                        <tr>
                            <td><input type="text" class="form-control" name="deviation_classification" required></td>
                            <td><textarea class="form-control preoperation-text-area" name="deviation_description" required></textarea></td>
                            <td><input type="file" class="form-control-file" accept=".pdf" name="deviation_sop_reference" required></td>
                            <td><input type="text"  class="form-control" name="deviation_requested_by" ></td>
                            <td><input type="datetime-local"  class="form-control" name="deviation_requested_date_time" required></td>
                            <td><textarea class="form-control preoperation-text-area" name="deviation_notes" required></textarea></td>
                        </tr>
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
                        <tr>
                            <td><input type="text" class="form-control" name="deviation_performed_by" required></td>
                            <td><input type="datetime-local"  class="form-control" name="deviation_performed_date_time" required></td>
                            <td><input type="text" class="form-control" name="deviation_approved_by" required></td>
                            <td><input type="datetime-local"  class="form-control" name="deviation_approved_date_time" required></td>
                        </tr>
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
                            <th colspan="2">Yield Percentage</th>
                        </tr>
                    </thead>
                    <tbody id="yieldCalculationData">
                        <!-- Data will dynamically insert here -->
                    </tbody>
                </table>
          
                <button id="addYieldCalculationRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
                
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
                       <tr>
                            <td><input type="text" class="form-control" name="yield_calculation_performed_by" required></td>
                            <td><input type="datetime-local"  class="form-control" name="yield_calculation_performed_date_time" required></td>
                            <td><input type="text" class="form-control" name="yield_calculation_verified_by" required></td>
                            <td><input type="datetime-local"  class="form-control" name="yield_calculation_verified_date_time" required></td>   
                       </tr>
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
                    <tbody id="reworkData">
                        <!-- Data will dynamically insert here -->
                    </tbody>
                </table>
                <button id="addReworkRow" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
                
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
                            <th colspan="2">Verified Date and Time</th>
                        </tr>
                    </thead>
                    <tbody id="materialTraceData">
                        <!-- Data will dynamically insert here -->
                    </tbody>
					</table>
					<button id="addMaterialTraceData" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
					
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
								<th colspan="2">Verified Date and Time</th>
							</tr>
						</thead>
						<tbody id="labelTraceData">
							<!-- Data will dynamically insert here -->
						</tbody>
					</table>
					<button id="addLabelTraceData" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
					
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
									<th colspan="2">Verified Date and Time</th>
								</tr>
							</thead>
							<tbody id="productionVerificationData">
								<!-- Data will dynamically insert here -->
							</tbody>
						</table>
					</div>
					<button id="addProductionVerificationData" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
					
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
									<th colspan="2">Verified Date and Time</th>
								</tr>
							</thead>
							<tbody id="productionTeamMembersData">
								<!-- Data will dynamically insert here -->
							</tbody>
						</table>
					</div>
					<button id="addProductionTeamMembersData" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
					<hr>
                	<div class="my-3 text-center"><h6><b>Post Production Review</b></h6></div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Post Production Review</th>
								<th>Production Reviewed By</th>
								<th>Reviewed Date and Time</th>
								<th>QA/QC Reviewed By</th>
								<th colspan="2">Reviewed Date and Time</th>
							</tr>
						</thead>
						<tbody id="productionReviewData">
							<!-- Data will dynamically insert here -->
						</tbody>
					</table>
					<button id="addProductionReviewData" style="font-size: 14px" class="btn btn-primary my-3">Add New</button>
					
                <!-- Save Record button -->
                <div class="d-flex justify-content-center">
					<button style="font-size: 14px" type="submit" name="save_data" id="mcFormBtn" class="btn btn-success m-2 shadow-lg FormBtn">Save Record</button>
				</div>
			</div>
			<hr/>
			</form>
		</div>
	</form>
</div>

<script>

	// Responsible for adding new row in the table
	function addReferenceDocumentRow() {
		const row = `<tr>
			<td><input type="text" class="form-control" name="product_reference_sop_name[]" required></td>
			<td><input type="number" class="form-control" name="product_reference_sop_number[]" required></td>
            <td><textarea class="form-control" name="product_reference_description[]"></textarea></td>
			<td><input type="file" class="form-control-file" accept=".pdf" name="product_reference_document[]"></td>
			<td><input type="text" class="form-control" name="product_reference_verified_by[]"></td>
			<td><input type="datetime-local"  class="form-control" name="product_reference_verified_date_time[]" required></td>
			<td><button type="button" class="btn btn-danger deleteReferenceDocumentRow"><i class="fa fa-trash"></i></button></td>
		</tr>`;
		$('#referenceDocumentsData').append(row);
	}

	function addRawMaterialsRow() {
		const row = `<tr>
			<td><input type="text" class="form-control" name="raw_materials_name[]" required></td>
            <td><textarea class="form-control" name="product_raw_material_description[]"></textarea></td>
			<td><input type="number" class="form-control" name="raw_material_lot_number[]" required></td>
			<td><input type="text" class="form-control" name="raw_material_supplier_name[]"></td>
			<td><input type="text" class="form-control" name="raw_material_supplier_code[]"></td>
			<td><input type="date"  class="form-control" name="raw_material_expiration_date[]" required></td>
			<td><button type="button" class="btn btn-danger deleteRawMaterialsRow"><i class="fa fa-trash"></i></button></td>
		</tr>`;
		$('#rawMaterialsData').append(row);
	}

    function addPackagingMaterialsRow() {
		const row = `<tr>
			<td><input type="text" class="form-control" name="packaging_material_name[]" required></td>
            <td><textarea class="form-control" name="packaging_material_description[]"></textarea></td>
			<td><input type="number" class="form-control" name="packaging_material_lot_number[]" required></td>
			<td><input type="text" class="form-control" name="packaging_material_supplier_name[]"></td>
			<td><input type="text" class="form-control" name="packaging_material_supplier_code[]"></td>
			<td><button type="button" class="btn btn-danger deletePackagingMaterialsRow"><i class="fa fa-trash"></i></button></td>
		</tr>`;
		$('#packagingMaterialsData').append(row);
	}

	function addPreOperationVerificationRow(pre_operation_verification = "") {
		const row = `<tr>
                <td><textarea class="form-control preoperation-text-area" name="pre_operation_verification[]" required>${pre_operation_verification}</textarea></td>
                <td>
                    <select class="form-control" name="pov_status[]" required>
                        <option value=""></option>
                        <option value="Compliant">Compliant</option>
                        <option value="Non Compliant">Non Compliant</option>
                    </select>
                </td>
                <td><input type="file" class="form-control-file" accept=".pdf" name="pov_sop_reference[]" required></td>
                <td><input type="text"  class="form-control" name="pov_performed_by[]" ></td>
                <td><input type="datetime-local"  class="form-control" name="pov_performed_date_time[]" required></td>
                <td><input type="text"  class="form-control" name="pov_verified_by[]" ></td>
                <td><input type="datetime-local"  class="form-control" name="pov_verified_date_time[]" required></td>
                <td><button type="button" class="btn btn-danger deletePreOperationVerificationRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#preoperationsVerificationData').append(row);
	}

    function addProductionProcedureRow(processing_step = "") {
		const row = `<tr>
                <td><input type="text" value="${processing_step}"  class="form-control" name="procedure_processing_step[]" required></td>
                <td><textarea class="form-control preoperation-text-area" name="procedure_description[]" required></textarea></td>
                <td><input type="file" class="form-control-file" accept=".pdf" name="procedure_sop_reference[]" required></td>
                <td><input type="text"  class="form-control" name="procedure_performed_by[]" ></td>
                <td><input type="datetime-local"  class="form-control" name="procedure_performed_date_time[]" required></td>
                <td><input type="text"  class="form-control" name="procedure_verified_by[]" ></td>
                <td><input type="datetime-local"  class="form-control" name="procedure_verified_date_time[]" required></td>
                <td><button type="button" class="btn btn-danger deleteProductionProcedureRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#productionProcedureData').append(row);
	}

    function addYieldCalculationRow() {
		const row = `<tr>
                <td><textarea class="form-control preoperation-text-area" name="starting_weight_of_raw_materials[]" required></textarea></td>
                <td><textarea class="form-control preoperation-text-area" name="usable_weight_of_products[]" required></textarea></td>
                <td><input type="text"  class="form-control" name="yield_process_loss[]" ></td>
                <td><input type="text"  class="form-control" name="yield_percentage[]" ></td>
                <td><button type="button" class="btn btn-danger deleteYieldCalculationRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#yieldCalculationData').append(row);
	}

    function addReworkRow() {
		const row = `<tr>
                <td><input type="number"  class="form-control" name="material_quantity_for_reprocessing[]" ></td>
                <td><input type="number"  class="form-control" name="material_quantity_for_rework[]" ></td>
                <td><input type="text" class="form-control" name="rework_performed_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="rework_performed_date_time[]" required></td>
                <td><input type="text" class="form-control" name=rework_verified_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="rework_verified_date_time[]" required></td>   
                <td><button type="button" class="btn btn-danger deleteReworkRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#reworkData').append(row);
	}

    function addMaterialTraceData() {
		const row = `<tr>
                <td><input type="text"  class="form-control" name="material_trace_packaging_material_name[]" ></td>
                <td><input type="number"  class="form-control" name="material_trace_total_quantity_staged[]" ></td>
                <td><input type="number"  class="form-control" name="material_trace_total_used[]" ></td>
                <td><input type="number"  class="form-control" name="material_trace_disposed[]" ></td>
                <td><input type="number"  class="form-control" name="material_trace_total_remains[]" ></td>
                <td><input type="text" class="form-control" name="material_trace_verified_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="material_trace_verified_date_time[]" required></td>   
                <td><button type="button" class="btn btn-danger deleteMaterialTraceRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#materialTraceData').append(row);
	}

	function addLabelTraceData() {
		const row = `<tr>
                <td><input type="text"  class="form-control" name="label_trace_label_name[]" ></td>
                <td><input type="number"  class="form-control" name="label_trace_total_quantity_staged[]" ></td>
                <td><input type="number"  class="form-control" name="label_trace_total_used[]" ></td>
                <td><input type="number"  class="form-control" name="label_trace_disposed[]" ></td>
                <td><input type="number"  class="form-control" name="label_trace_total_remains[]" ></td>
                <td><input type="text" class="form-control" name="label_trace_verified_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="label_trace_verified_date_time[]" required></td>   
                <td><button type="button" class="btn btn-danger deleteLabelTraceRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#labelTraceData').append(row);
	}

	function addProductionVerificationData(default_data = "") {
		const row = `<tr>
				<td><textarea class="form-control" name="post_production_verification[]">${default_data}</textarea></td>
				<td><input type="file" class="form-control-file" accept=".pdf" name="post_production_sop_reference[]"></td>
				<td><input type="text" class="form-control" name="post_production_performed_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="post_production_performed_date_time[]" required></td>   
                <td><input type="text" class="form-control" name="post_production_verified_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="post_production_verified_date_time[]" required></td>   
                <td><button type="button" class="btn btn-danger deleteProductionVerificationRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#productionVerificationData').append(row);
	}

	function addProductionTeamMembersData() {
		const row = `<tr>
				<td><input type="text" class="form-control" name="team_member_name[]" required></td>
				<td><input type="text" class="form-control" name="team_member_position[]" required></td>
				<td>
                    <select class="form-control" name="team_member_qualified[]" required>
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td>
				<td><textarea class="form-control" name="team_member_notes[]" required></textarea></td>
                <td><input type="text" class="form-control" name="team_member_training_record_reference[]" required></td>
                <td><input type="text" class="form-control" name="team_member_verified_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="team_member_verified_date_time[]" required></td>   
                <td><button type="button" class="btn btn-danger deleteProductionTeamMembersRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#productionTeamMembersData').append(row);
	}

	function addProductionReviewData(default_data = "") {
		const row = `<tr>
				<td><textarea class="form-control" name="post_production_review[]" required>${default_data}</textarea></td>
                <td><input type="text" class="form-control" name="production_reviewed_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="production_reviewed_date_time[]" required></td>  
				<td><input type="text" class="form-control" name="production_review_qa_reviewed_by[]" required></td>
                <td><input type="datetime-local"  class="form-control" name="production_review_qa_reviewed_date_time[]" required></td>    
                <td><button type="button" class="btn btn-danger deleteProductionReviewRow"><i class="fa fa-trash"></i></button></td>
            </tr>`;
		$('#productionReviewData').append(row);
	}

	$(document).ready(function() {
		// Call addReferenceDocumentRow function when button with an id of addReferenceDocumentRow is clicked.
		$('#addReferenceDocumentRow').on('click', function(e) {
			e.preventDefault();
			addReferenceDocumentRow();
		});

        // Delete the row once the delete icon is clicked
		$('#referenceDocumentsData').on('click', '.deleteReferenceDocumentRow', function () {
			$(this).closest('tr').remove();
		});
        

        // Call addRawMaterialsRow function when button with an id of addRawMaterialsRow is clicked.
		$('#addRawMaterialsRow').on('click', function(e) {
			e.preventDefault();
			addRawMaterialsRow();
		});

        // Delete the row once the delete icon is clicked
		$('#rawMaterialsData').on('click', '.deleteRawMaterialsRow', function () {
			$(this).closest('tr').remove();
		});
        
         // Call addPackagingMaterialsRow function when button with an id of addPackagingMaterialsRow is clicked.
		$('#addPackagingMaterialsRow').on('click', function(e) {
			e.preventDefault();
			addPackagingMaterialsRow();
		});

        // Delete the row once the delete icon is clicked
		$('#packagingMaterialsData').on('click', '.deletePackagingMaterialsRow', function () {
			$(this).closest('tr').remove();
		});

        // Call addPreOperationVerificationRow function when button with an id of addPreOperationVerificationRow is clicked.
		$('#addPreOperationVerificationRow').on('click', function(e) {
			e.preventDefault();
			addPreOperationVerificationRow();
		});

        // Delete the row once the delete icon is clicked
		$('#preoperationsVerificationData').on('click', '.deletePreOperationVerificationRow', function () {
			$(this).closest('tr').remove();
		});

        // Call addProductionProcedureRow function when button with an id of addProductionProcedureRow is clicked.
		$('#addProductionProcedureRow').on('click', function(e) {
			e.preventDefault();
			addProductionProcedureRow();
		});

        // Delete the row once the delete icon is clicked
		$('#productionProcedureData').on('click', '.deleteProductionProcedureRow', function () {
			$(this).closest('tr').remove();
		});

         // Call addYieldCalculationRow function when button with an id of addYieldCalculationRow is clicked.
		$('#addYieldCalculationRow').on('click', function(e) {
			e.preventDefault();
			addYieldCalculationRow();
		});

        // Delete the row once the delete icon is clicked
		$('#yieldCalculationData').on('click', '.deleteYieldCalculationRow', function () {
			$(this).closest('tr').remove();
		});

        // Call addReworkRow function when button with an id of addReworkRow is clicked.
		$('#addReworkRow').on('click', function(e) {
			e.preventDefault();
			addReworkRow();
		});

        // Delete the row once the delete icon is clicked
		$('#reworkData').on('click', '.deleteReworkRow', function () {
			$(this).closest('tr').remove();
		});

         // Call addMaterialTraceData function when button with an id of addMaterialTraceData is clicked.
		$('#addMaterialTraceData').on('click', function(e) {
			e.preventDefault();
			addMaterialTraceData();
		});

        // Delete the row once the delete icon is clicked
		$('#materialTraceData').on('click', '.deleteMaterialTraceRow', function () {
			$(this).closest('tr').remove();
		});

		
        // Call addLabelTraceData function when button with an id of addLabelTraceData is clicked.
		$('#addLabelTraceData').on('click', function(e) {
			e.preventDefault();
			addLabelTraceData();
		});

        // Delete the row once the delete icon is clicked
		$('#labelTraceData').on('click', '.deleteLabelTraceRow', function () {
			$(this).closest('tr').remove();
		});

		 // Call addProductionVerificationData function when button with an id of addProductionVerificationData is clicked.
		 $('#addProductionVerificationData').on('click', function(e) {
			e.preventDefault();
			addProductionVerificationData();
		});

        // Delete the row once the delete icon is clicked
		$('#productionVerificationData').on('click', '.deleteProductionVerificationRow', function () {
			$(this).closest('tr').remove();
		});

		 // Call addProductionTeamMembersData function when button with an id of addProductionTeamMembersData is clicked.
		 $('#addProductionTeamMembersData').on('click', function(e) {
			e.preventDefault();
			addProductionTeamMembersData();
		});

        // Delete the row once the delete icon is clicked
		$('#productionTeamMembersData').on('click', '.deleteProductionTeamMembersRow', function () {
			$(this).closest('tr').remove();
		});

		 // Call addProductionReviewData function when button with an id of addProductionReviewData is clicked.
		 $('#addProductionReviewData').on('click', function(e) {
			e.preventDefault();
			addProductionReviewData();
		});

        // Delete the row once the delete icon is clicked
		$('#productionReviewData').on('click', '.deleteProductionReviewRow', function () {
			$(this).closest('tr').remove();
		});

		// Submit a post request to insert the rows data to the database.
		$('#batchManufaturingForm').on('submit', function(e) {
                e.preventDefault();

				// Get form data
				const formData = new FormData(this);
			
				// Send request
                $.ajax({
                    url: '<?php echo site_url('Forms/Consultare/gmp_bmr') ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
					dataType: "json",
                    success: function(response) {
						// Display the request status
                        alert(response.message);
						if (response.status === 'success') {
							// Clear form fields once the request is success
							$('#batchManufaturingForm')[0].reset();
							$('#referenceDocumentsData').empty();
                            addReferenceDocumentRow();
							$('#rawMaterialsData').empty();
                            addRawMaterialsRow();
                            $('#packagingMaterialsData').empty();
                            addPackagingMaterialsRow();
                            $('#preoperationsVerificationData').empty();
                            setPreOperationVerificationDefaultData();
                            $('#productionProcedureData').empty();
                            setProductionProcedureDefaultRow();
                            $('#yieldCalculationData').empty();
                            addYieldCalculationRow();
                            $('#reworkData').empty();
                            addReworkRow();
                            $('#materialTraceData').empty();
                            addMaterialTraceData();
							$('#labelTraceData').empty();
                            addLabelTraceData();
							$('#productionVerificationData').empty();
                            setProductionVerificationDefaultData();
							$('#productionTeamMembersData').empty();
                            addProductionTeamMembersData();
							$('#productionReviewData').empty();
                            setProductionReviewDefaultData();
							
						}
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });


		// Add row by default
		addReferenceDocumentRow();
        addRawMaterialsRow();
        addPackagingMaterialsRow();
        addYieldCalculationRow();
        addReworkRow();
        addMaterialTraceData();
		addLabelTraceData();
        addProductionTeamMembersData();

        function setPreOperationVerificationDefaultData() {
            let preOperationVerification = [
            "Verify the processing area is clean, sanitized, and no materials present from the previous operations",
            "Verify the processing area does not contain maintenance materials, chemicals, equipment, and tools",
            "Verify the processing area does not contain sanitation materials, chemicals, equipment, and utensils",
            "Verify the processing area or room's log book is filled out, complete, and up-to-date",
            "Verify sanitation records for the processing area / room are complied with",
            "Verify sanitation records for the equipment are complied with",
            "Verify sanitation records for the equipment are complied with",
            "Verify sanitation records for the utensils are complied with",
            "Verify equipment's calibration records are current and up-to-date",
            "Verify all raw materials per the BOM are staged, complete, accurate, present, and accounted for",
            "Verify all packaging materials per the BOM are staged, complete, accurate, present, and accounted for",
            "Verify all pre-weighting operations of raw materials/ingredients are complied with",
            "Verify all materials are released, approved, and have acceptable expiry dates",
            "Verify that all processing equipment and utensils are present, cleaned, calibrated, as required",
            "Verify equipment logs are complete, accurate, and up-to-date",
            "Verify that all personnel are qualified to perform their assigned tasks",
            "Verify that PPE items (gloves, paper towels, hair nets, beard nets etc.) are available",
            "Verify that all personnel are qualified to perform their assigned tasks"
        ];

            preOperationVerification.forEach((data) => {
                addPreOperationVerificationRow(data);
            })
        }

        setPreOperationVerificationDefaultData();

        function setProductionProcedureDefaultRow() {
            const processes = [
                "Bagging",
                "Baking",
                "Blending",
                "BOM Staging",
                "Canning",
                "Chopping",
                "Coding (Lot/Batch)",
                "Conveying",
                "Cooking",
                "Dissolving",
                "Drying",
                "Encapsulating",
                "Frying",
                "Holding",
                "Labelling",
                "Mixing",
                "Packaging",
                "Packing",
                "Pouring",
                "Pre-Washing",
                "Pre-Weighing",
                "Reprocessing",
                "Retaining",
                "Reworking",
                "Sampling",
                "Sieving",
                "Staging",
                "Tableting",
                "Transferring",
                "Weighing"
            ];

            processes.forEach((data) => {
                addProductionProcedureRow(data);
            })
        }

        setProductionProcedureDefaultRow();

		function setProductionVerificationDefaultData() {
			let verificationChecklist = [
				"Verify that the processing area log is filled out, accurate, and complete",
				"Verify processed materials left overs are labeled for re-work or re-processing",
				"Verify that all un-used raw materials are removed from the processing areas/rooms",
				"Verify that all un-used packaging materials are removed from the processing area",
				"Verify that all un-used labels are accounted for and are removed from the processing area",
				"Verify that any equipment issues or require repair are reported to the maintenance department",
				"Verify equipment logs are complete, accurate, and up-to-date"
			];


            verificationChecklist.forEach((data) => {
                addProductionVerificationData(data);
            })
        }

        setProductionVerificationDefaultData();

		function setProductionReviewDefaultData() {
			let postProductionReview = [
				"The complete Post-Production Batch Record has been reviewed for completeness and accuracy."
			];

			postProductionReview.forEach((data) => {
				addProductionReviewData(data);
			})
		}

		setProductionReviewDefaultData();
	});

	// Require other fields if result is Fail
	function result(row_num) {

		let result = document.getElementById(`result${row_num}`).value;
		// Select the input field
		let deficiency = document.getElementById(`deficiency${row_num}`);
		let corrective_action = document.getElementById(`corrective_action${row_num}`);
		let closed_status = document.getElementById(`closed_status${row_num}`);
		if (result === 'Fail') {
			// Add the "required" attribute
			deficiency.setAttribute("required", "");
			corrective_action.setAttribute("required", "");
			closed_status.remove();
			
		} else {
			// Remove the "required" attribute
			deficiency.removeAttribute("required");
			corrective_action.removeAttribute("required");
			$(`#status${row_num}`).append(`<option id="closed_status${row_num}" value="Closed">Closed</option>`);
		}
	
	}

</script>
