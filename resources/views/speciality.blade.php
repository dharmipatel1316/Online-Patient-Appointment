@include('header')
<div class="col-sm-12 col-md-8 col-lg-10 content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header pt-3 pb-3">
                        <div class="col-lg-3 col-sm-12 pull-left">
                            <button type="button" id="specialityAdd" class="btn btn-info"><i class="fa fa-plus-square text-white"></i></button>
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
                            <input type="text" id="searchSpecialty" class="form-control w-30" placeholder="Search">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white">
                                    <th width="100px" class="sorting" data-sorting_type="desc" data-column_name="id" style="cursor: pointer;">ID<span id="id_icon" class="p-1" ><i class="fa fa-sort-down"></i></span></th>
                                    <th width="300px" class="sorting" data-sorting_type="desc" data-column_name="name" style="cursor: pointer">Name <span id="name_icon" class="p-1" > <i class="fa fa-sort-down"></i></span></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            @include('ajaxData/speciality_ajax')
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

    <!-- Add Speciality modal -->
    <div class="modal fade" id="specialityModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="speciality_title"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="specialityForm">
                    <div class="modal-body">
                    <input type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">                      
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            <span class="text-danger error-text description_error"></span>
                        </div>
                        <div id="success"></div>                        
                    </div>
                    <div class="modal-footer">
                        <img style="display:none;" src="{{ asset('asset/images/loader.gif') }}" id="loader" />
                        <input type="hidden" name="speciality_id" id="speciality_id"  />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    </div>
   
    @include('footer')
    <script src="{{ asset('asset/ajax/specialityajax.js') }}"> </script>