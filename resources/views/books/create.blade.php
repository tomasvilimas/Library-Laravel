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
                    <div class="card-header">Sukurti naują knygą:</div>
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Knygos pavadinimas: </label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Puslapių skaičius: </label>
                                <input type="number" name="pages" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">ISBN kodas: </label>
                                <input type="text" name="isbn" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Aprašymas: </label>
                                <textarea id="mce" name="description" rows=10 cols=100 class="form-control"></textarea>

                            </div>

                            <div class="form-group">
                                <label>Autorius: </label>
                                <select name="author_id" id="" class="form-control" required>
                                    <option value="" selected disabled>Pasirinkite autorių</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Pridėti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
