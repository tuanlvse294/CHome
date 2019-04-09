@if(Session::has('error'))
    <div class="ui error message fluid container">
        <div class="header">
            {{Session::get('error')}}
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="ui green message fluid container">
        <div class="header">
            {{Session::get('message')}}
        </div>
    </div>

@endif