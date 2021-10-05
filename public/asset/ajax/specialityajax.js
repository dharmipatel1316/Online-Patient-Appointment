$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
        }
    });

    // Add Speciality
    $('body').on('click', '#specialityAdd', function () {
        $("#speciality_title").html("Add Speciality");
        $("#speciality_id").val("");
        $('#specialityForm').trigger("reset");
        $("#specialityModal").modal("show");
    });

    // Update Speciality
    $('body').on('click', '#specialityEdit', function (event) {
        $("#speciality_title").html("Edit Speciality");
        var specialityId = $(this).data("id");
        $.get("speciality/" + specialityId + "/edit", function (result) {
            $('#specialityModal').modal('show');
            $("#speciality_id").val(result.id);
            $("#name").val(result.name);
            $("#description").val(result.description);
        });
    });

    // Speciality
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $('#loader').show();
        $.ajax({
            data: $('#specialityForm').serialize(),
            url: "speciality",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if ($.isEmptyObject(response.error)) {
                    $('#success').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#loader').hide();
                    setTimeout(function () {
                        $('#specialityModal').modal('hide');
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

    // delete speciality
    $(document).on('click', '#specialityDelete', function () {
        var specilityId = $(this).data("id");
        var $ele =  $(this).parent().parent();
       var conf = confirm("Are You sure want to delete !");
       if(conf){
            $.ajax({
                type: "DELETE",
                url: "speciality/" +specilityId,
                success: function (data) {
                    $ele.fadeOut(4000).remove();
                }
            });
       } 
    });

    // Pagination
    $(document).on('click', '.page-item a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var query = $('#searchSpecialty').val();
        var entry = $('#getEntry').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });
    
    // search
    $(document).on('keyup', '#searchSpecialty', function(){
        var query = $('#searchSpecialty').val();
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var page = $('#hidden_page').val();
        var entry = $('#getEntry').val();
        fetch_data(page, sort_type, column_name, query, entry);
    });

    // Sorting
    function clear_icon() {
        $('#id_icon').html('');
        $('#name_icon').html('');
    }
    // entry
    $(document).on('change', '#getEntry', function(){
        var entry = $('#getEntry').val();
        var page = $('#hidden_page').val();
        var sort_type = $('#hidden_sort_type').val();
        var column_name = $('#hidden_column_name').val();
        var query = $('#searchSpecialty').val();
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
        var query = $('#searchSpecialty').val();
        var entry = $('#getEntry').val();
        fetch_data(page, reverse_order, column_name, query, entry);
    });

    function fetch_data(page, sort_type, sort_by, query, entry) {
        $.ajax({
            url: "speciality/fetch_data?page=" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query + "&entry="+ entry,
            success: function (response) {
                $('tbody').html('');
                $('tbody').html(response);
            }
        });
    }
})