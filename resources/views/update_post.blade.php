@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form enctype="multipart/form-data" method="post" action="{{route('store_update')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label for="photo">Photo / Video</label>
            <input type="file" id="photo" name="photo" placeholder="Example input">
          </div>
          <div class="form-group">
            <label for="caption">Caption</label>
            <textarea class="form-control" id="caption" name="caption" placeholder="Input Caption ..">{{$data->caption}}</textarea>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="" value="Post"></button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
