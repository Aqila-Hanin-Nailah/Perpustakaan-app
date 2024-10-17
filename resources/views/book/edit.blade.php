@extends('templates.app')

@section('content-dinamis')
    <form action="{{ route('data_buku.ubah.proses', $book['id'])}}" method="post" class="card p-5">
        @csrf
        @method('PATCH')
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="mb-3 row">
        <label for="no_buku" class="col-sm-2 col-form-label">No Buku: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="name" name="name" value="{{ $book['no_buku'] }}">
        </div>
    </div> 
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Buku: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $book['name'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Tipe Buku: </label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disabled hidden>Pilih</option>
                <option value="Novel" {{ $book['type'] == "Novel" ? 'selected' : ''}}>Novel</option>
                <option value="Komik" {{ $book['type'] == "Komik" ? 'selected' : ''}}>Komik</option>
                <option value="Ensiklopedia" {{ $book['type'] == "Ensiklopedia" ? 'selected' : ''}}>Ensiklopedia</option>
                <option value="Biografi" {{ $book['type'] == "Biografi" ? 'selected' : ''}}>Biografi</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="genre" class="col-sm-2 col-form-label">Genre Buku: </label>
        <div class="col-sm-10">
            <select class="form-select" name="genre" id="genre">
                <option selected disabled hidden>Pilih</option>
                <option value="Romantis" {{ $book['genre'] == "Romantis" ? 'selected' : ''}}>Romantis</option>
                <option value="Sci-fi" {{ $book['genre'] == "Sci-fi" ? 'selected' : ''}}>Sci-fi</option>
                <option value="Puisi" {{ $book['genre']  == "Puisi" ? 'selected' : ''}}>Puisi</option>
                <option value="Fiksi" {{ $book['genre']  == "Fiksi" ? 'selected' : ''}}>Fiksi</option>
                <option value="Non-fiksi" {{ $book['genre']  == "Non-fiksi" ? 'selected' : ''}}>Non-fiksi</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
@endsection