<footer style="display:none;">
    <div class="footer-nav">
        <div class="container">
            <nav class="navbar footer-navi navbar-left">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('about_index') }}">About Us</a></li>
                    <li><a href="{{route('profile_index')}}">Profile</a></li>
                    <!--<li><a href="#">Transaction</a></li>-->
                    <li><a href="{{route('notes_index')}}">Notes</a></li>
                </ul>
            </nav>


            <div class="social-icons pull-right">
                <a href="https://www.facebook.com/Jumpnotesinc/"><i class="fa fa-facebook-square fa-3x social"></i></a>
                <a href="https://twitter.com/jumpnotes"><i class="fa fa-twitter-square fa-3x social"></i></a>
                <a href="http://instagram.com/jumpnotes"><i class="fa fa-instagram fa-3x social"></i></a>
            </div>


        </div>

    </div>


    <div class="copyright">
        <div class="container">

            <div class="pull-left right-rev">
                <p>All rights Reserved © 2017 Learning</p>
            </div>
            <div class="pull-right design-deve">
                <p>Designed & Developed by <a href="startupbug.net">Startupbug.net</a></p>
            </div>
        </div>


    </div>
</footer>
<!-- FOOTER BLOCK -->
<style>
.footer-logo{ padding-left:0;}
.footer-logo a.logo img{ margin-bottom:20px; width:80%;}
.footer-logo p{ color:#fff; float:left; font-family:Montserrat; text-align:justify;}
.footer-navigation li{ float:left; display:block; width:100%;}
.footer-menu{padding:0 0 0 35px;}
.footer-menu h2{ margin-top:10px; color:#1f7f9f; margin-bottom:50px; font-size:26px;}
footer .footer-menu .footer-navi ul li a{ margin-left:-5px; margin-top:0; margin-bottom:0; padding:5px 25px 5px 5px;}
</style>
<footer>
<div class="footer-nav">
<div class="container">
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 footer-logo">
    <a class="navbar-brand logo" href="{{route('home')}}"><img src="{{asset('/public/dynamic_assets/1495873280-j_logo.png')}}" alt=""/></a>
    <p>Jumpnotes (Patent Pending Technology and Platform) is a unique tutoring and note-sharing platform that allows students to learn and recieve commpensation for sharing thier study notes with others. All uploading, organizing and sharing of study notes is free.</p>
    </div>
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 footer-menu">
    	<nav class="navbar footer-navi navbar-left">
        <h2>Quick Links</h2>
    <ul class="nav navbar-nav footer-navigation">
        <li><a href="{{ route('about_index') }}">About Us</a></li>
        <li><a href="{{route('profile_index')}}">Profile</a></li>
        <!--<li><a href="#">Transaction</a></li>-->
        <li><a href="{{route('notes_index')}}">Notes</a></li>
    </ul>
</nav>
    </div>
    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 footer-menu">
    <nav class="navbar footer-navi navbar-left">
        <h2>Help</h2>
    <ul class="nav navbar-nav footer-navigation">
        <li><a href="{{route('faq_index')}}">FAQ</a></li>
        <li><a href="{{route('terms')}}">Terms of Service</a></li>
		<li><a href="{{route('privacy')}}">Privacy Policy</a></li>
		<li><a href="{{route('contact')}}">Contact Us</a></li>
    </ul>
</nav>
    </div>
    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 footer-menu">
    <h2>Social Links</h2>
    <div class="social-icons">
     <a href="https://www.facebook.com/Jumpnotesinc/"><i class="fa fa-facebook-square fa-3x social"></i></a>
                <a href="https://twitter.com/jumpnotes"><i class="fa fa-twitter-square fa-3x social"></i></a>
                <a href="http://instagram.com/jumpnotes"><i class="fa fa-instagram fa-3x social"></i></a>


</div>
    </div>

</div>
</div>


<div class="copyright">
<div class="container">

<div class="pull-left right-rev">
<p>All rights Reserved © 2017 Learning</p>
</div>
<div class="pull-right design-deve">
<p>Designed & Developed by <a href="startupbug.net">Startupbug.net</a></p>
</div>
</div>

</div>
</footer>
<script>
(function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:475015,hjsv:5};
a=o.getElementsByTagName('head')[0];
r=o.createElement('script');r.async=1;
r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
a.appendChild(r); })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

</script>
<script type="text/javascript">

$(window).on("load", function() {
	$('table.schedule-table tr td input').each(function(){
    //if statement here 
    // use $(this) to reference the current div in the loop
    //you can try something like...


var stat= $(this).data("stat");	
	//console.log(stat);
	if(stat==0){
		$(this).parent().find("div").addClass("red");
	}else if(stat==1){
		$(this).parent().find("div").addClass("green");
	}
	


 });
	
	
	
	
});

