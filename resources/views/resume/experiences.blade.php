@if (count($experiences) > 0)
    <div class="ui celled very relaxed list">
        @foreach($experiences as $experience)
            <div class="item">
                <div class="right floated content">
                    <a href="#" name="edit-experience" id="{{ $experience->id }}">{{ __('commons.edit') }}</a> -
                    <a href="#" name="delete-experience" id="{{ $experience->id }}">{{ __('commons.delete') }}</a>
                </div>
                <div class="middle aligned content" style="line-height: 1.7em !important;">
                    <div class="header">{{ $experience->job_title }}</div>
                    <div>{{ $experience->company_name }} | {{ $experience->start_date }} -
                        {{ $experience->still_working ? __('commons.still_working') : $experience->end_date }}
                    </div>
                    <div>
                        {{ $experience->getCity($experience->city_id) }}, {{ $experience->getCountry($experience->country_id) }} |
                        {{ $experience->getWorkType($experience->work_type) }}
                    </div>
                    @if($experience->job_description)
                        <div style="color: #999999;">{{ $experience->job_description }}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="ui message">{{ __('commons.no_experience') }}</div>
@endif