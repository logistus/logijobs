@if (session()->has("type") && session()->has("message"))
    <div class="ui container {{ session('type') }} message">
        <i class="close icon"></i>   
        {{ session("message") }}
    </div>
@endif