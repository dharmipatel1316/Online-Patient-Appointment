@include('header')
<div class="col-sm-12 col-md-8 col-lg-10 content-wrapper">
  <section class="content-header">
      <ol class="breadcrumb m-2">
        <li class="active"><i class="fa fa-dashboard"></i>Dashboard</li>
      </ol>
    </section>
    <section class="container">
    <div class="row">
        <div class="col-lg-3 col-xs-6 ">
          <div class="small-box bg-info p-3">
            <div class="inner text-white">
              <h3>150</h3>
              <p>Doctors</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="doctor" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-info p-3">
            <div class="inner text-white">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer text-white">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
      </div>
    </section>
</div>

<div class="modal fade" id="profileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profile_title"></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="profileForm">
                <div class="modal-body">
                <input type="hidden" name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">                      
                    <div class="mb-3">
                        <label for="name" class="form-label">Fistname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" />
                        <span class="text-danger error-text firstname_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" />
                        <span class="text-danger error-text lastname_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" >
                        <span class="text-danger error-text firstname_error"></span>
                    </div>
                    <div id="success"></div>                        
                </div>
                <div class="modal-footer">
                    <img style="display:none;" src="{{ asset('resources/images/loader.gif') }}" id="loader" />
                    <input type="hidden" id="user_id" value="{{ Session::get("user_id") }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="saveProfile" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 


<script src="{{ asset('resources/ajax/signinajax.js') }}"> </script>
@include('footer')