$(document).ready(function(){

	
(function($) {
   $.fn.clickToggle = function(func1, func2) {
       var funcs = [func1, func2];
       this.data('toggleclicked', 0);
       this.click(function() {
           var data = $(this).data();
           var tc = data.toggleclicked;
           $.proxy(funcs[tc], this)();
           data.toggleclicked = (tc + 1) % 2;
       });
       return this;
   };
}(jQuery));



/*$('table.schedule-table tr td div').clickToggle(function() {
   var id= $(this).parent().find("input").data("id");   
$(this).parent().find("input").attr("value",id+",0");
if($("input").attr("value",id+",1"))
{
$(this).addClass("green");
$(this).removeClass("red");
console.log("one");
}
else
{
	$(this).addClass("red");
$(this).removeClass("green");
console.log("two");
}




}, function() {
   var id= $(this).parent().find("input").data("id");
$(this).parent().find("input").attr("value",id+",1");
if($("input").attr("value",id+",0"))
{
$(this).addClass("red");
$(this).removeClass("green");
console.log("three");	
}
else
{
$(this).addClass("green");
$(this).removeClass("red");	
console.log("four");
}


});*/ 
});
</script>
<script type="text/javascript">
$('table.tutor tr td div').click(function() {
  var id= $(this).parent().find("input").data("id");
  var state = $(this).parent().find("input").data("state");
  var status = state == 0 ? 1 : 0;
  var clas = state == 0 ? 'green' : 'red';
  $(this).parent().find("input").attr('value', id +','+status);
  $(this).parent().find("input").data("state", status);
  $(this).removeClass('red');
  $(this).removeClass('green');
  $(this).addClass(clas);
  //alert($(this).parent().find("input").val());
});

$('table.student tr td div.sch').click(function() {
  var id= $(this).parent().find("input").data("id");
  var state = $(this).parent().find("input").data("state");
  var status = state == 1 ? 2 : 1;
  var clas = state == 1 ? 'blue' : 'green';
  $(this).parent().find("input").attr('value', id +','+status);
  $(this).parent().find("input").data("state", status);
  $(this).removeClass('blue');
  $(this).removeClass('green');
  $(this).addClass(clas);
  
  //alert($(this).parent().find("input").val());
});

$('[data-toggle="tooltip"]').tooltip();

</script>
<script type="text/javascript">
$('#menu2').hide();
$('#menu2button').click(function()
{
	$('#menu2').show();
	$('#menu3').hide();
}
);
$('#menu1button').click(function()
{
	$('#menu2').hide();
	$('#menu3').show();
}
);
$('#home').click(function()
{
	$('#menu2').hide();
	$('#menu3').show();
}
);
$('#submitclickfunction').hide();
$('#submitclick').click(function()
{
	$('#submitclickfunction').show();
}
);
</script>

<style type="text/css">
.red{background:red;}
.green{background:green ;}
.blue{background: #1f7f9f;}
.without-bg{background:transparent; border:0 none; width:100px; visibility:hidden; height:20px;}
.table.schedule-table>tbody>tr>td{padding:1px !important; line-height: 20px; height: 20px; padding-top: 0 !important;}
table.table.schedule-table{width:60%; margin:auto;}
.set-schedule{margin:auto auto 3% auto; width:60%;}
.set-schedule input[type="date"]{float:left; width:33%; margin-right:1%;}
.set-schedule input[type="submit"]{width:32%;}
.schedule-list{float:left; width:100%;}
button.stripe-button-el{background-image:none;margin-right:10px; padding:5px 12px; background: #c8e9f7; box-shadow: 0 0 0; border: 0 none;}
#std_subscription{float:left;}
button.stripe-button-el span{ line-height:28px; padding:0 0; color: #7b7b7b; font-size:13px; background: #c8e9f7; border: 0 none; box-shadow: 0 0 0; text-transform: uppercase; font-weight: 400; font-family: Montserrat;}
button.stripe-button-el:hover, button.stripe-button-el:hover span{background: #7b7b7b; color: #fff;}
button.stripe-button-el span:hover{background: #7b7b7b; color: #fff;}
.payment-form{width:100%; float:left; margin-bottom:20px;}
.payment-form input[type="button"]{background: #c8e9f7;
    border: 0 none;
    text-transform: uppercase;
    color: #7b7b7b;
    border-radius: 4px;
}
.payment-form input[type="text"]{min-height:40px;}
.payment-form input[type="button"]:hover{
color: rgb(255, 255, 255);
    background: rgb(123, 123, 123);
	}
	.scheduler-ids{width:60%; margin:10px auto 20px auto;}
	.save-button{text-align:center; margin-bottom:20px;}
</style>

<script src="{{asset('/public/js/fullcalendar.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- toastr JS -->
<script type="text/javascript" src="{{asset('/public/js/schedule.js')}}"></script>

</body>
</html>
