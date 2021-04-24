@extends('.backend.layout.app')

@section('title','Data Jabatan')

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
          <th>Nama Jabatan</th>
          <th>Tipe Jabatan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td>{{($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
          <td>{{$d->jabatan}}</td>
          <td>
            @switch($d->tipe)
                @case(1)
                    Hakim
                    @break

                @case(2)
                    Pegawai
                    @break

                @default
                    Honorer
            @endswitch          
          </td>
          <td class="d-flex">
              <!-- Tombol Edit -->
              <a href=# class="mr-5 text-success btn btn-circle edit-modal" data-id="{{$d->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
              
              <!-- Tombol Hapus -->
              <form action="{{url('setelan/jabatan/'.$d->id)}}" method="POST">
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      <form method="POST" action="{{url('setelan/jabatan')}}">
      @csrf
      <p class="method"></p>
        <div class="modal-body">
          <div class="mb-2">
            <label for="jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" name="jabatan" id="jabatan">
          </div>

          <label for="letak" class="form-label">Tipe Jabatan</label>
          <select class="form-select" name="tipe" aria-label="Default select example" id="tipe">
            <option value="1">Hakim</option>
            <option value="2">Pegawai</option>
            <option value="3">Honorer</option>
          </select>
        </div>
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

<script type="text/javascript">
  $(document).ready(function(){
   
    $('.tambah').on('click', function(){
      $('form').attr('action', `{{url('setelan/jabatan')}}`);
      $('#jabatan').val('');
      $('#tipe').val(1);
    
      $('#exampleModalLabel').html('Tambah Jabatan');
      $('.simpan').html('Simpan');
      $('.method').html('');
    });
    
    $('.edit-modal').on('click', function(){
      const id = $(this).data('id');
   
      $.ajax({
        type:'GET',
        url:'jabatan/ajax/'+id,
        success:function(result){
          $('form').attr('action', `{{url('setelan/jabatan/`+id+`')}}`);
          $('#jabatan').val(result.jabatan);
          $('#tipe').val(result.tipe);
          
          $('#exampleModalLabel').html('Edit Jabatan');
          $('.simpan').html('Update');
          $('.method').html('@method("patch")');
        }
      });
    });
  });
</script>
@endsection