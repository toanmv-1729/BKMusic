@extends('pages.layouts.index')

@section('content')
<section class="s-content s-content--narrow s-content--no-padding-bottom">
	<article class="row format-standard">
		<div class="col-full s-content__main">
			@foreach($baihat as $bh)
			<div class="s-content__author">
				<img src="upload/baihat/images/{{ $bh->urlanh }}" alt="">

				<div class="s-content__author-about">
					<h4 class="s-content__author-name">
						<a href="baihat/{{ $bh['id'] }}.html">{{ $bh->ten }}</a>
					</h4>

					<span class="popular__author" style="font-family: serif;"><a href="casi/{{ $bh->casi['id'] }}.html">{{ $bh->casi->ten }}</a></span><br>

					
				</div>
			</div>
			@endforeach
		</div> <!-- end s-content__main -->
	</article>
</section>
@endsection