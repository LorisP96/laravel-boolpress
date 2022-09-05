@extends('layouts.dashboard')

@section('content')
    <h1>{{$post->title}}</h1>
    <h4>Creato il {{$post->created_at}}</h4>
    <h4>Aggiornato il {{$post->updated_at}}</h4>
    <p>{{$post->content}}</p>
    <a href="#" class="card-link">Modifica</a>
@endsection