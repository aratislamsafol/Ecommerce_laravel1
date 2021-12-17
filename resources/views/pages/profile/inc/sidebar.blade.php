<div class="col-sm-4">
    <div class="card">
        <ul class="list-group list-group-flush">
            <a href="{{route('home')}}" class="list-group-item btn-primary btn-block"><span>Home</span></a>
            {{-- <li href="" Home</li> --}}
            <a href="{{route('orders')}}" class="list-group-item btn-primary btn-block"><span>My Order</span></a>
            <a class="list-group-item btn-block btn-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>
