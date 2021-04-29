@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Keisti Knygos informaciją</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('book.update', $book->id) }}">
                            @csrf @method("PUT")
                            <div class="form-group">
                                <label for="">Knygos pavadinimas: </label>
                                <input type="text" name="title" class="form-control" value="{{ $book->title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Puslapių skaičius: </label>
                                <input type="number" name="pages" class="form-control" value="{{ $book->pages }}">
                            </div>
                            <div class="form-group">
                                <label for="">ISBN kodas: </label>
                                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}">
                            </div>
                            <div class="form-group">
                                <label for="">Aprašymas</label>

                                <textarea id="mce" name="description" rows=10 cols=100 class="form-control"></textarea>

                            </div>
                            <div class="form-group">
                                <label>Autorius: </label>
                                <select name="author_id" id="" class="form-control">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}" @if ($author->id == $book->author_id) selected="selected" @endif>
                                            {{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Pakeisti</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
