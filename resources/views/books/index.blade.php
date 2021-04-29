@extends('layouts.app')
@section('content')

    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif
    <br>
    <div class="card-body">
        <form class="form-inline" action="{{ route('book.index') }}" method="GET">
            <select name="author_id" id="" class="form-control">
                <option value="" selected disabled>Pasirinkite autorių knygų filtravimui:</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @if ($author->id == app('request')->input('author')) selected="selected" @endif>{{ $author->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtruoti</button>
            <a class="btn btn-success" href={{ route('book.index') }}>Rodyti visus</a>
        </form>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <h4 style="color: red">{{ $errors->first() }}</h4>
        @endif


        <table class="table">
            <tr>
                <th>Knygos pavadinimas</th>
                <th>Puslapių skaičius</th>
                <th>ISBN kodas</th>
                <th>Aprašymas</th>
                <th>Autorius</th>
                <th>Veiksmai</th>
            </tr>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->pages }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{!! $book->description !!}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>
                        @if (auth()->check())
                            <form action={{ route('book.destroy', $book->id) }} method="POST">
                                <a class="btn btn-success" href={{ route('book.edit', $book->id) }}>Redaguoti</a>
                                @csrf @method('delete')
                                <input type="submit" class="btn btn-danger" value="Trinti" />

                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </table>
        @if (session('message'))
            <div class="alert alert-success">
                <p style="color: green"><b>{{ session('message') }}</b></p>
            </div>
        @endif
        <div>
            @if (auth()->check())
                <a href="{{ route('book.create') }}" class="btn btn-success">Pridėti</a>
            @endif
        </div>
    </div>
@endsection
