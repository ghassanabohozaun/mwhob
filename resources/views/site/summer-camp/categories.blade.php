<section class=" bg-light py-5">
    <div class=" container">

        <ul class="slider-cat mb-0">

            @foreach($categories as $category)
                <li>
                    <a href="#">
                        <div class="item d-flex align-items-center justify-content-center">
                            <div>
                                <div class="icon"><img src="{!! asset(Storage::url($category->icon)) !!}" alt=""></div>
                                <div class="text">{!! Lang()=='ar'?$category->name_ar:$category->name_en !!}</div>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach

        </ul>


    </div>

</section>
