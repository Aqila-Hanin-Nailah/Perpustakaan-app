@extends('templates.app')

@section('content-dinamis')
<div class="container mt-5">
    <div class="d-flex justify-content-end">
        <form action="{{ route('kelola_akses.user.index')}}" class="d-flex me-2" method="get">
            <input type="text" name="cari" placeholder="Cari Nama Buku.." class="form-control me-2">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <a href="{{ route('kelola_akses.tambah')}}" class="btn btn-success">Tambah</a>
    </div>

    @if(Session::get('success'))
        <div class="alert alert-success" id="alert_user">
            {{ Session::get('success')}}
        </div>
    @endif

    <table class="table table-stripped table-bordered mt-3 text-center">
        <thead>
            <th>#</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Kegiatan</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @if (count($Users) < 0 )
                <tr>
                    <td colspan="6">Data User Kosong</td>
                </tr>
            @else
                @foreach ($Users as $index => $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item['name']}}</td>
                        <td>{{ $item['role']}}</td>
                        <td>{{ $item['activities']}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('kelola_akses.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                            <button class="btn btn-danger" onclick="showModalDeleteAccess('{{ $item->id }}', '{{$item->name}}')"> Hapus </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-end my-3">
        {{ $Users->links() }}
    </div>

    <div class="modal fade" id="ModalDeleteAccess" tabindex="-1" aria-labelledby="ModalDeleteAccessLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" class="modal-content" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalDeleteAccessLabel">Hapus Data Akses User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data Akses <b id="nama_Akses_user"></b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal<button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModalDeleteAccess(id, name) {
        $("#nama_Akses_user").text(name);
        let url = "{{ route('kelola_akses.hapus', ':id')}}";
        url = url.replace(':id', id);
        $("form").attr("action", url);
        $("#ModalDeleteAccess").modal('show');
    }
</script>
@endpush