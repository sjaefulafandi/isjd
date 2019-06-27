<div class="modal-content">
		    
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<i class="fa fa-quote-left fa-fw"></i> 
		<b>Kuota Form</b>
		<i class="fa fa-quote-right fa-fw"></i> 
	</div>
	<form method="post" action="#" enctype="multipart/form-data" id=="kuota_form">
	
	<div class="modal-body">
		
		<div class="form-group form-group-sm" >
			
			<div class="row">
				<div class="col-sm-4"> Nominal
					<input type="input" class="form-control input-sm" id="nominal_transfer" value="<?php echo $nominal_transfer;?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4"> Kuota Download
					<input type="input" class="form-control input-sm" id="kuota_download" value="<?php echo $konvert_download;?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8"> Bukti Transfer <br>
				<label>File Input: <input type="file" name="file" id="demo1" /></label>
				<div id="uploads">

				</div>
				</div>
			</div>
			
		</div>	
	</div>
	<div class="row-fluid modal-footer">
		<button class="btn btn-default btn-xs" type="submit" >Save & Close</button>
	 <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
			      
	</div>
	</form>
</div>
<script >
$(document).ready(function() {
	var interval;
	function applyAjaxFileUpload(element) {
		$(element).AjaxFileUpload({
			action: base_url+"index.php/user_public/upload",
			onChange: function(filename) {
				// Create a span element to notify the user of an upload in progress
				var $span = $("<span />")
					.attr("class", $(this).attr("id"))
					.text("Uploading")
					.insertAfter($(this));
				$(this).remove();
				interval = window.setInterval(function() {
					var text = $span.text();
					if (text.length < 13) {
						$span.text(text + ".");
					} else {
						$span.text("Uploading");
					}
				}, 200);
			},
			onSubmit: function(filename) {
				// Return false here to cancel the upload
				/*var $fileInput = $("<input />")
					.attr({
						type: "file",
						name: $(this).attr("name"),
						id: $(this).attr("id")
					});
				$("span." + $(this).attr("id")).replaceWith($fileInput);
				applyAjaxFileUpload($fileInput);
				return false;*/
				// Return key-value pair to be sent along with the file
				return true;
			},
			onComplete: function(filename, response) {
				window.clearInterval(interval);
				var $span = $("span." + $(this).attr("id")).text(filename + " "),
					$fileInput = $("<input />")
						.attr({
							type: "file",
							name: $(this).attr("name"),
							id: $(this).attr("id")
						});
				if (typeof(response.error) === "string") {
					$span.replaceWith($fileInput);
					applyAjaxFileUpload($fileInput);
					alert(response.error);
					return;
				}
				$("<a />")
					.attr("href", "#")
					.text("x")
					.bind("click", function(e) {
						$span.replaceWith($fileInput);
						applyAjaxFileUpload($fileInput);
					})
					.appendTo($span);
				$("<br>").appendTo($span);	
				$("<label>")
					.attr("id","kodetransfer")
					.text(response.kode_transfer).appendTo($span);
			}
		});
	}
	$("#kuota_form").validate({
	    rules: {
				demo1:{required:true}
				},
  		messages :{
	 		demo1:{required:"Upload file bukti transfer"}
      	},
	 	submitHandler: function(form) {
	        var harga=$('#nominal_transfer').val();
	  	    var konversidownload=$('#kuota_download').val();
	        var kodeuploads=$('#uploads').val();
	        $('#modaladmin').load(base_url+'index.php/user_public/save_kuota/',{"harga":harga,"konversidownload":konversidownload,"kodeuploads":kodeuploads},function (data){tarif();$('#myModalDetail').modal('hide');});
	         // $('#myModalDetail').modal('hide');
	        return false ;//alert('hat');
      	}//end of function submit_handler
	});

	//applyAjaxFileUpload("#demo1");
});
</script>
