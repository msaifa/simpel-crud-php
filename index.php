<?php

    require("core.php") ;

    $jenisKelamin = array(
        'Laki-Laki','Perempuan'
    ) ;
    
    // manage pencarian
    function search(){
        $cari = "" ;
        if (isset($_GET['cari'])) $cari = $_GET['cari'] ;

        return $cari ;
    }

    // untuk kegiatan select + pencarian
    function select(){
        $cari = search() ;

        $sql = "SELECT * FROM mahasiswa WHERE mhsnama LIKE '%$cari%' or mhsnim LIKE '%$cari%'" ;
        $data= query($sql) ;

        // properti pencarian / tambah
        formOpen("get");

        form("Pencarian", "text","cari","$cari") ;
        form("", "submit","","Cari") ;

        formClose() ;

        echo '<br><br>';

        echo '<a href="?act=1" style="padding: 10px;border-style:solid; border-width:1px">Tambah Mahasiswa</a> ' ;
        echo '<a href="sorting.php" style="padding: 10px;border-style:solid; border-width:1px">Aplikasi Sorting</a><br><br>' ;

        // menampilkan Table
        echo '<table border="1">' ;
        echo '<tr>
                <th style="padding:10px">NIM</th>
                <th style="padding:10px">Nama</th>
                <th style="padding:10px">Tempat Lahir</th>
                <th style="padding:10px">Tanggal Lahir</th>
                <th style="padding:10px">Jenis Kelamin</th>
                <th style="padding:10px">Alamat</th>
                <th style="padding:10px">Kota</th>
                <th style="padding:10px">No. Hp</th>
                <th style="padding:10px">Jurusan</th>
                <th style="padding:10px" colspan="2">Aksi</th>
              </tr>' ;
        if (mysqli_num_rows($data) > 0){
            $cari = $cari?"&cari=$cari":"" ;

            while($row = mysqli_fetch_assoc($data)){
                echo '<tr>' ;
                echo '<td style="padding:10px">'. $row['mhsnim'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhsnama'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhstempatlahir'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhstgllahir'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhsjk'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhsalamat'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhskota'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhshp'] .'</td>' ;
                echo '<td style="padding:10px">'. $row['mhsjurusan'] .'</td>' ;
                echo '<td style="padding:10px"><a href="?act=2&id='. $row['mhsnim'] .$cari.'">Ubah</a></td>' ;
                echo '<td style="padding:10px"><a href="?act=4&del='. $row['mhsnim'] .$cari.'">Hapus</a></td>' ;

                echo '</tr>' ;
            }
        } else {
            echo 'Sayangnya masih belum ada Data! <br><br>' ;
        }
        echo '</table>' ;
    }

    function insert(){

        global $jenisKelamin;

        // form tambah
        formOpen("post") ;

        form("NIM","number","mhsnim","");
        form("Nama","text","mhsnama","");
        form("Tempat Lahir","text","mhstempatlahir","");
        form("Tanggal Lahir","date","mhstgllahir","");
        formRadio("Jenis Kelamin","mhsjk",$jenisKelamin,"") ;
        form("Alamat","text","mhsalamat","");
        form("Kota","text","mhskota","");
        form("No. Hp","number","mhshp","");
        form("Jurusan","text","mhsjurusan","");

        form("", "submit","insert","Kirim") ;

        formClose() ;

        // proses tambah
        if (isset($_POST['insert'])){
            $mhsnim = $_POST['mhsnim'];
            $mhsnama = $_POST['mhsnama'];
            $mhstempatlahir = $_POST['mhstempatlahir'];
            $mhstgllahir = $_POST['mhstgllahir'];
            $mhsjk = $_POST['mhsjk'];
            $mhsalamat = $_POST['mhsalamat'];
            $mhskota = $_POST['mhskota'];
            $mhshp = $_POST['mhshp'];
            $mhsjurusan = $_POST['mhsjurusan'];

            // validasi tidak kosong
            if (empty($mhsnim) || empty($mhsnama) || empty($mhstempatlahir) || empty($mhstgllahir) || empty($mhsjk) || empty($mhsalamat) || empty($mhskota) || empty($mhshp) || empty($mhsjurusan)){
                echo 'Harap mengisi semua kolom yaa :)' ;
            } else {
                // eksekusi 

                $sql = "INSERT INTO mahasiswa (mhsnim,mhsnama,mhstempatlahir,mhstgllahir,mhsjk,mhsalamat,mhskota,mhshp,mhsjurusan) 
                        VALUES ('$mhsnim','$mhsnama','$mhstempatlahir','$mhstgllahir','$mhsjk','$mhsalamat','$mhskota','$mhshp','$mhsjurusan')" ;
                $res = query($sql) ;
                
                if ($res){
                    header('Location: ?act=0') ;
                } else {
                    echo 'Data gagal ditambahkan. Karena '. error() ;
                }
            }
        }
    }

    // menghapus data
    function delete(){
        global $cari;

        // cek apakah ada url `del` 
        if (isset($_GET['del'])){
            $del = $_GET['del'] ;

            // ekseksi hapus
            $sql = "DELETE FROM mahasiswa WHERE mhsnim='$del'" ;
            $res = query($sql) ;

            if ($res){
                $cari = $cari?"&cari=$cari":"" ;
                header('Location: ?act=0'.$cari) ;
            } else {
                echo 'Data gagal dihapus. Karena '. error() ;
            }
        }
    }

    // update data
    function update(){
        global $jenisKelamin;

        // mengambil data yang akan diupdate
        $id  = $_GET['id'] ;
        $sql = "SELECT * FROM mahasiswa WHERE mhsnim='$id' " ;
        $data= query($sql) ;

        if (mysqli_num_rows($data) != 1){
            echo 'Hallo! jangan ngawur ya :)' ;
            die() ;
        }
        $row = mysqli_fetch_assoc($data) ;

        // diisikan ke dalam value form

        formOpen("post") ;

        form("NIM","number","mhsnim",$row['mhsnim']);
        form("Nama","text","mhsnama",$row['mhsnama']);
        form("Tempat Lahir","text","mhstempatlahir",$row['mhstempatlahir']);
        form("Tanggal Lahir","date","mhstgllahir",$row['mhstgllahir']);
        formRadio("Jenis Kelamin","mhsjk",$jenisKelamin,$row['mhsjk']);
        form("Alamat","text","mhsalamat",$row['mhsalamat']);
        form("Kota","text","mhskota",$row['mhskota']);
        form("No. Hp","number","mhshp",$row['mhshp']);
        form("Jurusan","text","mhsjurusan",$row['mhsjurusan']);

        form("", "submit","update","Kirim") ;

        formClose();

        // apabila diklik submit
        if (isset($_POST['update'])){
            $mhsnim = $_POST['mhsnim'];
            $mhsnama = $_POST['mhsnama'];
            $mhstempatlahir = $_POST['mhstempatlahir'];
            $mhstgllahir = $_POST['mhstgllahir'];
            $mhsjk = $_POST['mhsjk'];
            $mhsalamat = $_POST['mhsalamat'];
            $mhskota = $_POST['mhskota'];
            $mhshp = $_POST['mhshp'];
            $mhsjurusan = $_POST['mhsjurusan'];

            // validasi tidak kosong
            if (empty($mhsnim) || empty($mhsnama) || empty($mhstempatlahir) || empty($mhstgllahir) || empty($mhsjk) || empty($mhsalamat) || empty($mhskota) || empty($mhshp) || empty($mhsjurusan)){
                echo 'Harap mengisi semua kolom yaa :)' ;
            } else {

                // eksekusi update data
                $sql = "UPDATE mahasiswa SET 
                        mhsnim='$mhsnim',mhsnama='$mhsnama',mhstempatlahir='$mhstempatlahir',mhstgllahir='$mhstgllahir',mhsjk='$mhsjk',mhsalamat='$mhsalamat',mhskota='$mhskota',mhshp='$mhshp',mhsjurusan='$mhsjurusan' 
                        WHERE mhsnim='$id'" ;
                $res = query($sql) ;

                if ($res){
                    header('Location: ?act=0') ;
                } else {
                    echo 'Data gagal diubah. Karena '. error() ;
                }
            }
        }
    }

    function dialog(){
        $mhsnim = $_GET['del'] ;

        echo '<center>' ;
        echo 'Apakah anda yakin akan menghapus data ? <br><br>' ;
        echo '<a href="?act=3&del='.$mhsnim.'" style="padding: 10px;border-style:solid; border-width:1px">Ya</a> ' ;
        echo '<a href="?act=0" style="padding: 10px;border-style:solid; border-width:1px">Tidak</a> ' ;
        echo '</center>' ;
    }


    // main
    /**
     * 
     * Syntax dibaah ini digunakan untuk manage halaman lewat url act. 
     * untuk act == 1 adalah menuju halaman tambah data
     * untuk act == 2 adalah menuju halaman ubah data
     * untuk act == 3 adalah menuju halaman hapus data
     * selain itu akan menuju ke halaman utama / menampilkan data.
     * 
     */
    $act = $_GET['act'] ;
    if ($act == 1){
        insert() ;
    } else if ($act == 2){
        update() ;
    } else if ($act == 3) {
        delete() ;
    } else if ($act == 4){
        dialog() ;
    } else {
        select() ;
    }


?>