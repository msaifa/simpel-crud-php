<?php

    // cek apakah tombol ditekan.
    if (isset($_POST['submit'])){
        // deklarasi semua masukan
        $bil1 = (int) $_POST['bil1'];
        $bil2 = (int) $_POST['bil2'];
        $bil3 = (int) $_POST['bil3'];
        $bil4 = (int) $_POST['bil4'];
        $bil5 = (int) $_POST['bil5'];

        // penggabungan data menjadi 1 variabel
        $data = array($bil1,$bil2,$bil3,$bil4,$bil5);

        for($i=0;$i<5;$i++){
            for($j=0;$j<5;$j++){
                // membandingkan data ke i dengan data ke j. dicek apakah lebih kecil
                if($data[$i] < $data[$j]){
                    // data ditukar posisi
                    $temp = $data[$i] ;
                    $data[$i] = $data[$j];
                    $data[$j] = $temp ;
                }
            }
        }

        // menampilkan hasil dari pengurutan. 
        echo '<h3>Hasil pengurutannya adalah : </h3>' ;
        for ($i=0;$i<5;$i++){
            echo $i+1 . '. ' . $data[$i] . '<br>';
        }
        echo '<br>' ;
    }


?>

<!-- Form untuk memasukkan data -->

<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Bilangan 1</td>
                <td><input type="number" name="bil1" required></td>
            </tr>
            <tr>
                <td>Bilangan 2</td>
                <td><input type="number" name="bil2" required></td>
            </tr>
            <tr>
                <td>Bilangan 3</td>
                <td><input type="number" name="bil3" required></td>
            </tr>
            <tr>
                <td>Bilangan 4</td>
                <td><input type="number" name="bil4" required></td>
            </tr>
            <tr>
                <td>Bilangan 5</td>
                <td><input type="number" name="bil5" required></td>
            </tr>
        </table>
        <input type="submit" value="Urutkan" name="submit">
    </form>
</body>