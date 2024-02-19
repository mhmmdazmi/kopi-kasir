@extends('layout.app')
@section('title', 'kategori')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kategori</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success')}}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span>
            </button>
        </div>
        @endif
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary test" data-toggle="modal" data-target="#modalFormKategori">
                Tambah
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($kategori as $kate)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $kate->nama }}</td>
                            <td>
                                <a href="" class=" btn btn-warning btn-sm"><i class="fas fa-edit"></i> edit</a>
                                <a href="" class=" btn btn-danger btn-sm"><i class="fas fa-trash"></i> hapus</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    <script>
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })
        $('#modalFormKategori').on('shown.bs.modal', function() {
            $('#nama_kategori').delay(1000).focus().select();
        })

        $(function() {
            $('#tbl-kategori').DataTable()

            // dialog hapus data
            $('.btn-delete').on('click', function(e) {
                let nama_kategori = $(".kategori" + $(this).attr('data-id')).text()
                console.log(nama_kategori)
                Swal.fire({
                    icon: 'error',
                    title: 'Hapus Data',
                    html: `Apakah data <b> ${nama_kategori} </b> akan dihapus?`,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    showDenyButton: true,
                    focusConfirm: false
                }).then((result) => {
                    if (result.isConfirmed) $(e.target).closest('form').submit()
                    else swal.close()
                })
            })

            // update or input
            $('#modalFormKategori ').on('show.bs.modal', function(e) {
                const btn = $(e.relatedTarget)
                const modal = $(this)
                const mode = btn.data('mode')
                const id = btn.data('id')
                const nama_kategori = btn.data('nama_kategori')
                if (mode === 'edit') {
                    modal.find('.modal-title').text('Edit Data')
                    modal.find('#nama_kategori').val(nama_kategori)
                    modal.find('#method').html('@method("PATCH")')
                    modal.find('form').attr('action', `{{ url('kategori') }}/${id}`)
                } else {
                    modal.find('.modal-title').text('Form kategori')
                    modal.find('#nama_kategori').val('')
                    modal.find('#method').html('')
                    modal.find('form').attr('action', `{{ url('kategori') }}/`)
                }
            })
        })
    </script>
    @endpush