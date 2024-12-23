@extends('frontend.layouts.dashboard_app')
@section('content')
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Fund My Elective</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Fund My Elective</li>
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
                Fund My Elective
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <p>Doctors and healthcare professionals are at the helm of Electives Global, and we understand the financial challenges of our healthcare education systems. Our firsthand experiences drive our commitment to providing support and resources to ease the added burden of elective costs for our students. This section of your dashboard is an innovative feature designed to help you financially empower your elective journey.</p>
                  <p>
                    <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Create Your Campaign:</b> Easily set up a personalized fundraising campaign to cover your elective expenses.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Seamless Integration:</b> Funds raised are directly applied to your elective&#39;s payment, integrating smoothly with our payment system.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Reflect on Your Profile:</b> Your campaign will be visible on your profile page, showcasing your initiative to potential supporters.<span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Share and Gather Support:</b> Spread the word about your campaign to friends, family, and networks to gather support.</span></li>
                     <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Access Fundraising Resources:</b> We&#39;ve compiled valuable resources to guide your fundraising efforts. These can be downloaded from the &#39;Important Resources&#39; section, providing you with tips and strategies to effectively raise funds for your elective. These tools are designed to enhance your fundraising skills and maximize your campaign&#39;s success.</span></li>
                    </ul>
                  </p>

                  <?php 
                  $system_documents = ViewsHelper::getSystemDocuments(1);
                  ?>
                  @if(count($system_documents) > 0)
                  <p>

                    <h4>Important Documents and Resources in this section:</h4>
                    <h5>For you:</h5>
                      @foreach($system_documents as $row)
                      <div>{{ $row->document_name }} (<a style="font-weight:600;" target="_blank" href="{{ url($row->document_path) }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a>)</div>
                      @endforeach
                  </p>
                  @endif
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