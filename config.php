<?php
//koneksi ke database
mysql_connect("localhost", "root", "toor");
mysql_select_db("tutorial");
//fungsi untuk mengkonversi size file
// $allowed_ext	= 'doc,zip';
// $njupuk = explode(',',$allowed_ext);
// echo $njupuk[0]; die();
function konfsize($bytes)
{
    $unit = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($unit) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . " " . $unit[$pow];
}
