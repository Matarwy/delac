@if (session('status'))
<div class="alert alert-primary alert-has-icon alert-dismissible show fade">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title"></div>
        {{ session('status') }}
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
</div>
@endif

