<?php
// halaman awal
Route::get('/','Home@index');


// halaman registrasi
Route::get('/registrasi','Registrasi@index');
Route::post('/simpanRegis','Registrasi@registrasi');


// halaman supplier
Route::get('/loginSupplier','Supplier@index');
Route::post('/loginSupplier','Supplier@loginSupplier');
Route::get('/logoutSupplier','Supplier@logoutSupplier');
Route::get('/listSupplier','Pengadaan@listSupplier');
Route::get('/listSup', 'Supplier@listSup');
Route::get('/Aktif/{id}', 'Supplier@Aktif');
Route::get('/nonAktif/{id}', 'Supplier@nonAktif');
Route::post('/ubahPasswordS', 'Supplier@ubahPasswordSup');

// halaman admin
Route::get('/loginAdmin','Admin@index');
Route::post('/loginAdmin','Admin@loginAdmin');
Route::get('/logoutAdmin','Admin@logoutAdmin');
// halaman tambah dan hapus admin
Route::get('/listAdmin','Admin@listAdmin');
Route::post('/tambahAdmin','Admin@tambahAdmin');
Route::post('/ubahAdmin', 'Admin@ubahAdmin');
Route::get('/hapusAdmin/{id}', 'Admin@hapusAdmin');
Route::post('/ubahPasswordA', 'Admin@ubahPasswordAdm');


// halaman pengajuan
Route::get('/pengajuan','Pengajuan@index');
Route::post('/tambahPengajuan', 'Pengajuan@tambahPengajuan');
Route::get('/terimaPengajuan/{id}', 'Pengajuan@terimaPengajuan');
Route::get('/tolakPengajuan/{id}', 'Pengajuan@tolakPengajuan');
Route::get('/histori', 'Pengajuan@histori');
Route::get('/selesaiPengajuan/{id}', 'Pengajuan@selesaiPengajuan');
Route::get('/pengajuanselesai', 'Pengajuan@pengajuanselesai');

Route::post('/tambahLaporan', 'Pengajuan@tambahLaporan');
Route::get('/laporan', 'Pengajuan@laporan');
Route::get('/tolakLaporan/{id}', 'Pengajuan@tolakLaporan');


// halaman tambah dan hapus pengadaan
Route::get('/listPengadaan', 'Pengadaan@index');
Route::post('/tambahPengadaan', 'Pengadaan@tambahPengadaan');
Route::get('/hapusPengadaan/{id}', 'Pengadaan@hapusPengadaan');
Route::post('/ubahPengadaan', 'Pengadaan@ubahPengadaan');


// tambah dan hapus gambar
Route::get('/hapusGambar/{id}','Pengadaan@hapusGambar');
Route::post('/uploadGambar', 'Pengadaan@uploadGambar');
