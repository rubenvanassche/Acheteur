@if (count($errors) > 0 or Illuminate\Support\Facades\Session::get('flash_notification.level') == 'danger')
    <div class="ui error message icon">
        <i class="alarm icon"></i>
        <div class="content">
            <div class="header">
                {{ trans('errors.errors') }}
            </div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @if (Illuminate\Support\Facades\Session::has('flash_notification.message'))
                    <li>{{ Illuminate\Support\Facades\Session::get('flash_notification.message') }}</li>
                @endif
            </ul>
        </div>
    </div>
@endif

@if(Illuminate\Support\Facades\Session::get('flash_notification.level') == 'success')
    <div class="ui success message icon">
        <i class="checkmark icon"></i>
        <div class="content">
            <ul class="list">
                <li>{{ Illuminate\Support\Facades\Session::get('flash_notification.message') }}</li>
            </ul>
        </div>
    </div>
@endif

@if(Illuminate\Support\Facades\Session::get('flash_notification.level') == 'message')
    <div class="ui success message icon">
        <i class="checkmark icon"></i>
        <div class="content">
            <ul class="list">
                <li>{{ Illuminate\Support\Facades\Session::get('flash_notification.message') }}</li>
            </ul>
        </div>
    </div>
@endif