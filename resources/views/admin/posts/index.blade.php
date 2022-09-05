@extends('layouts.dashboard')

@section('content')
    <h1>Lista Post</h1>
    
    <div class="row row-cols-3">

        @foreach ($posts as $post)
        <div class="col mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Creato il {{$post->created_at}}</h6>
                    <a href="{{ route('admin.posts.show', ['post' => $post->id])}}" class="card-link">Visualizza</a>
                  </div>
            </div>
        </div>
        @endforeach
        
    </div>
@endsection