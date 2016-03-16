@if (count($errors) > 0)
    <div class="ui error message icon">
        <i class="alarm icon"></i>
        <div class="content">
            <div class="header">
                There were some errors with your submission
            </div>
            <ul class="list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif