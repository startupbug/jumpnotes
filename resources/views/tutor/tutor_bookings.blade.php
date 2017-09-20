@extends('masterlayout')
@section('content')


        <div class="container-fluid text-center trans-text">
            <h3>Student Requests</h3>
        </div>
<div class="container-fluid container responsive-container">
    <div class="col-md-12 min-height table-responsive">
        <table id="tutor_booking">
            <thead>
            <tr>
                <th id="asd" class="sorting_asc1">Student Name</th>
                <th class="sorting_asc">Note</th>
                <th>Per Hour Charges</th>
                <th>Hours to Study</th>
                <th>Payment Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    </div>
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Start Chat</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 thumbnail">
                            <form id="groupForm" method="post" action="{{route('create_group')}}" role="form">
                                <div class="form-group">
                                    <label>Set Chat Name/Identity</label>
                                    <input type="text" name="group_name" class="form-control" required/>
                                    <input type="hidden" name="tutor_id" class="tutor_id"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Submit"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
         <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Reply</h4>

        </div>
        <form id="" method="post" role="form" action="{{route('std_reply')}}">
        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="col-md-6"><b>Subject</b></label>
                    <input type="text" class="form-control col-md-6" id="subject" name="subject" placeholder="Subject">
                </div>
                <div class="form-group col-md-12">
                    <label class="col-md-6"><b>Message</b></label>
                    <textarea class="form-control col-md-6" id="msg" rows="6" name="msg" placeholder="Message"></textarea>
                </div>
                <input id="fname" type="hidden" name="fname"/>
                <input id="email_sender" type="hidden" name="email_sender" value="{{Auth::user()->email}}"/>
                <input id="email" type="hidden" name="email"/>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </div>
        </div>
          <div class="modal-footer">
            <div class="text-center" style="align-content: center">
            <input type="submit" class="btn btn-info tutor_approval" value="Send"/>
            <a class="btn btn-danger delete_tutor" data-dismiss="modal">Cancel</a>
            </div>
          </div>
          </form>
      </div>
    </div>
  </div>
<script>
$(document).ready(function() {
  var url = '{{route('tutorbooking_datatable')}}';
  oTable = $('#tutor_booking').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": url,
      "columns": [{data: 'username', name: 'username'},
          {data: 'note_title', name: 'note_title'},
          {data: 'per_hour_charges', name: 'per_hour_charges'},
          {data: 'hours_study', name: 'hours_study'},
          {data: 'status', name: 'status'},
          {data: 'booking_date', name: 'booking_date'},
          {data: 'action', name: 'action'}
      ]
  });

  $('body').on('click','.sendMsg',function(e){
      e.preventDefault();
      var id = $(this).attr('id');
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });

      {{--url = "{{ route('group_user_check') }}";--}}
      var url = 'group_user_check/' + id; //
      $.ajax({
          url: url,// $("#register_form :input[name!=password2]").serializeArray()
          type: 'get', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
          cache: true,
          success: function( data ) {
          if(data.status == true){
              console.log(data.status);
              window.location.href = "{{route('profile_index')}}";
          }
          else{
              console.log(data.status);
              var tutor_id = data.tutor_id;
              $('.tutor_id').val(tutor_id);
              $('#groupModal').modal('show');
          }
          },
          error:function( data ) {
              console.log(data);
          }

  })
  });
  $('#groupForm').submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var formData = $('#groupForm').serialize();//new FormData(this);
      console.log(formData);
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
      });

      $.ajax({
          url: url,// $("#register_form :input[name!=password2]").serializeArray()
          type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
          data: formData,
          cache: true,
          success: function( data ) {
              console.log(data);
              toastr.success("ChatGroup Successfully Created");
//                    $('#groupForm').modal('hide');
              setTimeout(function(){
                  window.location.href = "{{route('profile_index')}}";
              },1000)
          },
          error:function( data ) {
              console.log(data);
              toastr.error("ChatGroup Couldnot be made");
          }
      });
  })
  $('body').on('click','.sendmail',function(e){
    e.preventDefault();
    var email = $(this).attr('email');
    var username = $(this).attr('username');
    $('#myModal').modal('show');
    $('#email').val(email);
    $('#fname').val(username);
  });
    });
    </script>
@endsection
