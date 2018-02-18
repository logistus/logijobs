<style>
    .ui.form .inline.fields .field > .selection.dropdown, .ui.form .inline.field > .selection.dropdown { width: 100%; }
</style>
<div class="ui container raised grey segment grid">
    <div class="column" style="padding-bottom: 0;">
        <form action="/search_job"
            <div class="ui form">
                <div class="inline fields">
                    <div class="ten wide field" style="/*padding-right: 0px; margin-top: 10px; margin-right: 10px; margin-left: 10px;*/">
                        <input type="text" placeholder="{{ __('commons.search_placeholder') }}">
                    </div>
                    <div class="four wide field" style="/*padding-right: 0; margin-top: 10px; margin-right: 10px; margin-left: 10px;*/">
                        <select multiple="" class="ui search selection multiple dropdown" id="search_city">
                            <option value="">{{ __('commons.city') }} {{ __('commons.select') }}</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="two wide field" style="/*padding-right: 0; margin-top: 10px; margin-right: 10px; margin-left: 10px;*/">
                        <button type="button" class="fluid ui orange button">{{ __('commons.search') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>