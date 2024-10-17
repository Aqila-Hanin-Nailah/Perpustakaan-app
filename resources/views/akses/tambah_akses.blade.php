@extends('templates.app')

@section('content-dinamis')
    <form action="{{ route('kelola_akses.store') }}" method="POST" class="card p-5">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>
        @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama: </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Role: </label>
            <div class="col-sm-10">
                <select class="form-select" name="role" id="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="Guru" {{ old('role') == "Guru" ? 'selected' : ''}}>Guru</option>
                    <option value="Karyawan" {{ old('role') == "Karyawan" ? 'selected' : ''}}>Karyawan</option>
                    <option value="Siswa" {{ old('role') == "Siswa" ? 'selected' : ''}}>Siswa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
        <label for="activities" class="col-sm-2 col-form-label">Kegiatan: </label>
            <div class="col-sm-10">
                <select class="form-select" name="activities" id="activities">
                    <option selected disabled hidden>Pilih</option>
                    <option value="membaca" {{ old('activities') == "membaca" ? 'selected' : ''}}>membaca</option>
                    <option value="belajar" {{ old('activities') == "belajar" ? 'selected' : ''}}>belajar</option>
                    <option value="meminjam" {{ old('activities') == "meminjam" ? 'selected' : ''}}>meminjam</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
@endsection