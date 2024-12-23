@extends('frontend.layouts.dashboard_app')
@section('content')

<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <!-- <i class="far fa-chart-bar"></i> -->
                Change Password
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form name="gallaryFrm" id="gallaryFrm">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-lg-6 col-lg-offset-3">
                                <label for="attachments"></label>
                                <div class="form-group files">
                                    <input type="file" id="uploadFiles" name="attachments" class="form-control" multiple="">
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated video-progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                 <div class="gallery-isotope grid-5 gutter-small clearfix displayUploadedFileName" data-lightbox="gallery">
                                    @if(isset($data->attachments) && count($data->attachments) > 0 )
                                        @foreach($data->attachments as $file)
                                          <div class="gallery-item documentfileContainer" data-key="{{ $file->attachment }}" >
                                            <div class="thumb">
                                              <img class="img-fullwidth imagefit_cover" src="{{ ViewsHelper::getBlogImage($file)  }}" alt="project">
                                              <div class="overlay-shade"></div>
                                              <div class="icons-holder">
                                                <div class="icons-holder-inner">
                                                  <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                    <a data-lightbox="image" href="{{ ViewsHelper::getBlogImage($file)  }}"><i class="fa fa-plus"></i></a>
                                                    <a href="#"><i class="fa fa-trash removeUploadFile"></i></a>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                   </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection
@section('scripts')
<?php
    $change_password_page = true;
 ?>
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/change-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop