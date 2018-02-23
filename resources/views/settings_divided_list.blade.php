<div class="four wide computer only column">
    <div class="ui vertical stackable fluid menu" style="margin-bottom: 10px;">
        <a href="/settings" {!! Request::is('settings') ? 'class="active item"' : 'class="item"' !!}>{{ __('commons.settings') }}</a>
        <a href="/infos" {!! Request::is('infos') ? 'class="active item"' : 'class="item"' !!}>{{ __('commons.personal_info') }}</a>
        <a href="/resume" {!! Request::is('resume') ? 'class="active item"' : 'class="item"' !!}>{{ __('commons.resumes') }}</a>
        <a href="#" class="item">{{ __('commons.applied_jobs') }}</a>
        <a href="#" class="item">{{ __('commons.saved_searches') }}</a>
        <a href="#" class="item">{{ __('commons.messages') }}</a>
        <a href="#" class="item">{{ __('commons.favorites') }}</a>
    </div>
</div>