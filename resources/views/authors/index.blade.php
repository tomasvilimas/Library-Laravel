@extends('layouts.app')
@section('content')
    <div class="card-body">

        @if (session('status_success'))
            <p style="color: green"><b>{{ session('status_success') }}</b></p>
        @else
            <p style="color: red"><b>{{ session('status_error') }}</b></p>
        @endif
        <br>
        <div class="card-body">
            <form class="form-inline" action="{{ route('author.index') }}" method="GET">
                <select name="id" id="" class="form-control">
                    <option value="" selected disabled>Pasirinkite knygą autorių filtravimui:</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" @if ($book->id == app('request')->input('book')) selected="selected" @endif>{{ $book->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filtruoti</button>
                <a class="btn btn-success" href={{ route('author.index') }}>Rodyti visus</a>
            </form>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <h4 style="color: red">{{ $errors->first() }}</h4>
            @endif
            <table class="table">
                <tr>
                    <th>Autoriaus Vardas</th>
                    <th>Autoriaus Pavardė</th>
                    <th>Veiksmai</th>

                </tr>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->surname }}</td>
                        <td>
                            @if (auth()->check())
                                <form action={{ route('author.destroy', $author->id) }} method="POST">
                                    <a class="btn btn-success" href={{ route('author.edit', $author->id) }}>Redaguoti</a>
                                    @csrf @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Trinti" />
                                </form>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </table>
            <div>
                @if (auth()->check())
                    <a href="{{ route('author.create') }}" class="btn btn-success">Pridėti</a>
                @endif
            </div>
        </div>
    @endsection
