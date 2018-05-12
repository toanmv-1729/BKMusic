@extends('pages.layouts.index')

@section('content')
<section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    {{ $casi->ten }}
                </h1>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <img src="upload/casi/{{ $casi->urlanh }}" 
                         srcset="upload/casi/{{ $casi->urlanh }} 2000w, 
                                 upload/casi/{{ $casi->urlanh }} 1000w, 
                                 upload/casi/{{ $casi->urlanh }} 500w" 
                         sizes="(max-width: 2000px) 100vw, 2000px" alt="" >
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <p class="lead">{!! $casi->thongtin !!}</p>

                <div class="row block-1-2 block-tab-full">
                    @foreach($baihat as $bh)
                    <div class="col-block">
                        <h3 class="quarter-top-margin"><a href="baihat/{{ $bh['id'] }}.html">{{ $bh->ten }}</a></h3>
                        <p>Lượt nghe: {{ $bh->luotnghe }}</p>
                        <p>Lượt tải: {{ $bh->luottai }}</p>
                        <a onclick="myFunction({{$bh->id}})" href="/downloadBaiHat/{{$bh->id}}/{{$bh->urlthuong}}" class="btn btn-general btn-white" style="padding: 5px;"><i class="fa fa-download"></i> Download</a>
                    </div>
                    @endforeach

                    <div style="text-align: center;">
                    	{{ $baihat->links() }}
                    </div>
                </div>


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section>
@endsection

{{-- @if(!Auth::user()) --}}
   {{--  @section('script')
        <script>
            function myFunction(id){
                alert('Bạn cần phải đăng nhập để có thể Download tài liệu');
            }
        </script>
    @endsection
    @else --}}
    @section('script')
        <script>
            function myFunction(id){
                var $tmp = Number($('.number'+ id).text()) + 1;
                $('.number' + id + ':first').html(" " + $tmp);
              }
        </script>
    @endsection
{{-- @endif --}}