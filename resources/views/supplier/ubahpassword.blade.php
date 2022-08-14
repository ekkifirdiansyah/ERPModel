<!-- Modal -->
<div class="modal fade" id="ubahPasswordSup">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPasswordSup">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <form action="/ubahPasswordS" method="post" role="form">
                    {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password Lama</label>
                                <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Masukan Password Lama">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password Baru">
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