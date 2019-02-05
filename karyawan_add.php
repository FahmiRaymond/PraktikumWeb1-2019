<?php
    include ('header.php');
?>
<?php
    if(isset($_POST['add'])) {
        $nik =$_POST['nik'];
        $nama =$_POST['nama'];
        $tempat_lahir =$_POST['tempat_lahir'];
        $tanggal_lahir =$_POST['tanggal_lahir'];
        $alamat =$_POST['alamat'];
        $no_telepon =$_POST['no_telepon'];
        $jabatan =$_POST['jabatan'];
        $status =$_POST['status'];

        $cek = mysqli_query($koneksi, "SELECT * FROM tkaryawan WHERE nik='$nik'");
        if (mysqli_num_rows($cek)){
?>
<div class="alert alert-danger alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
    NIK Sudah Ada..!
</div>
<?php
        }else {
            $insert = mysqli_query($koneksi, "INSERT INTO tkaryawan(nik, nama, tempat_lahir, tanggal_lahir, alamat,
            no_telepon, jabatan, status) VALUES ('$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', 
            '$no_telepon', '$jabatan', '$status') ") or die(mysqli_error($koneksi));
            if($insert){
?>
<div class="alert alert-success alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria_hidden="true">&times;</button>
    Data karyawan berhasil disimpan.
</div>
<meta http-equiv='refresh' content='1; url=karyawan_data.php'/>
<?php
    } else {
?>
<div class="alert alert-danger alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
    Ups, Data Karyawan gagal disimpan
</div>
<?php
    }
}
    }
    $now = strtotime (date("Y-m-d"));
    $maxyear = date('Y-m-d', strtotime('- 16 year', $now));
    $minyear = date('Y-m-d', strtotime('- 50 year', $now));
?>
<h2>Data Karyawan &raquo; Tambah Data</h2>
<hr>
<form action="" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-2">
            <input type="text" name="nik" class="form-control" maxlength="10" placeholder="NIK" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-4">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tanggal Lahir</label>
        <div class="col-sm-4">
            <input type="date" name="tanggal_lahir" class="input-group form-control" placeholder="Tanggal Lahir"
            min="<?php echo $minyear; ?>" max="<?php echo $maxyear; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Alamat</label>
        <div class="col-sm-4">
            <textarea type="text" name="alamat" class="form-control" placeholder="Alamat" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">No Telepon</label>
        <div class="col-sm-3">
            <input type="text" name="no_telepon" class="form-control" maxlength="12" placeholder="No Telepon" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jabatan</label>
        <div class="col-sm-2">
            <select name="jabatan" id="" class="form-control" required>
                <option value="">---------</option>
                <option value="Operator">Operator</option>
                <option value="Leader">Leader</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Manager">Manager</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Status</label>
        <div class="col-sm-2">
            <select name="status" id="" class="form-control" required>
                <option value="">---------</option>
                <option value="Outsourcing">Outsourcing</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Tetap">Tetap</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-6">
            <button class="btn btn-primary btn-sm" type="submit" name="add" value="Simpan">Simpan</button>
            <button class="btn btn-warning btn-sm" type="reset" value="Reset">Reset</button>
            <button class="btn btn-danger btn-sm" onclick="history.back()">Kembali</button>
        </div>
    </div>
</form>
<?php
    include ('footer.php');
?>