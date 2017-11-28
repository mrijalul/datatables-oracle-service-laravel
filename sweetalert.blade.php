npm install bootstrap-sweetalert --save-dev
//sweetalert confirmation delete data
$(document).on('click', '#delete-btn', function(e){
	e.preventDefault();
	var self = $(this);
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this data!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "Cancel",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if(isConfirm){
			swal("Deleted!","Are you sure want to delete this thread", "success");
			setTimeout(function() {
				self.parents(".delete_form").submit();
			}, 500);
		}
		else{
			swal("cancelled","Are you sure want to delete this thread", "error");
		}
	});
});