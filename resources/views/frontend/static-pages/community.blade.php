@extends('frontend.layouts.dashboard_app')
@section('content')
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Community</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Community</li>
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
                Join Our Community on WhatsApp :
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                     <p>Connect with our dynamic community, including your mentors in the destination country, and network with fellow students across the world, and if applicable, those traveling on your trip in your own private Group Trip Community!</p>
                  <p>
                    <ul>
                      <li><b>Benefits:</b> Gain valuable insights, make new friends, receive real-time updates, and learn about your mentors and peers.</li>
                      <li><b>Group Trip (if applicable):</b> Join your specific group trip to know who you're traveling with. Plan excursions, share travel plans, and start bonding even before your journey begins.</li>
                      <li><b>Team Introduction:</b> Get to know your in-country team through group chats, facilitating a smoother transition upon arrival.</li>
                    </ul>
                  </p>
                  <p><b>How to Join:</b> Click the link to enter our WhatsApp group and specific trip groups. Don’t forget to introduce yourself and start engaging!</p>
                 <p>
                  <div><b>Connect on Our Social Media Platforms: </b></div>
                  </p>
                  <p>Broaden your interaction with the Electives Global community on Facebook, Instagram, X (Twitter) and other social media sites. Each platform offers unique ways to connect, share, and learn. Follow us to stay informed about events, share your experiences, and join discussions that broaden your elective journey.</p>

                  <p>By following us, you become part of a supportive network, expanding your connections and insights far beyond your immediate elective experience. </p>

                  <p><b>YouTube:</b> Our social media presence extends to our YouTube channel, where we offer a wealth of valuable information and engaging content. This platform is perfect for deeper engagement with the Electives Global experience, featuring informative videos, student testimonials, and interactive sessions. It's an excellent resource for gaining a more comprehensive understanding of the elective journey, listen in on other students’ experiences, tips for preparation, and insights into various global medical practices. </p>
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