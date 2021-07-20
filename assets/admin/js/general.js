console.log("general.js file is included");

const Toast = Swal.mixin({
  toast: true,
  position: 'top',

  showConfirmButton: false,
  timer: 3000
});
// General toast alert message according to type.
function alert_msg(type, msg) {
  Toast.fire({
      type: type,
      title: msg
  })
}


$(function () {

	// $("#example1").DataTable({
	//   "responsive": true,
	//   "lengthChange": false,
	//   "autoWidth": false,
	//   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	// }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

var temp = `
  <div class="form-group col-md-12">
      <label for="vSubCategoryName">Sub-Category Name
          <a class='delete-sub-category' href=""><i class="far fa-trash-alt"></i></a>
      </label>
      <input type="text" name="vSubCategoryName[]" class="form-control" id="vSubCategoryName" placeholder="Enter Sub-Category Name">
  </div>
  `;
$(document).ready(() => {

  $(document).on('change','#iCategoryId',function(){

    console.log('changes');
    console.log($(this).val());

    let id = $(this).val();
    $.ajax({
      url:base_url+'post/getSubCategory',
      data:{'id':id},
      method:'get',
      success:(res)=>{
        console.log(res);
        $('#iSubCategoryId').html(res);
      }
    });
  });


  $("#example1").DataTable({
		responsive: true,
    serverSide: true,
    serverMethod: 'post',
    ajax: base_url + 'category/category_listing',

    order: [
              [2, 'asc']
          ],
    columnDefs: [
    { "targets": 0, "orderable": false, "name": "pay.iAppointmentId" },
    { "targets": 1, "orderable": false, "name": "usr.vFirstName" },
    { "targets": 2, "name": "vCategoryName" },
    { "targets": 3, "name": "vSubCategoryName" },
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]

		//   "autoWidth": false,
	});

  $("#user_table").DataTable({
		responsive: true,
    serverSide: true,
    serverMethod: 'post',
    ajax: base_url + 'admin/user_listing',

    order: [
              [2, 'asc']
          ],
    columnDefs: [
    { "targets": 0, "orderable": false, "name": "vFullName" },
    { "targets": 1, "orderable": false, "name": "usr.vFirstName" },
    { "targets": 2, "name": "vFullName" },
    { "targets": 3, "name": "vEmail" },
    { "targets": 4, "name": "vMobile" },
    { "targets": 5, "name": "tAddress" },
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
	});

  $("#post_listing").DataTable({
		responsive: true,
    serverSide: true,
    serverMethod: 'post',
    ajax: base_url + 'post/post_listing',

    order: [
              [3, 'asc']
          ],
    columnDefs: [
    { "targets": 0, "orderable": false, "name": "vFullName" },
    { "targets": 1, "orderable": false, "name": "usr.vFirstName" },
    { "targets": 2, "name": "vFeaturedImage" },
    { "targets": 3, "name": "vTitle" }
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
	});



	bsCustomFileInput.init();
	// post-content
	$("#post-content").summernote({ height: 300 });

  // add new category field
	$("#add-sub-category").on("click", (e) => {
		e.preventDefault();
    $('#sub-category-container').append(temp);
	});

  // delete sub category
  $(document).on("click",'.delete-sub-category', function (e){
    e.preventDefault();
    $(this).closest('.form-group').remove();
  });
});

