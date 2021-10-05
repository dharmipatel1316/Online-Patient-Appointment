@include('header')
<div class="col-sm-12 col-md-8 col-lg-10 content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header pt-3 pb-3">
                        <div class="col-lg-3 col-sm-12 pull-left">
                            <button type="button" id="doctorScheduleAdd" class="btn btn-info"><i class="fa fa-plus-square text-white"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="float-start p-3">
                            <select class="form-control" id="getEntry">
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        <div class="float-end p-3">
                            <input type="text" id="searchDoctorSchedule" class="form-control w-30" placeholder="Search">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th class="sorting" data-sorting_type="desc" data-column_name="firstname" style="cursor: pointer">Doctor Name<span id="firstname_icon" class="p-1" > <i class="fa fa-sort-down"></i></span></th>
                                    <th class="sorting" data-sorting_type="desc" data-column_name="schedule_date" style="cursor: pointer;">Shcedule Date<span id="schedule_date_icon" class="p-1" ><i class="fa fa-sort-down"></i></span></th>
                                    <th class="sorting" data-sorting_type="desc" data-column_name="start_time" style="cursor: pointer;">Start Time<span id="start_time_icon" class="p-1" ><i class="fa fa-sort-down"></i></span></th>
                                    <th class="sorting" data-sorting_type="desc" data-column_name="end_time" style="cursor: pointer;">End Time<span id="end_time_icon" class="p-1" ><i class="fa fa-sort-down"></i></span></th>
                                    <th sclass="sorting" data-sorting_type="desc" data-column_name="consulting_time" style="cursor: pointer;">Consulting Time<span id="consulting_time_icon" class="p-1" ><i class="fa fa-sort-down"></i></span></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            @include('ajaxData/doctorSchedule_ajax')
                            </tbody>
                        </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Doctor Schedule modal -->
    <div class="modal fade" id="doctorScheduleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctor_shcedule_title"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="doctorScheduleForm">
                    <div class="modal-body">
                    <input type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">                      
                    <div class="mb-3">
                        <label for="Doctor" class="form-label">Doctor</label>
                        <select name="doctor_id" class="form-control" id="doctor_id">
                            <option value="">Select Doctor</option>
                        </select>
                        <span class="text-danger error-text doctor_id_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="schedule date" class="form-label">Schedule Date</label>  
                        <input type="date" name="schedule_date" id="schedule_date" class="form-control" />
                        <span class="text-danger error-text schedule_date_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>  
                        <input type="time" name="start_time" id="start_time" class="form-control">
                        <span class="text-danger error-text start_time_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>  
                        <input type="time" name="end_time" id="end_time" class="form-control" />
                        <span class="text-danger error-text end_time_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="Doctor" class="form-label">Average Consuting Time</label>
                        <select name="consulting_time" class="form-control" id="consulting_time">
                            <option value="">Consulting Time</option>
                            <?php $a=5; ?>
                            @for ($i = $a; $i <= 18; $i++)
                                <option value="{{ $a }}">{{ $a }} Minute</option>
                              <?php $a+=5; ?>
                            @endfor                    
                        </select>
                        <span class="text-danger error-text consulting_time_error"></span>
                    </div>
                        <div id="success"></div>                        
                    </div>
                    <div class="modal-footer">
                        <img style="display:none;" src="{{ asset('asset/images/loader.gif') }}" id="loader" />
                        <input type="hidden" name="doctor_schedule_id" id="doctor_schedule_id"  />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    </div>

    @include('footer')
    <script src="{{ asset('asset/ajax/scheduleajax.js') }}"> </script>