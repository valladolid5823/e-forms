
<style>
    .signature-pad {
        border-radius: 2px;
        border: 1px dashed #ccc;
        cursor: crosshair;
        width:300px;
        height: auto;
    }
</style>
<div id="container">
	<div id="head">
        <h1>WATER ACTIVITY TESTER CALIBRATION HELP
		</h1>
		
    </div>
	<div id="body">
		
        <form autocomplete="off" method="POST" action="?" id="watch_form">
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
				<tbody>
					<tr>
						<td><input type="text" class="form-control" name="substance" required></td>
						<td><input type="text" class="form-control" name="reading" required></td>
						<td>
							<select class="form-control" name="pass_fail" required>
								<option value="Pass">Pass</option>
								<option value="Fail">Fail</option>
							</select>
						</td>
						<td><input type="text" class="form-control" name="inspected_by" required></td>
						<td>
							<input type="datetime-local"  class="form-control"  name="date_time" required>
						</td>
					</tr>
					
				</tbody>
			</table>
			<div class="mt-5 mb-3 text-center">
				<b>Pre-Operational Calibration Verification</b>
			</div>
			<i>If verification has "Fail" results, remove the equipment from the area and place an Equipment Tag.</i>
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
				<tbody>
					<tr>
						<td><input type="text" class="form-control" name="equipment_tracking_no" required></td>
						<td><input type="text" class="form-control" name="equipment_description" required></td>
						<td><input type="text" class="form-control" name="model_no" required></td>
						<td><input type="text" class="form-control" name="serial_no" required></td>
						<td><input type="date"  class="form-control"  name="calibration_certification_date" required></td>
						<td><input type="date"  class="form-control"  name="calibration_certification_due_date" required></td>
					</tr>
					
				</tbody>
			</table>
		
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
                                    <select id="signOption2" onchange="changeSigOption(2)" class="mb-3 p-2">
                                        <option value="D">Select Signature Option</option>
                                        <option value="D">Draw Signature</option>
                                        <option value="U">Upload Signature</option>
                                    </select>
                                    <div id="showD2" class="signature2" style="display:flex; justify-content:center;margin-bottom: 10px;">
                                    <div class="signature-pad-container">
                                        <div class="signature-pad" id="signature-pad"></div><br>
                                        <button type="button" class="btn btn-flat btn-sm clear-btn2 clear" onclick="resetSign(2)">Clear</button>
                                        <textarea id="reviewer_draw_sign2" class="signature-data-text d-none" name="reviewer_draw_sign" value="" readonly></textarea>
                                    </div>
                                </div>
                                    <div id="showU2" class="signature2 d-none mb-2">
                                        <input id="reviewer_img_sign2" type="file"  id="m-actual-image2" name="reviewer_img_sign" onchange="dataURLv(this,2)" style="margin-bottom:7px;"/><br>
										<div id="actual-image-res-section2">
											<img id="actual-image-res2" width="220" height="80" src="#"/>
										</div><br>
                                        <button class="btn btn-flat btn-sm btn-danger mt-1 clear" id="imageRes2" type="button" onclick="resetImage(2)">Clear</button>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="reviewer_name" placeholder="Name" required>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="reviewer_position" placeholder="Position" required>
                                    </div>
                                        
                                    <div class="input-group input-group-sm">
                                        <input type="datetime-local"  class="form-control"  name="reviewed_date" required>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="m-3 mb-5" style="display:flex; justify-content:center;">
                                <div>
                                    <select id="signOption3" onchange="changeSigOption(3)" class="mb-3 p-2">
                                        <option value="D">Select Signature Option</option>
                                        <option value="D">Draw Signature</option>
                                        <option value="U">Upload Signature</option>
                                    </select>
                                    <div id="showD3" class="signature3" style="display:flex; justify-content:center;margin-bottom: 10px;">
                                        <div class="signature-pad-container">
                                            <div class="signature-pad" id="signature-pad"></div><br>
                                            <button type="button" class="btn btn-flat btn-sm clear-btn3 sig-clearBtn clear" onclick="resetSign(3)">Clear</button>
                                            <textarea id="approver_draw_sign3" class="signature-data-text d-none" name="approver_draw_sign" value="" readonly></textarea>
                                        </div>
                                    </div>
                                    <div id="showU3" class="signature3 d-none mb-2">
                                        <input id="approver_img_sign3" type="file"  id="m-actual-image3" name="approver_img_sign" onchange="dataURLv(this,3)" style="margin-bottom:7px;"/><br>
										<div id="actual-image-res-section3">
											<img id="actual-image-res3" width="220" height="80" src="#"/>
										</div><br>
                                        <button class="btn btn-flat btn-sm btn-danger mt-1 clear" type="button" onclick="resetImage(3)">Clear</button>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="approver_name" placeholder="Name" required>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="approver_position" placeholder="Position" required>
                                    </div>
                                        
                                    <div class="input-group input-group-sm">
                                        <input type="datetime-local"  class="form-control"  name="approved_date" required>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
                <div class="d-flex justify-content-center">
                    <button style="font-size: 14px" type="submit" name="save_data" id="mcFormBtn" class="btn btn-success m-2 shadow-lg FormBtn">Save Record</button>
                </div>
            </div>
            <hr/>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jSignature/2.1.3/jSignature.min.js"></script>
