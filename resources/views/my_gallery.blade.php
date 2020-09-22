@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          <h2>{{Auth::user()->name}}</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        @foreach($post as $p)
        <div class="col-md-3">
            <img src="{{asset('uploads/'.$p->photo)}}" style="width:100%;" alt="">
        </div>
        @endforeach
    </div>
</div>
@endsection
