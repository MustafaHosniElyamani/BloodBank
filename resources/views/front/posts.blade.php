@extends('front.app')

@section('content')
    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">

                @auth('front')
                    <h2>مقالات</h2>
                @endauth

                @guest('front')
                    <h2>المقالات</h2>
                @endguest




            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->







                    <div class="owl-carousel articles-carousel">
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="...">
                                    <a href="{{ url(route('front.post', $post->id)) }}" class="click">المزيد</a>
                                </div> {{-- {{ url('front/posts/'.$post->id) }} --}}
                                @auth('front')
      <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="far fa-heart bg-{{$post->is_favourite ? 'danger':'secondary'}}
                                      "></i>
@endauth

                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">
                                        {{ $post->content }}
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function toggleFavourite(bg) {
                var post_id=bg.id;
                $.ajax({
                    url: '{{url(route('front.setfav'))}}',
                    type: 'post',
                    data: {_token:"{{csrf_token()}}",post_id:post_id},
                    success : function(data){
                        console.log(data);
                        var currentClass = $(bg).attr('class')
                if (currentClass.includes('secondary')) {
                    $(bg).removeClass('bg-secondary').addClass('bg-danger')

                } else {
                    $(bg).removeClass('bg-danger').addClass('bg-secondary')
                }
                    }
                })

            }
        </script>
    @endpush
@endsection
