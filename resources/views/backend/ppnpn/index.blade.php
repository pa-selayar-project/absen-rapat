@extends('.backend.layout.app')

@section('title','Data PPNPN')

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
          <th>Nama PPNPN</th>
          <th>Jabatan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td>{{($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
          <td>{{$d->nama}}</td>
          <td>{{$d->jabatan->jabatan}}</td>
          <td class="d-flex">
            <!-- Tombol Edit -->
            <a href=# class="mr-5 text-success btn btn-circle edit-modal" data-id="{{$d->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
            
            <!-- Tombol Hapus -->
            <form action="{{url('ppnpn/'.$d->id)}}" method="POST">
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah PPNPN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      <form method="POST" action="{{url('ppnpn')}}">
      @csrf
      <p class="method"></p>
        <div class="modal-body">
          <div class="mb-2">
            <label for="nama" class="form-label">Nama PPNPN</label>
            <input type="text" class="form-control" name="nama" id="nama">
          </div>
          
          <div class="mb-2">
            <label for="letak" class="form-label">Jabatan</label>
            <select class="form-select" name="jabatan" aria-label="Default select example" id="jabatan">
              @foreach($jabatan as $j)
                <option value="{{$j->id}}">{{$j->jabatan}}</option>
              @endforeach
            </select>
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
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
   
    $('.tambah').on('click', function(){
      $('form').attr('action', `{{url('ppnpn')}}`);
      $('#nama').val('');
      $('#jabatan').val(19);
      
      $('#exampleModalLabel').html('Tambah PPNPN');
      $('.simpan').html('Simpan');
      $('.method').html('');
    });
    
    $('.edit-modal').on('click', function(){
      const id = $(this).data('id');
   
      $.ajax({
        type:'GET',
        url:'ppnpn/ajax/'+id,
        success:function(result){
          $('form').attr('action', `{{url('ppnpn/`+id+`')}}`);
          $('#nama').val(result.nama);
          $('#jabatan').val(result.id_jabatan);
          $('#exampleModalLabel').html('Edit PPNPN');
          $('.simpan').html('Update');
          $('.method').html('@method("patch")');
        }
      });
    });
  });
</script>
@endsection