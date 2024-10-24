<div class="side-stick side-panel position-fixed leftItems c-scroll py-4">
    <div class="sidebar position-relative">
        <span class="side-toggler side-top-close d-block d-lg-none"><i class="fa-solid fa-xmark"></i></span>
        <div class="side-item-container">
            <p class="side-item-title mb-2 toggle-menu cursor-pointer d-flex aligin-items-center"><span class="mr-auto">Categories</span></p>
            <hr class="mt-2 mb-2">
            <div class="menu-list">
                <a href="{{ url('/menu') }}" class="menu-list-link  @if(request()->is('menu')) active @endif text-overflow d-flex"><span class="text-overflow">All categories</span> <span class="flex-1"></span></a>
                @foreach($categories as $category)
                    <a href="{{ url('/menu/'.$category->slug) }}" class="menu-list-link  @if(request()->is('menu/'.$category->slug)) active @endif text-overflow d-flex"><span class="text-overflow">{{ $category->name }}</span> <span class="flex-1"></span></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
