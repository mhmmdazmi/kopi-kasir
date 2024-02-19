<!-- @extends('layout.app')
@section('title', 'karyawan')
@section('content')

 Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Karyawan</h1>
DataTales Example -->
<!-- <div class="card shadow mb-4">
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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormKaryawan">
                Tambah
    </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($karyawan as $karya)
                    <tr class="text-center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $karya->nama }}</td>
                        <td>{{ $karya->email }}</td>
                        <td>{{ $karya->alamat }}</td>
                        <td>{{ $karya->no_telp }}</td>
                        <td>
                            <a href="" class=" btn btn-warning btn-sm"><i class="fas fa-edit"></i> edit</a>
                            <form action="{{ route('karyawan.destroy', $karya) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete " data-id="{{ $karya->id }}"><i class="fas fa-trash"></i> hapus</button< /td>
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
    $('#modalFormKaryawan').on('shown.bs.modal', function() {
        $('#nama_karyawan').delay(1000).focus().select();
    })

    $(function() {
        $('#tbl-karyawan').DataTable()

        // dialog hapus data
        $('.btn-delete').on('click', function(e) {
            let nama_karyawan = $(".karyawan" + $(this).attr('data-id')).text()
            console.log(nama_karyawan)
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: `Apakah data <b> ${nama_karyawan} </b> akan dihapus?`,
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
        $('#modalFormKaryawan ').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const modal = $(this)
            const mode = btn.data('mode')
            const id = btn.data('id')
            const nama_karyawan = btn.data('nama_karyawan')
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nama_karyawan').val(nama_karyawan)
                modal.find('#method').html('@method("PATCH")')
                modal.find('form').attr('action', `{{ url('karyawan') }}/${id}`)
            } else {
                modal.find('.modal-title').text('Form Karyawan')
                modal.find('#nama_karyawan').val('')
                modal.find('#method').html('')
                modal.find('form').attr('action', `{{ url('karyawan') }}/`)
            }
        })
    })
</script>
@endpush --> 

@extends('template.layout')
@push('style')

@endpush
@section('content')
<section class="content">

    <div class="card">
        <div class="card-header">
            
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>

        </div>
     </div>

     <div class="card-body">
     @if(session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{ session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
           </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissble fade show" role="alert">
                  <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }} </li>
                  @endforeach
                  </ul>
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                         <span aria-hidden="true">&times;</span>
                      </button>
          </div>
    @endif

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormKaryawan">
        Tambah Karyawan
    </button>
  


        @include('karyawan.data')
    

  
</section>
@endsection
@include('karyawan.edit')
@include('karyawan.form')



@push('script')
<script>
      $(function(){
            $('#myTable').DataTable()
         })
</script>
       <script>
       
           $('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
           $('.alert-success').slideUp(500)
         })

         $('.alert-danger').fadeTo(2000, 500).slideUp(500, function(){
           $('.alert-danger').slideUp(500)
         })
         </script>
         <script>
   $('.delete-data').on('click', function(e) {
            const nama = $(this).closest('tr').find('td:eq(1)').text();
            console.log('tes')
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: Apakah data <b>${nama}</b> akan di hapus?,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
                'showDenyButton': true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed)
                    $(e.target).closest('form').submit()
                else swal.close()
            })
        })

</script>
         <script>
  $(document).ready(function() {
    
$('#modalEdit').on('show.bs.modal', function(e) {
    let button = $(e.relatedTarget)
    let id = $(button).data('id')
    let nip = $(button).data('nip')
    let nik = $(button).data('nik')
    let nama = $(button).data('nama')
    let jenis_kelamin = $(button).data('jenis_kelamin')
    let tempat_lahir = $(button).data('tempat_lahir')
    let tanggal_lahir = $(button).data('tanggal_lahir')
    let telpon = $(button).data('teldpon')
    let agama = $(button).data('agama')
    let status_nikah = $(button).data('status_nikah')
    let alamat = $(button).data('alamat')
    let foto = $(button).data('foto')
    console.log('nip')


    $(this).find('#nip').val(nip)
    $(this).find('#nik').val(nik)
    $(this).find('#nama').val(nama)
    $(this).find('#jenis_kelamin').val(jenis_kelamin)
    $(this).find('#tempat_lahir').val(tempat_lahir)
    $(this).find('#tanggal_lahir').val(tanggal_lahir)
    $(this).find('#telpon').val(telpon)
    $(this).find('#agama').val(agama)
    $(this).find('#status_nikah').val(status_nikah)
    $(this).find('#alamat').val(alamat)
    $(this).find('#foto').val(foto)

    $('.form-edit').attr('action',` /karyawan/${id}`)
})
  })
  </script>
  <script>
    let table = new DataTable('#myTable');
  </script>
@endpush