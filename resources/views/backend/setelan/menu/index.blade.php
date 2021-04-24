@extends('.backend.layout.app')

@section('title','Menu')

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
          <th>Nama Menu</th>
          <th>Icon</th>
          <th>Link</th>
          <th>Letak</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td>{{($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
          <td>{{$d->nama_menu}}</td>
          <td><i class="{{$d->icon}}"></i></td>
          <td>{{$d->link}}</td>
          <td>
            @switch($d->letak)
                @case(1)
                    Sidebar
                    @break

                @case(2)
                    Navbar
                    @break

                @default
                    Setting Bar
            @endswitch          
          </td>
          <td class="d-flex">
              <!-- Tombol Edit -->
              <a href=# class="mr-5 text-success btn btn-circle edit-modal" data-id="{{$d->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
              
              <!-- Tombol Hapus -->
              <form action="{{url('setelan/menu/'.$d->id)}}" method="POST">
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
      <form method="POST" action="{{url('setelan/menu')}}">
      @csrf
      <p class="method"></p>
        <div class="modal-body">
          <div class="mb-2">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" name="nama_menu" id="nama_menu">
          </div>

          <div class="mb-2">
            <label for="link" class="form-label">Link Menu</label>
            <input type="text" class="form-control" name="link" id="link">
          </div>

          <div class="mb-2">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" class="form-control" name="icon" id="icon">
          </div>

          <label for="letak" class="form-label">Letak</label>
          <select class="form-select" name="letak" aria-label="Default select example" id="letak">
            <option value="1">Sidebar</option>
            <option value="2">Top Navbar</option>
            <option value="3">Setting Bar</option>
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
      $('form').attr('action', `{{url('setelan/menu')}}`);
      $('#nama_menu').val('');
      $('#icon').val('');
      $('#link').val('');
      $('#letak').val(1);
      $('#exampleModalLabel').html('Tambah Menu');
      $('.simpan').html('Simpan');
      $('.method').html('');
    });
    
    $('.edit-modal').on('click', function(){
      const id = $(this).data('id');
   
      $.ajax({
        type:'GET',
        url:'menu/ajax/'+id,
        success:function(result){
          $('form').attr('action', `{{url('setelan/menu/`+id+`')}}`);
          $('#nama_menu').val(result.nama_menu);
          $('#icon').val(result.icon);
          $('#link').val(result.link);
          $('#letak').val(result.letak);
          $('#exampleModalLabel').html('Edit Menu');
          $('.simpan').html('Update');
          $('.method').html('@method("patch")');
        }
      });
    });
  });
</script>
@endsection