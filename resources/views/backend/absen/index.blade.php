@extends('.backend.layout.app')

@section('title','Data Absen Rapat')

@section('style')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('isi')
  <!-- Jika terjadi Error -->
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="fa-ul">
        @foreach ($errors->all() as $error)
            <li><span class="fa-il"><i class="fas fa-exclamation-triangle"></i> {{ $error }}</span></li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Jika Sukses -->
  @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Tombol tambah -->
  <div class="m-2">
    <button type="button" class="btn btn-primary float-end tambah" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Tambah
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Rapat</th>
          <th>Hari/Tgl</th>
          <th>Jam</th>
          <th>Tempat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td>{{($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
          <td>{{$d->nama_rapat}}</td>
          <td>{{$d->hari}}</td>
          <td>{{$d->jam}}</td>
          <td>{{$d->tempat}}</td>
          <td class="d-flex">
            <!-- Tombol Edit -->
            <a href=# class="mr-5 text-primary btn btn-circle peserta-modal" data-id="{{$d->id}}" data-bs-toggle="modal" data-bs-target="#pesertaModal"><i class="fas fa-users"></i></a>

            <a href=# class="mr-5 text-success btn btn-circle edit-modal" data-id="{{$d->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
            
            <!-- Tombol Hapus -->
            <form action="{{url('absen/'.$d->id)}}" method="POST">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-circle text-danger">
              <i class="fas fa-trash fa-sm"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6"><h1 class="text-center my-10">Tidak ada Data</h1></td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{ $data->links() }}
@endsection

@section('modal')
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Absen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          
        <form method="POST" action="{{url('absen')}}">
        @csrf
        <p class="method"></p>
          <div class="modal-body">
            <div class="mb-2">
              <label for="nama_rapat" class="form-label">Nama Rapat</label>
              <input type="text" class="form-control" name="nama_rapat" id="nama_rapat">
            </div>
            <div class="mb-2">
              <label for="hari" class="form-label">Hari/Tgl</label>
              <input type="text" class="form-control" name="hari" id="hari">
            </div>
            <div class="mb-2">
              <label for="jam" class="form-label">Jam</label>
              <input type="text" class="form-control" name="jam" id="jam" placeholder="09.00 Wita" >
            </div>
            <div class="mb-2">
              <label for="tempat" class="form-label">tempat</label>
              <input type="text" class="form-control" name="tempat" id="tempat">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary simpan">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <div class="modal fade" id="pesertaModal" tabindex="-1" aria-labelledby="pesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pesertaModalLabel">Masukkan Peserta Rapat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          
        <form class="peserta-form" method="POST" action="{{url('absen-rapat')}}">
        @csrf       
          <div class="modal-body">
            Masukkan Semua Peserta !
            <input type="hidden" class="form-control" name="peserta" id="peserta">           
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary simpan">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
    
      $('.tambah').on('click', function(){
        $('form').attr('action', `{{url('absen')}}`);
        $('#nama_rapat').val('');
        $('#hari').val('');
        $('#jam').val();
        $('#tempat').val();
        $('#exampleModalLabel').html('Tambah Rapat');
        $('.simpan').html('Simpan');
        $('.method').html('');
      });
      
      $('.edit-modal').on('click', function(){
        const id = $(this).data('id');
    
        $.ajax({
          type:'GET',
          url:'absen/ajax/'+id,
          success:function(result){
            $('form').attr('action', `{{url('absen/`+id+`')}}`);
            $('#nama_rapat').val(result.nama_rapat);
            $('#hari').val(result.hari);
            $('#jam').val(result.jam);
            $('#tempat').val(result.tempat);
            $('#exampleModalLabel').html('Edit Rapat');
            $('.simpan').html('Update');
            $('.method').html('@method("patch")');
          }
        });
      });

      $('.peserta-modal').on('click', function(){
        const id = $(this).data('id');
          $('.peserta-form').attr('action', `{{url('absen-rapat')}}`);
          $('#peserta').val(id);
      });
      
      $( function() {
        $( "#hari" ).datepicker({
          dateFormat: "DD, dd MM yy",
          dayNames: [ "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu" ],
          monthNames : ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                        "Juli", "Agustus","September","Oktober","November","Desember"]
        });
      } );
    });
  </script>
@endsection