@extends('masterlayout')
@section('content')

     <h1>Update Slider</h1>

		@if(isset($sliders))
		 <?php $i=0; ?>
		   @foreach($sliders as $slider)
		                <img class="img-responsive" src="{{ asset('public/dynamic_assets/'.$slider->image)}}" width="200" height="250">
		                <form class="staticForm" method="post" enctype="multipart/form-data">
		                <br>
		                  <span style="color:red" class="sliderImageText"></span>
		                <input type="text" class="form-control" value="{{ $slider->text}}" name="sliderImageText" id="sliderImageText"/>
		                <br><br>
		                  <span style="color:red" class="sliderImage"></span>
		                <input type="file" name="sliderImage" id="sliderImage" />
		                <br>
		                <input type="hidden" value="{{ $slider->id }}" name="sliderImageId" />
		             <!--  <input type="hidden" value="{{ Session::token() }}" name="_token"/> -->
		                <input type="submit" class="btn btn-success" value="Update"/>
		                <!--<img id="LoaderGif" src="{{ asset('public/img/loader.gif') }}" /> -->
		                </form>
		             <br>
		             <?php  $i++; ?>
		   @endforeach
        @endif

<script type="text/javascript">

   $(".staticForm").on('submit', function(e){
         e.preventDefault();
          $("#LoaderGif").show();
         console.log("Slider Form");
         var base_url = "{{route('slider_post')}}";//$(this).attr('action');;
         var formData = new FormData(this);
         console.log(formData);
         $.ajaxSetup({
             headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
         });
         $.ajax({
               url: base_url,// $("#register_form :input[name!=password2]").serializeArray()
               type: 'post', //$('input[name!=password2]', $("#register_form")).serializeArray() //$("#register_form :input[name!=password2][name!=_token]").serializeArray()
               data: formData, //$("#staticForm").serialize(),
               success: function (data) {
	             $("#LoaderGif").hide();
	              window.location.reload();
	              console.log(data);
	              toastr.success('Image Successfully Updated');               	
	              window.location.reload();               
               },
               error: function (data) {
	              $("#LoaderGif").hide();
	              toastr.error('Image Couldnot be Updated due to Errors');
	              window.location.reload();	                            	
               },
               processData: false,
               contentType: false
           })
   });

</script>        
@endsection