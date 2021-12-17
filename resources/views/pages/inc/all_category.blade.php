<div class="hero__categories">
    <div class="hero__categories__all">
        <i class="fa fa-bars"></i>
        <span>All Category</span>
    </div>
    <ul>
        @php
        $categories=App\Category::where('status',1)->latest()->get();
        @endphp
        @foreach ($categories as $cat)
        <li><a href="{{url('category/show/all_items/'.$cat->id)}}">{{$cat->category_name}}</a></li>
    @endforeach
    </ul>
</div>
