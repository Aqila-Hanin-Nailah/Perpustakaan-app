@extends('templates.app')

@section('content-dinamis')
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form action="{{ route('data_buku.data')}}" class="d-flex me-3" method="GET">
                <input type="text" name="cari" placeholder=" Nama Obat..." class="form-control me-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <a href="{{ route('data_buku.tambah')}}" class="btn btn-success d-flex me-3">Tambah Buku</a>
        </div>

        @if(Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>No Buku</th>
                <th>Nama Buku</th>
                <th>Tipe Buku</th>
                <th>Genre</th>
                <th>Stok</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @if (count($books) < 0 )
                    <tr>
                        <td colspan="6">Data Buku Kosong</td>
                    </tr>
                @else
                    @foreach ($books as $index => $item)
                        <tr>
                            <td>{{ $item['no_buku']}}</td>
                            <td>{{ $item['name']}}</td>
                            <td>{{ $item['type']}}</td>
                            <td>{{ $item['genre']}}</td>
                            <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }}" style="cursor: pointer;" onclick="showModalStock({{ $item['id']}}, {{ $item['stock']}})">{{ $item['stock'] }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('data_buku.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger" onclick="showModalDelete('{{ $item->id }}', '{{$item->name}}')"> Hapus </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-end my-3">
            {{ $books->links() }}
        </div>

        <!-- modal delete -->
        <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    <!-- action kosong, diisi melalu js karena id dikirim ke jsnya -->
                    @csrf
                    <!-- menimpa method="POST" jadi DELETE sesuai web.php http-method -->
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalDeleteLabel">Hapus Data Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data Buku <b id="nama_buku"></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal<button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- modal stock -->
        <div class="modal fade" id="ModalEditStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    <!-- action kosong, diisi melalu js karena id dikirim ke jsnya -->
                    @csrf
                    <!-- menimpa method="POST" jadi  sesuai web.php http-method -->
                    @method('PATCH')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Stock Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock : </label>
                            <input type="number" name="stock" id="stock" class="form-control">
                            @if(Session::get('failed'))
                                <small class="text-danger">{{ Session::get('failed' )}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal<button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id, name) {
        $("#nama_buku").text(name);
        let url = "{{ route('data_buku.hapus', ':id')}}";
        url = url.replace(':id', id);
        $("form").attr("action", url);
        $("#ModalDelete").modal('show');
    }

    function showModalStock(id, stock) {
        $("#stock").val(stock);
        let url = "{{ route('data_buku.ubah.stock', ':id')}}";
        url = url.replace(':id', id);
        $("form").attr("action", url);
        $("#ModalEditStock").modal('show');
    }

    
    @if(Session::get('failed'))
    $(document).ready(function() {
        let id = "{{ Session::get('id') }}";
        let stock = "{{ Session::get('stock') }}";
        showModalStock(id, stock);
    })
    @endif

</script>