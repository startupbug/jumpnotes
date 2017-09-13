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
<!-- toastr JS -->


</body>
</html>
