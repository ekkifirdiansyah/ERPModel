<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengadaan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/adminLTE/dist/css/adminlte.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('adminLTE/plugins/toastr/toastr.min.css')}}">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      @include('parsial.setting')
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{asset('/adminLTE/index3.html')}}" class="brand-link">
        <img src="{{asset('/adminLTE/dist/img/erp.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mothership.App</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @include('admin.admin')

        <!-- Sidebar Menu -->
        @include('parsial.menu')
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Daftar Pengadaan</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="text-right mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pengadaanModal"><i class="fa fa-plus"></i> Tambah Data</button>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pengadaan</h3>
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap" style="text-align:center">
                    <thead>
                      <tr>
                        <th>Nama Pengadaan</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Anggaran</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($pengadaan as $pg)
                      <tr>
                        <td>{{$pg->nama_pengadaan}}</td>
                        <td>
                          <a target="_blank" href="{{$pg->deskripsi}}">
                            <button class="btn-primary"><i class="fa fa-info-circle"></i> Detail</button>
                          </a>
                        </td>
                        <td style="width:15%;">
                          @if($pg->gambar != "-")
                          <img style="width:70%;" src="{{asset(Storage::url($pg->gambar))}}">
                          <hr>
                          <a class="konfirmasi" href="/hapusGambar/{{$pg->id_pengadaan}}">
                            <div class="d-flex justify-content-center">
                              <button class="btn-danger">
                                <i class="fas fa-trash"></i>
                                Hapus
                              </button>
                            </div>
                          </a>
                            @endif
                            @if($pg->gambar == "-")
                            <hr>
                            <form method="post" action="/uploadGambar" enctype="multipart/form-data">
                            {{csrf_field()}}  
                            <input type="hidden" name="id_pengadaan" id="id_pengadaan" value="{{$pg->id_pengadaan}}">
                              <label for="gambar" class="btn btn-block btn-outline-info btn-flat">Gambar Pengadaan</label>
                              <input type="file" name="gambar" id="gambar" class="form-control" style="display:none">
                              <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                            @endif
                        </td>
                        <td><span class="tag tag-success">{{number_format($pg->anggaran,0,",",".")}}</span></td>
                        <td>
                          <a href="/hapusPengadaan/{{$pg->id_pengadaan}}" class="konfirmasi"><button class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</button></a>
                          <button data-id_pengadaan="{{$pg->id_pengadaan}}" data-nama_pengadaan="{{$pg->nama_pengadaan}}" data-deskripsi="{{$pg->deskripsi}}"
                          data-anggaran="{{$pg->anggaran}}" data-toggle="modal" data-target="#ubahModal" type="button" class="btn btn-secondary ubah"><i class="fas fa-edit"></i>Ubah</button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="d-flex justify-content-center">{{$pengadaan->links()}}</div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    @include('parsial.footer')
    @include('pengadaan.tambah')
    @include('pengadaan.ubah')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('/adminLTE/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('/adminLTE/dist/js/adminlte.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('/adminLTE/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{asset('/adminLTE/plugins/toastr/toastr.min.js')}}"></script>

  <script type="text/javascript">

    function curency(){
      var input = document.getElementById("anggaran");

      $(".labelRp").val(formatRupiah(input.value));

    }

    function curency2(){
      var input = document.getElementById("u_anggaran");

      $(".labelRp").val(formatRupiah(input.value));

    }

    function formatRupiah(angka,prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   = number_string.split(','),
      sisa    = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      @if(\Session::has('berhasil'))
        Toast.fire({
          icon: 'success',
          title: '{{Session::get('berhasil')}}'
        })
      @endif
      @if(\Session::has('gagal'))
        Toast.fire({
          icon: 'error',
          title: '{{Session::get('gagal')}}'
        })
      @endif

      @if(count($errors) > 0)
        Toast.fire({
          icon: 'error',
          title: '<ul>@foreach($errors->all() as $error)<li>{{$error}}</li>@endforeach</ul>'
        })
      @endif

    });

    $(document).on("click", ".konfirmasi", function(event){
      event.preventDefault();
      const url = $(this).attr('href');

      var answer = window.confirm("Apakah kamu yakin ingin menghapus data?");

      if(answer){
        window.location.href = url;
      }else{

      }

    });

    $(document).on("click", ".ubah", function(){

      var nama_pengadaan = $(this).data('nama_pengadaan');
      var deskripsi = $(this).data('deskripsi');
      var anggaran = $(this).data('anggaran');
      var id_pengadaan =$(this).data('id_pengadaan');

      $(".nama_pengadaan").val(nama_pengadaan);
      $(".deskripsi").val(deskripsi);
      $(".anggaran").val(anggaran);
      $(".id_pengadaan").val(id_pengadaan);
    });

  </script>


</body>

</html>