@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
<div style="background-image: url('img/programming.jpg'); background-size: cover; height: 500px; display: flex; align-items: center; justify-content: center;">
  <form class="ui container">
    <div class="ui form">
      <div class="fields">
        <div class="ten wide field" style="margin-bottom: 10px;">
          <div class="ui left icon input">
            <input type="text" name="keyword" id="keyword" placeholder="{{ __('commons.search_placeholder') }}">
            <i class="search icon"></i>
          </div>
        </div>
        <div class="four wide field" style="margin-bottom: 10px;">
          <select multiple="" class="ui search selection multiple dropdown">
            <option value="">{{ __('commons.select_city') }}</option>
            @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="two wide field" style="margin-bottom: 10px;">
          <button type="button" class="fluid ui red button" style="height: 38.31px">{{ __('commons.search') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section("otherscripts")
<script>
  $('.ui.dropdown').dropdown();
</script>
@endsection
