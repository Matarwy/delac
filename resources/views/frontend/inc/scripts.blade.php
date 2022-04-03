<script src="{{ asset('frontend/js/vertical-responsive-menu.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/vendor/OwlCarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/vendor/semantic/semantic.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/night-mode.js') }}"></script>
<script src="{{ asset('frontend/vendor/snackbar/snackbar.min.js')}}"></script>
<script src="{{ asset('frontend/js/OneSignalSDK.js')}}" async></script>

<script>
  "use strict";
  var OneSignal = OneSignal || [];
   
    OneSignal.push(function() {
    OneSignal.init({
    appId: "{{env('APP_ID')}}",
  
    });
   
    });
    OneSignal.push(function() {
    OneSignal.getUserId(function(userId) {
    

var token = "{{ csrf_token() }}";

$.post("/savedevicetoken", {

'_token': token,
'device_token': userId,
});
    
    });
    });
</script>
@stack('scripts')