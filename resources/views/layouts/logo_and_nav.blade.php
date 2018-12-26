<div class="ui container" style="margin-top: 60px">
    <div class="ui two column stackable grid">
        <a class="column" style="padding-left: 100px" href="/">
            <div class="ui huge header"><span class="store_name">C-Home</span></div>
            <div class="ui small header">Find you home</div>
        </a>
    </div>
    <div class="ui divider"></div>

    @if(Session::has('error'))
        <div class="ui error message">
            <div class="header">
                {{Session::get('error')}}
            </div>
        </div>
        <div class="ui divider"></div>
    @endif
    @if(Session::has('message'))
        <div class="ui green message">
            <div class="header">
                {{Session::get('message')}}
            </div>
        </div>

        <div class="ui divider"></div>
    @endif
</div>