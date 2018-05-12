<section class="s-pageheader">

    <header class="header">
        <div class="header__content row">

            <div class="header__logo">
                <a class="logo" href="index.html">
                    <img src="pages/images/logo.svg" alt="Homepage">
                </a>
            </div> <!-- end header__logo -->

            <ul class="header__social">
                <li>
                    <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                </li>
            </ul> <!-- end header__social -->

            <a class="header__search-trigger" href="#0"></a>

            <div class="header__search">

                <form role="search" method="get" class="header__search-form" action="#">
                    <label>
                        <span class="hide-content">Search for:</span>
                        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                    </label>
                    <input type="submit" class="search-submit" value="Search">
                </form>

                <a title="Close Search" class="header__overlay-close">Close</a>

            </div>  <!-- end header__search -->


            <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

            <nav class="header__nav-wrap">

                <h2 class="header__nav-heading h6">Site Navigation</h2>

                <ul class="header__nav" style="font-family: serif;">
                    <li class="current"><a href="trangchu" title="">Home</a></li>
                    <li class="has-children">
                        <a href="#0" title="">Top 100</a>
                        <ul class="sub-menu">
                            <li><a href="category.html">Việt Nam</a></li>
                            <li><a href="category.html">Âu Mỹ</a></li>
                            <li><a href="category.html">Châu Á</a></li>
                            <li><a href="category.html">Cover</a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#0" title="">Thể Loại</a>
                        <ul class="sub-menu">
                            @foreach($theloai as $tl)
                            <li><a href="theloai/{{ $tl->id }}/{{ $tl->tenkhongdau }}.html">{{ $tl->ten }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#0" title="">Ca Sĩ</a>
                        <ul class="sub-menu">
                            @foreach($casi as $cs)
                            <li><a href="casi/{{ $cs->id }}.html">{{ $cs->ten }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#0" title="">VIP</a>
                        <ul class="sub-menu">
                            <li><a href="single-video.html">Mua Vip</a></li>
                            <li><a href="single-audio.html">Giới thiệu Vip</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html" title="">Đăng nhập</a></li>
                    <li><a href="contact.html" title="">Đăng ký</a></li>
                </ul> <!-- end header__nav -->

                <a title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

            </nav> <!-- end header__nav-wrap -->

        </div> <!-- header-content -->
    </header> <!-- header -->

</section>