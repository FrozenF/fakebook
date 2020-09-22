@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8">
        <a class="btn btn-primary" href="{{Route('posting')}}">Create New Post</a>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8">
          @foreach($post as $p)
            <div class="card">
                <div class="card-header"><h3><b><i class="fa fa-user-circle"></i> <a href="{{route('profile',$p->user->username)}}">{{$p->user->username}}</a></b></h3>
                @if($p->user->id == auth::user()->id)
                    <a href="{{route('update_post',$p->id)}}"><i class="fa fa-edit fa-2x"></i></a>
                    <a href="{{route('delete_post',$p->id)}}"><i class="fa fa-trash fa-2x"></i></a>
                @endif
                </div>
                <div class="card-body">
                    <div id="post-img">
                        @if($p->photo_type == 'photo')
                            <img src="{{asset('uploads/'.$p->photo)}}" style="width:100%;" alt="">
                        @endif
                        @if($p->photo_type == 'video')
                            <video height="240" style="width:100%" controls>
                                <source src="{{asset('uploads/'.$p->photo)}}" type="video/mp4">
                            </video>
                        @endif
                            <span>{{$p->caption}}</span>
                    </div>
                    <div id="action-button">
                      <a href="{{route('do_like',$p->id)}}"><i class="fa fa-heart-o fa-2x"></i></a>
                    </div>
                    <div id="caption-comment">
                      <span><b>
                        @if($p->likes_count==0)
                          Become the First Person Like This Post.
                        @else
                          {{$p->likes_count}} people Like This.
                        @endif
                      </b>
                      </span>
                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_email"></a>
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->
                      <br>
                      <div id="comment_section">
                        @foreach($p->comments as $c)
                            <span><b>{{$c->user->name}}</b> {{$c->comment}}</span><br>
                        @endforeach
                      </div>
                      <hr>
                      <form method="post" action="{{route('post_comment',$p->id)}}">
                        {{csrf_field()}}
                        <input class="form-control" style="border: 0; width:80%;" type="text" name="comment" placeholder="Add a Comment . . ." value="">
                        <input type="submit" value="Post Comment" class="btn btn-primary">
                      </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
