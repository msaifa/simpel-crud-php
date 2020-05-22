<?php
    /**
     * 
     * di file ini berisi function function utama atau yang akan sering dipanggil dalam aplikasi / program
     * 
     */


     // deklarasi database + koneksi database
    $host = "localhost" ;
    $user = "root" ;
    $pass = "" ;
    $debe = "db_kampus" ;

    $koneksi = mysqli_connect($host,$user,$pass,$debe) ;

    if (!$koneksi){
        echo 'KONEKSI GAGAL' ;
    } else {
        // echo 'KONEKSI BERHASIL' ;
    }

    // bertujuan untuk mengeksekusi sql yang dikirim dan mengembalikan hasil eksekusi
    function query($sql){
        global $koneksi ;

        return mysqli_query($koneksi, $sql) ;
    }

    // digunakan untuk menghitung jumlah data yang di select.
    /**
     * 
     * paramter
     * 1. sql query
     * 
     * return :
     * data query
     * 
     */
    function total($sql){
        global $koneksi ;

        $res = query($sql) ;
        return mysqli_num_rows($res) ;
    }

    // menampilkan error dari mysql
    function error(){
        global $koneksi ;

        return mysqli_error($koneksi) ;
    }

    // digunakan untuk menampilkan input + label dengan type, name, value yang dinamis sesuai paramter
    /**
     * 
     * parameter :
     * 1. label dari input
     * 2. type dari input
     * 3. value dari input
     * 
     */
    function form($label, $type,$name,$val){
        echo '<tr>' ;

        echo $label?'<td>'.$label."</td>":"" ;
        echo "<td><input type='$type' name='$name' value='$val' ></td>" ;
        
        echo '</tr>' ;
    }

    function formRadio($label,$name, $item, $value){
        echo '<tr>' ;

        echo $label?'<td>'.$label."</td>":"" ;
        for($i=0;$i<count($item);$i++){
            $checked = $value==$item[$i]?"checked":"";
            echo "<td>".$item[$i]."<input type='radio' name='$name' value='".$item[$i]."' $checked></td>" ;
        }
        
        echo '</tr>' ;
    }

    // menuliskan tag form + table opoen
    function formOpen($method){
        echo '<table>' ;
        echo '<form method="'.$method.'">' ;
    }

    // menuliskan tag form + table close
    function formClose(){
        echo '</form>' ;
        echo '</table>' ;
    }

?>