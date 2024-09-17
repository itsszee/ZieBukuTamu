<?php
// memanggil file koneksi.php
require_once('koneksi.php');

// membuat query ke / dari database
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($rows =  mysqli_fetch_assoc($result)) {
        $rows[] = $rows;
    }
    return $rows;
}
?>