$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        }
    });

    // Add Doctor Schedule
    $('body').on('click', '#doctorScheduleAdd', function () {
        $("#doctor_shcedule_title").html("Add Doctor Schedule");
        $("#doctor_schedule_id").val("");
        $('#doctorScheduleForm').trigger("reset");
        $("#doctorScheduleModal").modal("show");
    });

    // Update Doctor Schedule
    $('body').on('click', '#doctorScheduleEdit', function (event) {
        $("#doctor_shcedule_title").html("Edit Doctor Schedule");
        var doctSpecialityId = $(this).data("id");
        $.get("doctorSchedule/" + doctSpecialityId + "/edit", function (result) {
            $('#doctorScheduleModal').modal('show');
            $("#doctor_schedule_id").val(result.id);
            $("#doctor_id option[value="+result.doctor_id+"]").attr('selected', 'selected');
           $("#schedule_date").val(result.schedule_date);
           $("#start_time").val(result.start_time);
           $("#end_time").val(result.end_time);
           $("#consulting_time").val(result.consulting_time);
        });
    });

    // Save Doctor Schedule
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#doctorScheduleForm').serialize(),
            url: "doctorSchedule/save",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#loader').hide();
                    setTimeout(function () {
                        $('#doctorScheduleModal').modal('hide');
                        location.reload();
                    }, 3000);
                } else {
                    $.each(response.error, function (key, value) {
                        if($(key + '_error')){
                            $('.' + key + '_error').text(value);
                            $('#' + key).css("border", "1px solid red");
                       }
                    });
                }
            }
        });
    });

    // delete doctor_schedule
    $(document).on('click', '#doctorScheduleDelete', function () {
        var doctorScheduleId = $(this).data("id");
        var $ele =  $(this).parent().parent();
       var conf = confirm("Are You sure want to delete !");
       if(conf){
            $.ajax({
                type: "DELETE",
                url: "doctorSchedule/delete/" +doctorScheduleId,
                success: function (data) {
                    $ele.fadeOut(4000).remove();
                }
            });
       } 
    });

  // Get Doctors
  $(function(){
    $.ajax({
        url: 'doctorSchedule/doctor',
        dataType: 'json',
        success: function(response){
            var doctors = response.doctors;
            $.each(doctors, function(key, value){
                let option = `<option value="${value.id}">${value.firstname} ${value.lastname}</option>`;
                $("#doctor_id").append(option);
          });
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
        var query = $('#searchDoctorSchedule').val();
        var entry = $('#getEntry').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });
    
    // search
    $(document).on('keyup', '#searchDoctorSchedule', function(){
        var query = $('#searchDoctorSchedule').val();
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
        $('#schedule_date_icon').html('');
        $('#start_time_icon').html('');
        $('#end_time_icon').html('');
        $('#consulting_time_icon').html('');
    }
    // entry
    $(document).on('change', '#getEntry', function(){
        var entry = $('#getEntry').val();
        var page = $('#hidden_page').val();
        var sort_type = $('#hidden_sort_type').val();
        var column_name = $('#hidden_column_name').val();
        var query = $('#searchDoctorSchedule').val();
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
        var query = $('#searchDoctorSchedule').val();
        var entry = $('#getEntry').val();
        fetch_data(page, reverse_order, column_name, query, entry);
    });

    function fetch_data(page, sort_type, sort_by, query, entry) {
        $.ajax({
            url: "doctorSchedule/fetch_data",
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
})