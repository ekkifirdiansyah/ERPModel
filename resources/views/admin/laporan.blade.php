<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengajuan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/adminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/adminLTE/dist/css/adminlte.min.css')}}">
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
              <h1>Pengajuan Masuk</h1>
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Pengajuan Masuk</h3>
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
                        <th>Gambar</th>
                        <th>Anggaran (IDR)</th>
                        <th>Proposal</th>
                        <th>Anggaran Pengajuan</th>
                        <th>Supplier</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Laporan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pengajuan as $p)
                      <tr>
                        <td>{{$p['nama_pengadaan']}}</td>
                        <td style="width:15%;">
                          <img style="width:70%;" src="{{asset(Storage::url($p['gambar']))}}">
                        </td>
                        <td>Rp. {{number_format($p['anggaran'],0,",",".")}}</td>
                        <td>
                          <a target="_blank" href="{{$p['proposal']}}">
                            <button class="btn-primary"><i class="fa fa-info-circle"></i> Detail</button>
                          </a>
                        </td>
                        <td>
                          <span class="tag tag-success">
                            Rp. {{number_format($p['anggaran_pengajuan'],0,",",".")}}
                          </span>
                        </td>
                        <td>{{$p['nama_supplier']}}</td>
                        <td>{{$p['email_supplier']}}</td>
                        <td>{{$p['alamat_supplier']}}</td>
                        <td>
                          @if($p['status_pengajuan'] == 2)
                          <a href="{{asset(Storage::url($p['gambar']))}}" class="btn btn-secondary" target="_blank"><i class="fa fa-eye"> Lihat Laporan</i></a>
                          @endif
                        </td>
                        <td>
                            @if($p['status_pengajuan'] == 2)
                            Laporan Sedang DiTinjau
                            <hr>
                            <a href="/selesaiPengajuan/{{$p['id_pengajuan']}}" class="btn btn-primary konfirmasi"><i class="fa fa-check"></i> Diterima</a>
                            <a href="/tolakLaporan/{{$p['id_laporan']}}" class="btn btn-danger tolak"><i class="fa fa-times"></i> Ditolak</a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
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

  <script type="text/javascript">
    $(document).on("click", ".konfirmasi", function(event){
      event.preventDefault();
      const url = $(this).attr('href');

      var answer = window.confirm("Apa kamu yakin menyetujui pengajuan ini ?");

      if(answer){
        window.location.href = url;
      } else {

      }
    });

    $(document).on("click", ".tolak", function(event){
      event.preventDefault();
      const url = $(this).attr('href');

      var answer = window.confirm("Apa kamu yakin menolak pengajuan ini ?");

      if(answer){
        window.location.href = url;
      } else {

      }
    });

  </script>

</body>

</html>