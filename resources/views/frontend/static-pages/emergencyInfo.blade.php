@extends('frontend.layouts.dashboard_app')
@section('content')

<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Emergency</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Emergency</li>
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
                Emergency
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. <a href="#" class="text-theme-colored-blue">Quas, veniam nobis minima.</a> Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.Cos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem. Amit dolor sit.</p>

                        <div class="row mt-30 mb-30">

                         <div class="col-xs-12">

                          <ul class="mt-10" style="list-style: none;">

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    

                          </ul>

                         </div>

                         

                        </div>

                        <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection