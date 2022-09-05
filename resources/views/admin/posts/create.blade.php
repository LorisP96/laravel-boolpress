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

    <form action="{{route('admin.posts.store')}}" method="post">
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

        <input type="submit" value="Salva Post">
        
    </form>
@endsection