<script>

	
	$(document).ready(function() {

		// Submit a post request to insert the rows data to the database.
		$('#watch_form').on('submit', function(e) {
                e.preventDefault();

				// Validate if reviewer signature is attached
				if (!$('#reviewer_draw_sign2').val() && !$('#reviewer_img_sign2').val()) {
					alert('Reviewer signature is required!');
					return;
				}

				// Validate if approver signature is attached
				if (!$('#approver_draw_sign3').val() && !$('#approver_img_sign3').val()) {
					alert('Approver signature is required!');
					return;
				}

				// Get form data
				const formData = new FormData(this);
			
				// Send request
                $.ajax({
                    url: '<?php echo site_url('Forms/Consultare/gmp_watch') ?>',
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
							$('#watch_form')[0].reset();
							// Clear signature uploads and drawn
							$('.clear').click();
						}
                    },
                    error: function(error) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
	});

    // <----------// Signature Area // -------->
    $(function(){
        $('.signature-pad').each(function (index) {
            var uniqueId = 'signature-pad' + (index + 1);
            $(this).attr('id', uniqueId);
            $('#' + uniqueId).jSignature();
    
            $('#' + uniqueId).on('change', function () {
                var signatureData = $(this).jSignature('getData', 'default');
                $(this).siblings('.signature-data-text').val(signatureData);
    
                var selectId = 'signOption' + (index + 2);
                if (signatureData && signatureData.length !== 0) {
                    $('#' + selectId).prop('disabled', true);
                } else {
                    $('#' + selectId).prop('disabled', false);
                }
            });
        });
    })

    function resetSign(id) {
        $('.clear-btn' + id).siblings('.signature-pad').jSignature('clear');
        $('.clear-btn' + id).siblings('.signature-data-text').val('');
        var selectId = 'signOption' + id;
        $('#' + selectId).prop('disabled', false);
    }
    
    function resetImage(id) {
        $('#m-actual-image' + id).val('');
        $('#actual-image-res' + id).removeAttr('src');
        var selectId = 'signOption' + id;
        $('#' + selectId).attr('disabled', false);
    }

    function dataURLv(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Check if the file is an image
            if (input.files[0].type.startsWith('image/')) {
                reader.onload = function(e) {
                    $("#actual-image-res-section" + id).html(`<img id="actual-image-res${id}" width="220" height="80" src="${e.target.result}"/>`);
                    $("#clear-attachment-btn" + id).html(`<button class="mt-1 btn btn-flat btn-sm btn-danger clear" type="button" onclick="resetImage(${id})">Clear</button>`);
                };
                reader.readAsDataURL(input.files[0]);
            } 
            var selectId = 'signOption' + id;
            $('#' + selectId).prop('disabled', true);
        } else {
            // No file selected, enable the select option
            var selectId = 'signOption' + id;
            $('#' + selectId).prop('disabled', false);
        }
    }

    function changeSigOption(id) {
        var demovalue = $('#signOption' + id).val();
        $('div.signature' + id).addClass('d-none');
        $('#show' + demovalue + id).removeClass('d-none');
    }

  // <----------// Signature End // -------->
</script>
