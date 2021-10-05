@include('header')
<div class="col-sm-12 col-md-8 col-lg-10 content-wrapper">
<section class="content-header">
      <ol class="breadcrumb m-2">
        <li class="active"><i class="fa fa-user-md"></i> Doctros</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header pt-3 pb-3">
                        <div class="col-lg-11 col-sm-12 pull-left">
                            <h4 class="box-title">Doctor Listing</h4>
                        </div>
                        <div class="col-lg-1 pull-right">
                            <button type="button" class="btn btn-info" id="doctorAdd"><i class="fa fa-plus pr-1 text-white"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-1 pull-left pb-2">
                            <small>entries</small> <select class="form-control" id="getEntry">       
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        <div class="col-lg-8 p-3"></div>
                        <div class="col-lg-3 pull-right pb-2">
                            <input type="text" id="searchDoctor" class="form-control" placeholder="Search">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white">      
                                <th class="sorting w-25">Image</th>         
                                    <th class="sorting" data-sorting_type="desc" data-column_name="firstname" style="cursor: pointer">Firstname<span id="firstname_icon" class="p-1"><i class="fa fa-sort-down"></i></span></th>         
                                    <th class="sorting" data-sorting_type="desc" data-column_name="lastname" style="cursor: pointer">Lastname<span id="lastname_icon" class="p-1"><i class="fa fa-sort-down"></i></span></th>  
                                    <th class="sorting" data-sorting_type="desc" data-column_name="email" style="cursor: pointer">Email<span id="email_icon" class="p-1"><i class="fa fa-sort-down"></i></span></th>                    
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('ajaxData/doctor_ajax')
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

    <!-- Add Doctor Form -->
    <div class="modal fade" id="doctorModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctor_title"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="doctorForm">
                    <div class="modal-body">
                        <input type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="Firstname" class="form-label">Firstname</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Firstname">
                                            <span class="text-danger error-text firstname_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Lastname</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Lastname">
                                            <span class="text-danger error-text lastname_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 passwordLabel">
                                        <div class="mb-3">
                                            <label for="password"  class="form-label">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
                                            <span class="text-danger error-text password_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone">
                                            <span class="text-danger error-text phone_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" name="birth_date" id="birth_date" class="form-control">
                                            <span class="text-danger error-text dob_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="degree" class="form-label">Degree</label>
                                            <input type="text" name="degree" id="degree" class="form-control" placeholder="Enter Degree">
                                            <span class="text-danger error-text degree_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="speciality" class="form-label">Speciality</label>
                                            <select name="speciality_id" class="form-control" id="speciality">
                                                <option>Select Speciality</option>
                                            </select>
                                            <span class="text-danger error-text speciality_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea type="text" name="address" id="address" class="form-control"></textarea>
                                            <span class="text-danger error-text address_error"></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Image</label>
                                            <input type="file" name="doctor_image" class="form-control" id="doctor_image" />
                                            <span class="text-danger error-text doctor_image_error"></span>
                                           <input type="hidden" id="file_url" value="{{ asset('resources/images/doctors/') }}" /> 
                                            <br /> 
                                            <style>
                                            #uploaded_image { position: relative; }
                                            #uploaded_image img { display: block; }
                                            #uploaded_image .fa-times { position: absolute; top:0; left:0; font-size: 1.5rem; color:red;}
                                            </style>           
                                            <div id="uploaded_image">
                                                <input type="hidden" name="upl_doctor_image" id="upl_doctor_image" />
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div id="success"></div>   
                        </div>
                        <div class="modal-footer">
                            <img style="display:none;" src="{{ asset('asset/images/loader.gif') }}" id="loader" />
                            <input type="hidden" name="doctor_id" id="doctor_id" />
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="saveBtn" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Doctor details -->
    <!-- <div class="modal fade" id="doctorViewModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="doctor_title">Doctor Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Firstname</label>
                                        <span class="form-control" id="firstnameview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lastname</label>
                                        <span class="form-control" id="lastnameview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <span class="form-control" id="emailview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <span class="form-control" id="phoneview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <span class="form-control" id="birth_dateview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Degree</label>
                                        <span class="form-control" id="degreeview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Speciality</label>
                                        <span class="form-control" id="specialityview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <span class="form-control" id="addressview"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <style>
                                        #uploaded_image { position: relative; }
                                        #uploaded_image img { display: block; }
                                        #uploaded_image .fa-times { position: absolute; top:0; left:0; font-size: 1.5rem; color:red;}
                                        </style>           
                                        <div id="uploaded_image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>          
                </div>          
            </div>
        </div>
    </div> -->
</div>

@include('footer')
<script src="{{ asset('asset/ajax/doctorajax.js') }}"> </script>
