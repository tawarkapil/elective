@extends('frontend.layouts.dashboard_app')
@section('content')
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Invoice & Payments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Invoice & Payments</li>
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
                Invoice & Payments
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p>In the Invoice and Payments section of your dashboard, managing your financials for your elective becomes straightforward and transparent.</p>
                  <p>
                    <ul>
                      <li><b> Easy Access to Invoices:</b> All your invoices related to the elective program are neatly organized
                      here. You can view and track each payment, ensuring everything is clear and accounted for.</li>
                      <li><b> Payment Schedules and Reminders:</b> Stay on top of your payment deadlines with scheduled
                      reminders.</li>
                      <li><b> Secure Payment Portal:</b> Make payments confidently through our secure portal. Your financial
                      security is our priority.</li>
                      <li><b> Financial Record Keeping:</b> All your payments are recorded and accessible for your reference at
                      any time, providing a comprehensive view of your elective expenses.</li>
                    </ul>
                  </p>
                 <p>
                    This section is designed to give you peace of mind and control over your financial commitments with Electives Global.
                  </p>
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
