@extends('masterlayout')
@section('content')
   
        <img src="{{asset('/public/dynamic_assets/'.$logo_file[0]) }}" alt=""/>	

        <form id="logo_form" method="post" action="{{ route('logo_post') }}" >
            <br>	
            <input type="file" name="logo_file" id="logo_file"/>
            <br>
            <input type="submit" value="Update Logo" name="submit" />
            <br>
            <img id="LoaderGif" src="{{ asset('public/images/loader.gif') }}" />
            <br>
        </form>
        
<script type="text/javascript">

  $(document).ready(function(e){

	$("#LoaderGif").hide();  	
  	$("#logo_form").submit(function(e){
  		console.log("Logo Form submit");
            e.preventDefault();
	        $("#LoaderGif").show();

            var url = $(this).attr('action');
            var formData = new FormData(this);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: url,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                cache: true,
                success: function( data ) {
                    console.log(data);
	        		$("#LoaderGif").hide();                    
                    toastr.success(data.msg);
                    setTimeout(function(){
                        window.location.href = "{{ route('logo_index') }}";                        
                    }, 1500);
                },
                error:function( data ) {
                	$("#LoaderGif").hide(); 
                    console.log(data.msg);
                    toastr.error(data.msg);
                    /*var errors = data.responseJSON;
                    var errors = data.responseJSON;
                    $("#info_message_error").show();
                    $.each(errors, function( index, value ) {
                        $("input[name='"+ index +"']").css("border-color", 'red');
                        $("."+index).text(value);
                    }); */
                }
            });
  	});
  });


</script>

@endsection


