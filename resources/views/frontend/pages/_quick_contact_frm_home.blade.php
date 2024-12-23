<section id="inquiry-tab" class="divider" data-bg-img="{{ url('public/frontend/assets/images/enquire-form-grey.jpg') }}">
  <div class="container pt-0 pb-0">
    <div class="row">
      <div class="col-md-7">
        <div class="blue_bg_color p-40">
          <h4 class="text-uppercase line-bottom text-white">Inquiry Form</h4>
          <!-- Paypal Both Onetime/Recurring Form Starts -->
          <form id="gblContactSubmitFrm" name="gblContactSubmitFrm" class="form-text-white">
            <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">Full Name <span class="required text-white">*</span></label>
                    <input name="name" id="name" class="form-control" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="email">Email <span class="required text-white">*</span></label>
                    <input name="email" id="email" class="form-control" type="text" placeholder="Enter Email">
                  </div>
                </div>
              </div>
              <div class="row">
                
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="phone_number">Phone <span class="required text-white">*</span></label>
                    <input name="phone_number" id="phone_number" class="form-control" type="text" placeholder="Enter Phone">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="institution">Institution <span class="required text-white">*</span></label>
                    <input name="institution" id="institution" class="form-control" type="text" placeholder="Institution">
                  </div>
                </div>								<div class="col-sm-12">                  <div class="form-group">                    <label for="subject">Subject <span class="required text-white">*</span></label>                    <input name="subject" id="subject" class="form-control" type="text" placeholder="Enter Subject">                  </div>                </div>

                <!--<div class="col-sm-6">
                  <div class="form-group">
                    <label for="program">Program <span class="required text-white">*</span></label>
                    {!! Form::select('program', ['' => 'Please Select'] + ViewsHelper::getProgramsList(), null, ['id' => 'program', 'class' => 'form-control']) !!}
                  </div>
                </div>-->
              </div>
              <div class="row">
                <div class="col-sm-12 form-group">
                  <label for="message">Message <span class="required text-white">*</span></label>
                  <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter Message"></textarea>
                </div>
                <div class="col-sm-12">
                  <div class="form-group mb-20">
                    <button type="submit" class="btn btn-flat btn-dark mt-10 pl-30 pr-30 quick-link-btn-hover" data-loading-text="Please wait...">Contact Us</button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
