<script src="https://cdnjs.cloudflare.com/ajax/libs/jSignature/2.1.3/jSignature.min.js"></script>
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
        <h1>GMP Checklist – Daily Self Inspection</h1>
    </div>
	<div id="body">
        <form autocomplete="off" method="POST" action="?">
            <labe>Date Inspected: </labe><input type="text" name="inspection_date" class="datepicker" readonly="" required="" value="<?php echo date('m/d/Y');?>" />
            <labe>Time: </labe><input type="text" name="inspection_time" class="timepicker" required=""  />
            <a id="timepicker_now" href="#" title="Get Current Timestamp"><i class="fa fa-clock"></i></a>
            <?php
                echo $content;
            ?>
            <table>
                <tfoot>
                    <tr>
                        <td>
                            Reference: SQF Module 2 Edition 9 for Food Manufacturing, 2.5.4.3 Regular inspections of the site and equipment shall be planned and carried out to verify that Good Manufacturing Practices and facility and equipment maintenance comply with the SQF Food Safety Code: Food Manufacturing. The site shall: i. Take corrections or corrective and preventative action; and ii. Maintain records of inspections and any corrective actions are taken.
                        </td>
                    </tr>
                </tfoot>
            </table>
            <hr/>
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
                                        <button type="button" class="btn btn-flat btn-sm clear-btn clear-btn2" onclick="resetSign(2)">Clear</button>
                                        <textarea class="signature-data-text d-none" name="reviewer_draw_sign" value="" readonly></textarea>
                                    </div>
                                </div>
                                    <div id="showU2" class="signature2 d-none mb-2">
                                        <input type="file"  id="m-actual-image2" name="reviewer_img_sign" onchange="dataURLv(this,2)" style="margin-bottom:7px;"/><br>
                                        <img id="actual-image-res2" width="220" height="80" src="#"/><br>
                                        <button class="btn btn-flat btn-sm btn-danger mt-1" id="imageRes2" type="button" onclick="resetImage(2)">Remove</button>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="reviewer_name" placeholder="Name">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="reviewer_position" placeholder="Position">
                                    </div>
                                        
                                    <div class="input-group input-group-sm">
                                        <input type="datetime-local"  class="form-control"  name="reviewed_date">
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
                                            <button type="button" class="btn btn-flat btn-sm clear-btn3 sig-clearBtn" onclick="resetSign(3)">Clear</button>
                                            <textarea class="signature-data-text d-none" name="approver_draw_sign" value="" readonly></textarea>
                                        </div>
                                    </div>
                                    <div id="showU3" class="signature3 d-none mb-2">
                                        <input type="file"  id="m-actual-image3" name="approver_img_sign" onchange="dataURLv(this,3)" style="margin-bottom:7px;"/><br>
                                        <img id="actual-image-res3" width="220" height="80" src="#"/><br>
                                        <button class="btn btn-flat btn-sm btn-danger mt-1" type="button" onclick="resetImage(3)">Clear</button>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="approver_name" placeholder="Name">
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input type="text"  class="form-control mb-1"  name="approver_position" placeholder="Position">
                                    </div>
                                        
                                    <div class="input-group input-group-sm">
                                        <input type="datetime-local"  class="form-control"  name="approved_date">
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

<script>
    // <----------// Signature Area // -------->
    $(function(){
        $('.signature-pad').each(function (index) {
            var uniqueId = 'signature-pad' + (index + 1);
            $(this).attr('id', uniqueId);
            $('#' + uniqueId).jSignature();
    
            $('#' + uniqueId).on('change', function () {
                var signatureData = $(this).jSignature('getData', 'default');
                $(this).siblings('.signature-data-text').val(signatureData);
    
                var selectId = 'signOption' + (index + 1);
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
        console.log(id)
        console.log(selectId)
    }

    function dataURLv(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Check if the file is an image
            if (input.files[0].type.startsWith('image/')) {
                reader.onload = function(e) {
                    $("#actual-image-res-section" + id).html(`<img id="actual-image-res${id}" width="220" height="80" src="${e.target.result}"/>`);
                    $("#clear-attachment-btn" + id).html(`<button class="mt-1 btn btn-flat btn-sm btn-danger" type="button" onclick="resetImage(${id})">Remove</button>`);
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