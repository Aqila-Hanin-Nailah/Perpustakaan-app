@extends('templates.app')

@section('content-dinamis')
<form action="{{ route('data_buku.tambah.proses') }}" method="post" class="card p-5">
    @csrf
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">No Buku: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="no_buku" name="no_buku" value="{{ old('no_buku') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Buku: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jenis Buku: </label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disabled hidden>Pilih</option>
                <option value="Novel" {{ old('type') == "Novel" ? 'selected' : ''}}>Novel</option>
                <option value="Komik" {{ old('type') == "Komik" ? 'selected' : ''}}>Komik</option>
                <option value="Ensiklopedia" {{ old('type') == "Ensiklopedia" ? 'selected' : ''}}>Ensiklopedia</option>
                <option value="Biografi" {{ old('type') == "Biografi" ? 'selected' : ''}}>Biografi</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="genre" class="col-sm-2 col-form-label">Genre Buku: </label>
        <div class="col-sm-10">
            <select class="form-select" name="genre" id="genre">
                <option selected disabled hidden>Pilih</option>
                <option value="Romantis" {{ old('type') == "Romantis" ? 'selected' : ''}}>Romantis</option>
                <option value="Sci-fi" {{ old('type') == "Sci-fi" ? 'selected' : ''}}>Sci-fi</option>
                <option value="Puisi" {{ old('type') == "Puisi" ? 'selected' : ''}}>Puisi</option>
                <option value="Fiksi" {{ old('type') == "Fiksi" ? 'selected' : ''}}>Fiksi</option>
                <option value="Non-fiksi" {{ old('type') == "Non-fiksi" ? 'selected' : ''}}>Non-fiksi</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="stock" class="col-sm-2 col-form-label">Stock: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="stock" name="stock">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection