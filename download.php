<!DOCTYPE html>
<html>
<head>
	<title>Simple Upload dan Download File</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 
	<div id="container">
    	<div id="header">
    		<h1>Simple Upload dan Download File</h1>
        	<span>Dibuat oleh Pino @tutorialweb.net</span>
        </div>
 
        <div id="menu">
        	<a href="index.php">Home</a>
            <a href="upload.php">Upload</a>
            <a href="download.php" class="active">Download</a>
        </div>
 
        <div id="content">
        	<h2>Download</h2>
            <p>Silahkan download file yang sudah di Upload di website ini. Untuk men-Download Anda bisa mengklik Judul file yang di inginkan.</p>
 
            <p>
            <table class="table" width="100%" cellpadding="3" cellspacing="0">
            	<tr>
                	<th width="30">No.</th>
                    <th width="80">Tgl. Upload</th>
                    <th>Nama File</th>
                    <th width="70">Tipe</th>
                    <th width="70">Ukuran</th>
                </tr>
                <?php
				include('config.php');
				$sql = mysql_query("SELECT * FROM download ORDER BY id DESC");
				if(mysql_num_rows($sql) > 0){
					$no = 1;
					while($data = mysql_fetch_assoc($sql)){
						echo '
						<tr bgcolor="#fff">
							<td align="center">'.$no.'</td>
							<td align="center">'.$data['tanggal_upload'].'</td>
							<td><a href="'.$data['file'].'">'.$data['nama_file'].'</a></td>
							<td align="center">'.$data['tipe_file'].'</td>
							<td align="center">'.konfsize($data['ukuran_file']).'</td>
						</tr>
						';
						$no++;
					}
				}else{
					echo '
					<tr bgcolor="#fff">
						<td align="center" colspan="5" align="center">Tidak ada data!</td>
					</tr>
					';
				}
				?>
            </table>
            </p>
        </div>
    </div>
 
</body>
</html>


<!-- Line	Penjelasan Kode
26-59	membuat table seperti biasa
35	meng-include-kan file config.php yang berisi kode untuk melakukan koneksi ke database
36	melakukan query ke database dengan perintah SELECT dari table download dan di urutkan berdasarkan id yang paling besar
37	jika query diatas menghasilkan nilai > 0 (terdapat data di dalam tabel) maka akan melakukan perintah dibawahnya
38	membuat variabel untuk nomor urut
39	melakukan perulangan while dari query SELECT pada line 37
40-49	menampilkan data dari perulangan yang mengambil dari table download
51-57	jika query pada line 37 menghasilkan nilai 0 (tidak ada data di database) maka akan menuliskan “pesan tidak ada data” -->