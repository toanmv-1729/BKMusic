@extends('pages.layouts.index2')

@section('content')
<section class="s-content">

	<article class="row format-gallery">
		<div class="s-content__header col-full">
			<h1 class="s-content__header-title">
				A Music Platform
			</h1>
			<ul class="s-content__header-meta">
				<li class="date">May 14, 2018</li>
				<li class="cat">
					By
					<a href="#0">ToanMV</a>
					<a href="#0">CaoMH</a>
					<a href="#0">HoanPV</a>
				</li>
			</ul>
		</div> <!-- end s-content__header -->

		<div class="s-content__media col-full">
			<div class="s-content__slider slider">
				<div class="slider__slides">
					<div class="slider__slide">
						<img src="pages/images/thumbs/single/gallery/single-gallery-01-1000.jpg" 
						srcset="pages/images/thumbs/single/gallery/single-gallery-01-2000.jpg 2000w, 
						pages/images/thumbs/single/gallery/single-gallery-01-1000.jpg 1000w, 
						pages/images/thumbs/single/gallery/single-gallery-01-500.jpg 500w" 
						sizes="(max-width: 2000px) 100vw, 2000px" alt="" >
					</div>
					<div class="slider__slide">
						<img src="pages/images/thumbs/single/gallery/single-gallery-02-1000.jpg" 
						srcset="pages/images/thumbs/single/gallery/single-gallery-02-2000.jpg 2000w, 
						pages/images/thumbs/single/gallery/single-gallery-02-1000.jpg 1000w, 
						pages/images/thumbs/single/gallery/single-gallery-02-500.jpg 500w" 
						sizes="(max-width: 2000px) 100vw, 2000px" alt="" >
					</div>
					<div class="slider__slide">
						<img src="pages/images/thumbs/single/gallery/single-gallery-03-1000.jpg" 
						srcset="pages/images/thumbs/single/gallery/single-gallery-03-2000.jpg 2000w, 
						pages/images/thumbs/single/gallery/single-gallery-03-1000.jpg 1000w, 
						pages/images/thumbs/single/gallery/single-gallery-03-500.jpg 500w" 
						sizes="(max-width: 2000px) 100vw, 2000px" alt="" >
					</div>
				</div>
			</div>
		</div> <!-- end s-content__media -->
	</article>

</section>
@endsection