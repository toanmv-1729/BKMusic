<section class="s-extra">

    <div class="row top">

        <div class="col-eight md-six tab-full popular">
            <h3>Bài hát</h3>

            <div class="block-1-2 block-m-full popular__posts">
                @foreach($baihat as $bh)
                <article class="col-block popular__post">
                    <a href="#0" class="popular__thumb">
                        <img src="upload/baihat/images/{{ $bh->urlanh }}" alt="">
                    </a>
                    <h5><a href="baihat/{{ $bh['id'] }}.html" style="font-family: serif; font-size: large;">{{ $bh->ten }}</a></h5>
                    <section class="popular__meta">
                        <span class="popular__author"><span>By</span> <a href="casi/{{ $bh->casi['id'] }}.html">{{ $bh->casi->ten }}</a></span><br>
                        <span class="popular__date"><span>On</span> <time datetime="2017-12-19">{{ $bh->created_at }}</time></span>
                    </section>
                </article>
                @endforeach
            </div> <!-- end popular_posts -->
        </div> <!-- end popular -->
        
        <div class="col-four md-six tab-full about">
            <h3>About BKMP3</h3>

            <p>
                Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Pellentesque in ipsum id orci porta dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.
            </p>

            <ul class="about__social">
                <li>
                    <a><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>
            </ul> <!-- end header__social -->
        </div> <!-- end about -->

    </div> <!-- end row -->

    <div class="row bottom tags-wrap">
        <div class="col-full tags">
            <h3>Tags</h3>

            <div class="tagcloud">
                <a href="trangchu">Hust</a>
                <a href="trangchu">Relax</a>
                <a href="trangchu">Music</a>
                <a href="trangchu">BTL</a>
                <a href="trangchu">TKLT Web</a>
                <a href="trangchu">Travel</a>
                <a href="trangchu">Exercise</a>
                <a href="trangchu">Reading</a>
                <a href="trangchu">Running</a>
                <a href="trangchu">Self-Help</a>
                <a href="trangchu">Vacation</a>
            </div> <!-- end tagcloud -->
        </div> <!-- end tags -->
    </div> <!-- end tags-wrap -->

</section>