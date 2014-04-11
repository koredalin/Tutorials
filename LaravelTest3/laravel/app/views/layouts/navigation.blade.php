<nav>
    <ul>
        <li>
            <a href="{{URL::route('home')}}">Home</a>  <!-- I can use '/' instead. -->
            
            @if (Auth::check())
            
            @else
                <a href="{{URL::route('account-create')}}">Create an account.</a>
            @endif
        </li>
    </ul>
</nav>