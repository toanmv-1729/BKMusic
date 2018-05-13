@extends('pages.layouts.index')

@section('content')
<section class="s-content">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1>Danh Sách Ca Sĩ</h1>
            </div>
        </div>
        
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                @foreach($casi as $cs)
                <article class="masonry__brick entry format-standard" data-aos="fade-up">
                        
                    <div class="entry__thumb">
                        <a href="casi/{{ $cs['id'] }}.html" class="entry__thumb-link">
                            <img src="upload/casi/{{ $cs->urlanh }}" 
                                 srcset="upload/casi/{{ $cs->urlanh }} 1x, upload/casi/{{ $cs->urlanh }} 2x" alt="">
                        </a>
                    </div>
    
                    <div class="entry__text">
                        <div class="entry__header">
                            <h1 class="entry__title"><a href="casi/{{ $cs['id'] }}.html">{{ $cs->ten }}</a></h1>
                            
                        </div>
                        <div class="entry__excerpt">
                            <p>
                                {!! cutstring($cs->thongtin , 200) !!}
                            </p>
                        </div>
                        <div class="entry__meta">
                            <span class="entry__meta-links">
                                <a href="casi/{{ $cs['id'] }}.html">Xem thêm</a> 
                            </span>
                        </div>
                    </div>
                
                </article> <!-- end article -->
                @endforeach
            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->
        
        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                        <li>{{ $casi->links() }}</li>
                    </ul>
                </nav>
            </div>
        </div>

    </section>
@endsection