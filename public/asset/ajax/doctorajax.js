$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        }
    });

    // Add Doctor
    $('body').on('click', '#doctorAdd', function () {
        $("#doctor_title").html("Add Doctor");
        $("#doctor_id").val("");
        $('#doctorForm').trigger("reset");
        $("#doctorModal").modal("show");
    });

    // Update Doctor
    $('body').on('click', '#doctorEdit', function (event) {
        $("#doctor_title").html("Edit Doctor");
        var doctorId = $(this).data("id");
        var imgUrl = $('#file_url').val();

        $.get("doctor/" + doctorId + "/editDoctor", function (result) {
            $('#doctorModal').modal('show');
            $("#doctor_id").val(result.id);
            $("#firstname").val(result.firstname);
            $("#lastname").val(result.lastname);
            $("#email").val(result.email);
            $("#password").val(result.password);
            /* $(".passwordLabel").hide(); */
            $("#phone").val(result.phone);
            $("#birth_date").val(result.birth_date);
            $("#degree").val(result.degree);
            $("#speciality option[value="+result.speciality_id+"]").attr('selected', 'selected');
            $("#address").val(result.address);
            if(result.doctor_image){
                var img = $('<img id="docImage" width="150" height="150">'); 
                img.attr('src', imgUrl+'/'+result.doctor_image);
                img.appendTo('#uploaded_image');
                $("#uploaded_image").append('<i class="fa fa-times" id="deleteImage"></i>');
                $("#upl_doctor_image").val(result.doctor_image); 
            } 
        });
    });

    // Save Doctor
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#doctorForm').serialize(),
            url: "doctor/save",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#loader').hide();
                    setTimeout(function () {
                        $('#doctorModal').modal('hide');
                        location.reload();
                    }, 3000);
                } else {
                    $.each(response.error, function (key, value) {
                        $('.' + key + '_error').text(value);
                        $('.' + key).css("border", "1px solid red");
                    });
                }
            },
            error: function (data) {
            }
        });
    });

    // delete Doctor
    $(document).on('click', '#doctorDelete', function () {
        var doctorId = $(this).data("id");
        var $ele =  $(this).parent().parent();
       var conf = confirm("Are You sure want to delete !");
       if(conf){
            $.ajax({
                type: "DELETE",
                url: "doctor/" +doctorId+ "/delDoctor",
                success: function (data) {
                    $ele.fadeOut(4000).remove();
                }
            });
       } 
    });

      // view Doctor details
      $('body').on('click', '#doctorView', function (event) {
        $("#doctor_title").html("View Doctor");
        var doctorId = $(this).data("id");
        var imgUrl = $('#file_url').val();

        $.get("doctor/" + doctorId + "/viewDoctors", function (result) {
            $('#doctorForm').trigger("reset");
            $('#doctorModal').modal('show');
            $.each(result, function(key, value){
                $("#doctor_id").val(value.id);
                $("#firstname").val(value.firstname);
                $("#firstname").prop('disabled', true);
                $("#lastname").val(value.lastname);
                $("#lastname").prop('disabled', true);
                $("#email").val(value.email);
                $("#email").prop('disabled', true);
                $("#password").val(value.password);
                $("#password").prop('disabled', true);
                $("#phone").val(value.phone);
                $("#phone").prop('disabled', true);
                $("#birth_date").val(value.birth_date);
                $("#birth_date").prop('disabled', true);
                $("#degree").val(value.degree);
                $("#degree").prop('disabled', true);
                $("#speciality option[value="+value.speciality_id+"]").attr('selected', 'selected');
                $("#speciality").prop('disabled', true);
                $("#address").val(value.address);
                $("#address").prop('disabled', true);
                $("#doctor_image").hide();
                $("#saveBtn").hide();
                if(value.doctor_image){
                    var img = $('<img id="docImage" width="150" height="150">'); 
                    img.attr('src', imgUrl+'/'+value.doctor_image);
                    img.appendTo('#uploaded_image');
                    $("#upl_doctor_image").val(value.doctor_image); 
                } 
            });
           
            
        });
    });

    // Status
    $(document).on('click', '#doctorStatus', function(){
        var doctorId = $(this).data("id");
        var status = $(this).data("status");

        if(status === 'active'){
           status = 'inactive';
        }else{
            status = 'active';
        }
        $.ajax({
            type: "PUT",
            url: "doctor/chnageStatus",
            data: { doctorId:doctorId, status:status },
            success: function (response) {
                location.reload();
            }
        });
    });

    // Pagination
    $(document).on('click', '.page-item a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var query = $('#searchDoctor').val();
        var entry = $('#getEntry').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });
    
    // search
    $(document).on('keyup', '#searchDoctor', function(){
        var query = $('#searchDoctor').val();
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var page = $('#hidden_page').val();
        var entry = $('#getEntry').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });

    // Sorting
    function clear_icon() {
        $('#id_icon').html('');
        $('#firstname_icon').html('');
        $('#lastname_icon').html('');
    }
    // entry
    $(document).on('change', '#getEntry', function(){
        var entry = $('#getEntry').val();
        var page = $('#hidden_page').val();
        var sort_type = $('#hidden_sort_type').val();
        var column_name = $('#hidden_column_name').val();
        var query = $('#searchDoctor').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });
    $(document).on('click', '.sorting', function(){
        var column_name = $(this).data('column_name');
        var order_type = $(this).data('sorting_type');
        var reverse_order = '';
        if(order_type == 'asc') {
            $(this).data('sorting_type', 'desc');
            reverse_order = 'desc';
            clear_icon();
            $('#'+column_name+'_icon').html('<i class="fa fa-sort-down"></i>');         
        }
        if(order_type == 'desc') {
            $(this).data('sorting_type', 'asc');
            reverse_order = 'asc';
            clear_icon
            $('#'+column_name+'_icon').html('<i class="fa fa-sort-up"></i>');
        }
        $('#hidden_column_name').val(column_name);
        $('#hidden_sort_type').val(reverse_order);
        var page = $('#hidden_page').val();
        var query = $('#searchDoctor').val();
        var entry = $('#getEntry').val();
        fetch_data(page, reverse_order, column_name, query, entry);
    });

    function fetch_data(page, sort_type, sort_by, query, entry) {
        $.ajax({
            url: "doctor/fetch_data",
            data: { page:page, 
                    sortby:sort_by, 
                    sorttype:sort_type,
                    query:query,
                    entry:entry
                 },
            success: function (response) {
                $('tbody').html('');
                $('tbody').html(response);
            }
        });
    }

    // Get Speciality
    $(function(){
        $.ajax({
            url: 'doctor/speciality',
            dataType: 'json',
            success: function(response){
                var speciality = response.speciality;
              $.each(speciality, function(key, value){
                  let option = `<option value="${value.id}">${value.name}</option>`;
                  $("#speciality").append(option);
              });
            }
        });
    });

    // Uplaod Doctor Image
    $(document).on('change', '#doctor_image', function(){
        var fileName = document.getElementById("doctor_image").files[0].name;
        var form_data = new FormData();
        var ext = fileName.split('.').pop().toLowerCase();
        var imgUrl = $('#file_url').val();
        form_data.append("file", document.getElementById('doctor_image').files[0]);
       
        let imgType = document.getElementById('doctor_image').files[0]['type'];
        if(imgType != "image/jpeg" && imgType != "image/png"){
                alert("Invalid image type");
                $("#doctor_image").val("");
        }else{
            $.ajax({
                url:"doctor/uplaodImage",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#loader').show();
                },   
                success:function(response) {
                    $('#loader').hide();
                    var img = $('<img id="docImage" width="150" height="150">'); 
                    img.attr('src', imgUrl+'/'+response.doctorImage);
                    img.appendTo('#uploaded_image');
                    $("#uploaded_image").append('<i class="fa fa-times" id="deleteImage"></i>');
                    $("#upl_doctor_image").val(response.doctorImage);  
                }
            }); 
        }
    });
    // Delete Doctor Image
    $(document).on("click", "#deleteImage", function(){
        let doctorImage = $("#upl_doctor_image").val();
        $.ajax({
            method:"POST",
            url: 'doctor/removeImage?image='+ doctorImage,
            success: function(response){
                $("#uploaded_image").remove();
                $("#doctor_image").val("");
            }
        });
    });
})