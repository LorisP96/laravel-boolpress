@extends('layouts.dashboard')

@section('content')
    <h1>{{$post->title}}</h1>
    <h4>Creato il {{$post->created_at->format('j F, Y')}}</h4>
    <h4>Aggiornato il {{$post->updated_at->format('j F, Y')}}</h4>
    @if ($post->category !== null)
    <h4>Categoria: {{$post->category->name}}</h4>
    @else
    <h4>Nessuna Categoria</h4>
    @endif
    <h4> Tags:
        @forelse ($post->tags as $tag)
        {{ $tag->name }}{{ !$loop->last ? ',' : '' }}
        @empty
        nessuno
        @endforelse
    </h4>
        
    
    <p>{{$post->content}}</p>
    <div class="d-flex">
        <a class="btn btn-primary mr-3 px-5" type="button" href="{{ route('admin.posts.edit', ['post' => $post->id])}}" class="card-link">Modifica Post</a>
        
        <form action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="post"> 
        @csrf
        @method('DELETE')
            <input class="btn btn-danger px-5" type="submit" value="Elimina Post" onClick="return confirm('Sicuro di voler concellare il post?')">
        </form>
    </div>
@endsection