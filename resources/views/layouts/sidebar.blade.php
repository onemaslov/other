<div class="menu">
    <div>Menu</div>
    <div class="menu_items">
        <a class="menu_item @if(request()->segment(1) === 'phpinfo') active @endif" href="{{route('phpinfo')}}">
            <span>phpinfo</span>
        </a>
        <a class="menu_item @if(request()->segment(1) === 'vot_tak_bot') active @endif" href="{{route('vot_tak_bot')}}">
            <span>vot_tak_bot</span>
        </a>
    </div>
</div>

<style>
    .menu {

    }
    .menu_items {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }
    .menu_item {
        padding: 10px;
        margin-bottom: 25px;
        border-radius: 10px;
        background: #4188d6;
        box-shadow: rgb(66, 157, 131) 0px 20px 30px -10px;
        border: 2px dotted #4a5568 ;
        text-decoration:none;
        color: inherit;
    }
    .menu_item.active {
        box-shadow: rgb(0, 255, 25) 0px 20px 30px -10px;
        color: #befec3bd;
    }
    .menu_item:hover {
        box-shadow: rgb(0, 255, 25) 0px 20px 30px -10px;
    }
</style>
