<?php include "header.php"; ?>
<?php
    $nik = $_GET['nik'];
    $sql = mysqli_query($koneksi, "SELECT * FROM tkaryawan WHERE nik='$nik'");
    if(mysqli_num_rows($sql)==0) {
?>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
        &times;
    </button>
    NIK Tidak Adaa..!
</div>
<?php
    }else{
        $row = mysqli_fetch_assoc($sql);
    }
    //Proses Simpan Data
    if(isset($_POST['save'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $jabatan = $_POST['jabatan'];
        $status = $_POST['status'];

        $update = mysqli_query($koneksi, "UPDATE tkaryawan SET nama='$nama',
                    tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir',
                    alamat='$alamat', no_telepon='$no_telepon', jabatan='$jabatan',
                    status='$status' WHERE nik = '$nik'") or die(mysqli_error());
        if($update) {
?>
<div class="alert alert-success alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">
        &times;
    </button>
    Data berhasil disimpan.
</div>
<meta http-equiv='refresh' content='1; url=karyawan_data.php'/>
<?php
        }else{
?>
<div class="alert alert-danger alert-dismissable">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">
        &times;
    </button>
    Data gagal disimpan, silakan coba lagi.
</div>
<?php
        }
    }
    $now = strtotime (date("Y-m-d"));
    $maxyear = date('Y-m-d', strtotime('- 16 year', $now));
    $minyear = date('Y-m-d', strtotime('- 50 year', $now));
?>
<h2> Data Karyawan &raquo; Edit Data</h2>
<hr>
<form action="" class="form-horizontal" method="post">
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">NIK</label>
        <div class="col-sm-2">
            <input type="text" name="nik" value="<?php echo $row['nik'] ?>" class="form-control" placeholder="NIK" required>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Nama</label>
        <div class="col-sm-4">
            <input type="text" name="nama" value="<?php echo $row['nama'] ?>" class="form-control" placeholder="Nama" required>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Tempat Lahir</label>
        <div class="col-sm-4">
            <input type="text" name="tempat_lahir" value="<?php echo $row['tempat_lahir'] ?>" class="form-control" placeholder="Tempat Lahir" required>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Tanggal Lahir</label>
        <div class="col-sm-4">
            <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir'] ?>" class="input-group form-control"
            min="<?php echo $minyear; ?>" max="<?php echo $maxyear; ?>" placeholder="Tanggal Lahir" required>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Alamat</label>
        <div class="col-sm-6">
            <textarea name="alamat" id="" cols="30" rows="10" class="form-control" placeholder="Alamat"><?php echo $row['alamat'] ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">No Telepon</label>
        <div class="col-sm-2">
            <input type="text" name="no_telepon" value="<?php echo $row['no_telepon'] ?>" class="form-control" placeholder="No Telepon" required>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Jabatan</label>
        <div class="col-sm-2">
            <select name="jabatan" id="" class="form-control" required>
                <option value="<?php echo $row['jabatan'] ?>"><?php echo $row['jabatan'] ?></option>
                <option value="operator">operator</option>
                <option value="leader">leader</option>
                <option value="supervisor">supervisor</option>
                <option value="manager">manager</option>
            </select>
        </div>
        <div class="col-sm-3">
            <b>Jabatan Sekarang : </b>
            <span class="label label-success">
                <?php echo $row['jabatan'] ?>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">Status</label>
        <div class="col-sm-2">
            <select name="status" id="" class="form-control" required>
                <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                <option value="outsourcing">outsourcing</option>
                <option value="kontrak">kontrak</option>
                <option value="tetap">tetap</option>
            </select>
        </div>
        <div class="col-sm-3">
            <b>Status Sekarang : </b>
            <span class="label label-info">
                <?php echo $row['status'] ?>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-3 control-label"> &nbsp; </label>
        <div class="col-sm-6">
            <button type="submit" name="save" class="btn btn-sm btn-primary" value="simpan">Simpan</button>
            <button type="reset" class="btn btn-sm btn-warning" value="reset">Reset</button>
            <button class="btn btn-sm btn-danger" onClick="history.back()">Kembali</button>
        </div>
    </div>
</form>
<?php include "footer.php" ?>