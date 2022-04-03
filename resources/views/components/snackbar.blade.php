@if (session('status'))
<script>
    "use strict";
    setTimeout(() => {
        Snackbar.show({text: "{{session('status')}}",pos: 'bottom-left'});
    }, 200);
</script>
    {{ Session::forget('status') }}
@endif