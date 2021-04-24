@extends('.frontend.layout.app')

@section('title','Absensi Rapat')

@section('isi')
  <div class="table-responsive">
    <table class="table table-striped mb-5">
      <tr>
        <td>Kegiatan</td><td>:</td><td>{{$rapat->nama_rapat}}</td>
      </tr>
      <tr>
        <td>Hari / Tgl</td><td>:</td><td>{{$rapat->hari}}</td>
      </tr>  
        <td>Jam</td><td>:</td><td>{{$rapat->jam}}</td>
      </tr>
      <tr>
        <td>Tempat</td><td>:</td><td>{{$rapat->tempat}}</td>
      </tr>
    </table>
  
    @if (session('status'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <table class="table table-hover mb-0">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama / NIP</th>
          <th scope="col">Jabatan</th>
          <th scope="col">Tanda Tangan</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td height="120px" width="5%">{{($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
          <td height="120px" width="40%"><b>{{$d->nama_peserta}}</b></td>
          <td height="120px" width="30%">{{$d->jabatan}}</td>
          <td height="120px" width="25%" class="center">
            @if($d->ttd)
              <img class="img-fluid" src="{{$d->ttd}}" />
            @else
              <a href="#" class="text-primary tombol_sign" data-id="{{$d->id}}" data-nama="{{$d->nama_peserta}}" data-jabatan="{{$d->jabatan}}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-fingerprint fa-2x"></i>
              </a>   
            @endif 
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4"><h1 class="text-center my-10">Tidak ada Data</h1></td>
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
          <h5 class="modal-title" id="exampleModalLabel">Tandatangan Absen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          
        <form method="POST" action="{{url('absen-rapat')}}">
        @csrf
        @method('patch')
        <p class="method"></p>
          <div class="modal-body">
            <div class="mb-2">
              <table class="table table-responsive">
                <tr><td>Nama</td><td>:</td><td class="font-weight-bolder mb-2" id="nama"></td></tr>
                <tr><td>Jabatan</td><td>:</td><td class="mb-2" id="jabatan"></td></tr>
              </table>                
            </div>
            <div class="mb-2">
              <label>Tanda Tangan</label>
              <canvas id="sig" width=400 height=200></canvas>            
              <textarea id="signed" name="signed" style="display: none"></textarea>
            </div>
            <div>
              <button id="clear">Clear</button>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>

  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


  <script type="text/javascript">
  $(document).ready(function(){
    var canvas = document.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas);
   
    $('.tombol_sign').on('click', function(){
      const id = $(this).data('id'),
            nama = $(this).data('nama'),
            jabatan = $(this).data('jabatan');

      $('#nama').html(nama);
      $('#jabatan').html(jabatan);
      $('form').attr('action', `{{url('absen-rapat/`+ id +`')}}`);
      signaturePad.clear();
      $('#signed').val('');
    });
    
    $('#clear').on('click', function(e) {
      e.preventDefault();
      signaturePad.clear();
      $('#signed').val('');
    });

    $('.simpan').on('click', function() {
      $('#signed').val(signaturePad.toDataURL("image/svg+xml"));     
    });
    
  });  
  </script>
@endsection