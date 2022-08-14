<!-- Modal -->
<div class="modal fade" id="pengajuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-primary">
            <form action="/tambahPengajuan" method="post" role="form" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id_pengadaan" id="id_pengadaan" class="id_pengadaan">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pengadaan</label>
                        <input type="text" class="form-control nama_pengadaan" id="nama_pengadaan" name="nama_pengadaan" placeholder="Masuk Nama Pengadaan" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Proposal</label>
                        <input type="file" class="form-control" id="proposal" name="proposal" accept="application/pdf">
                    </div>
                    <div class="form-group">
                        <label>Anggaran : Rp. <input type="" class="labelRp" disable style="border:none; background-color: white; color: black;"></label>
                        <input type="text" class="form-control anggaran" id="anggaran" name="anggaran" placeholder="Masukan Anggaran" onkeyup="curency()">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
  </div>
</div>