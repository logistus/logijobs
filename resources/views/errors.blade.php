@if (count($errors) > 0)
    <div class="ui container error message">
        <i class="close icon"></i>
        <div class="header">Hmmm..</div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
