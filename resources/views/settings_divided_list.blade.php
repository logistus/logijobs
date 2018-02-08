
        <div class="ui secondary pointing fluid red stackable menu">
            <a href="/settings" {!! Request::is('settings') ? 'class="active item"' : 'class="item"' !!}>{{ __('commons.settings') }}</a>
            <a href="/resumes" {!! Request::is('resumes') ? 'class="active item"' : 'class="item"' !!}>{{ __('commons.resumes') }}</a>
            <a href="#" class="item">{{ __('commons.applied_jobs') }}</a>
            <a href="#" class="item">{{ __('commons.saved_searches') }}</a>
            <a href="#" class="item">{{ __('commons.messages') }}</a>
            <a href="#" class="item">{{ __('commons.favorites') }}</a>
        </div>