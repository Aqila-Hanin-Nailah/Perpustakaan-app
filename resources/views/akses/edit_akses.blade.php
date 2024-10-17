@extends('templates.app')

@section('content-dinamis')
    <form action="{{ route('kelola_akses.ubah.proses', $user['id'])}}" method="post" class="card p-5">
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
            <label for="name" class="col sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $user['name']}}">
            </div>
        </div>
        <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Role: </label>
            <div class="col-sm-10">
                <select class="form-select" name="role" id="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="Guru" {{ $user['role'] == "Guru" ? 'selected' : ''}}>Guru</option>
                    <option value="Karyawan" {{ $user['role'] == "Karyawan" ? 'selected' : ''}}>Karyawan</option>
                    <option value="Siswa" {{ $user['role'] == "Siswa" ? 'selected' : ''}}>Siswa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
        <label for="activities" class="col-sm-2 col-form-label">Kegiatan: </label>
            <div class="col-sm-10">
                <select class="form-select" name="activities" id="activities">
                    <option selected disabled hidden>Pilih</option>
                    <option value="Membaca" {{ $user['activities'] == "Membaca" ? 'selected' : ''}}>Membaca</option>
                    <option value="Belajar" {{ $user['activities'] == "Belajar" ? 'selected' : ''}}>Belajar</option>
                    <option value="Meminjam" {{ $user['activities'] == "Meminjam" ? 'selected' : ''}}>Meminjam</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
@endsection