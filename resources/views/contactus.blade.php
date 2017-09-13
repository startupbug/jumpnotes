@extends('masterlayout')
@section('content')
<!-- / FAQ  -->


@if(isset($notification))
<script>
toastr.success('{{$notification}}');
</script>
@endif
<div class="container-fluid text-center trans-text">
<h3>Contact Us</h3>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
<!-- / ABOUT TEXT BLOCK -->
<div class="container-fluid meet-with">
<div class="container">
<!-- single category col-lg-3 start -->
                <div class="col-lg-7" id="dd-list">
                    <form id="notes_form" method="post" role="form" action="{{route('contact_post')}}">
                      <div class="row">
                          <div class="form-group note-title col-md-4">
              <h4 class="no-marg-top no-marg-bottom">First Name </h4>
            </div>
                          <div class="form-group note-title col-md-8">
              <span style="color:red" class="note_title"></span>
                              <input type="text" name="f_name" class="form-control" id="f_name" required placeholder="First Name">
                          </div>
          </div>
          <div class="row">
                          <div class="form-group note-title col-md-4">
              <h4 class="no-marg-top no-marg-bottom">Last Name </h4>
            </div>
                          <div class="form-group note-title col-md-8">
              <span style="color:red" class="note_title"></span>
                              <input type="text" name="l_name" required class="form-control" id="l_name" placeholder="Last Name">
                          </div>
          </div>
          <div class="row">
                          <div class="form-group note-title col-md-4">
              <h4 class="no-marg-top no-marg-bottom">Email</h4>
            </div>
                          <div class="form-group note-title col-md-8">
              <span style="color:red" class="note_title"></span>
                              <input type="text" name="email" class="form-control" required id="email" required placeholder="Email">
                              <input type="hidden" name="_token" class="form-control" value="{{ Session::token() }}" placeholder="Email">
                          </div>
          </div>
          <div class="row">
                          <div class="form-group note-title col-md-4">
              <h4 class="no-marg-top no-marg-bottom">Message</h4>
            </div>
                          <div class="form-group note-title col-md-8">
              <span style="color:red" class="note_title"></span>
                              <textarea class="form-control" rows="5" placeholder="Message" required name="message"></textarea>
                          </div>
          </div>
          <div class="row">
                        <div class="form-group notes-detail col-md-6 ">
                              <input type="submit" class="btn btn-primary pull-right" value="submit"/>
                        </div>
          </div>
                  </form>

      </div>

      <div class="col-lg-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26372472.329392266!2d-113.739075458089!3d36.20800122385797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2s!4v1501049956538" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
  </div>
</div>

<!-- FAQ end -->
@endsection
