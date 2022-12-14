@extends('layouts.dashboard')

@section('content')
    <h1 class="mb-5">Crea un nuovo post</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data"> 
        @csrf

        <div class="mb-5 d-flex flex-column w-50">
            <label for="title" name="title">
                <h4>Titolo</h4>
            </label>
            <input id="title" name="title" type="text" value="{{ old('title') }}">
        </div>

        <div class="mb-5 d-flex flex-column w-50">
            <label for="content" name="content">
                <h4>Contenuto</h4>
            </label>
            <textarea name="content" id="content" cols="30" rows="10" value="{{ old('content') }}"></textarea>
        </div>

        <div class="mb-5 d-flex flex-column w-50">
            <select class="form-select" name="category_id" id="category_id">
                <option value="">Nessuna Categoria</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
            </select>
        </div>

        <div class="mb-5">
            @foreach ($tags as $tag)
                <input type="checkbox" value="{{ $tag->id }}" id="tag-{{$tag->id}}" name="tags[]" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                <label for="tag-{{$tag->id}}">{{$tag->name}}</label>
                <br>
            @endforeach
        </div>

        <div class="mb-5">
            <label for="image" class="form-label">Carica cover:</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>

        <input type="submit" value="Salva Post">
        
    </form>
@endsection