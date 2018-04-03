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
            <a href="upload.php" class="active">Upload</a>
            <a href="download.php">Download</a>
        </div>
 
        <div id="content">
        	<h2>Upload</h2>
            <p>Upload file Anda dengan melengkapi form di bawah ini. File yang bisa di Upload hanya file dengan ekstensi <b>.doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .rar, .zip</b> dan besar file (file size) maksimal hanya 1 MB.</p>
 
            <?php
			include('config.php');
			if($_POST['upload']){
				$cek_ext	= array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip');
				$file_name		= $_FILES['file']['name'];
				
				$file_ext		= strtolower(end(explode('.', $file_name)));
				$file_size		= $_FILES['file']['size'];
				
				$file_tmp		= $_FILES['file']['tmp_name'];
				// echo $file_tmp;die();
				$nama			= $_POST['nama'];
				$tgl			= date("y-m-d");
 
				if(in_array($file_ext, $cek_ext) === true){
					if($file_size < 1044070){
						$lokasi = 'files/'.$nama.'.'.$file_ext;
						move_uploaded_file($file_tmp, $lokasi);
						$in = mysql_query("INSERT INTO download VALUES(NULL, '$tgl', '$nama', '$file_ext', '$file_size', '$lokasi')");
						$var = $in ? '<div class="ok">SUCCESS: File berhasil di Upload!</div>': '<div class="error">ERROR: Gagal upload file!</div>' ;
						echo $var;
// $retVal = (condition) ? a : b ;
					}else{
						echo '<div class="error">ERROR: Besar ukuran file maksimal 1 Mb!</div>';
					}
				}else{
					echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
				}
			}
			?>
 
            <p>
            <form action="" method="post" enctype="multipart/form-data">
            <table width="100%" align="center" border="0" bgcolor="#eee" cellpadding="2" cellspacing="0">
            	<tr>
                	<td width="40%" align="right"><b>Nama File</b></td><td><b>:</b></td><td><input type="text" name="nama"  size="40" required /></td>
                </tr>
                <tr>
                	<td width="40%" align="right"><b>File</b></td><td><b>:</b></td><td><input type="file" name="file" required /></td>
                </tr>
                <tr>
                	<td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" name="upload" value="Upload" /></td>
                </tr>
            </table>
            </form>
            </p>
        </div>
    </div>
 
</body>
</html>

<!-- Line	Penjelasan Kode
57-69	Membuat form yang berisi inputan judul, inputan pemilihan file, dan tombol untuk upload
26	meng-include-kan file config.php yang berisikan koneksi ke database
28	membuat array yang berisikan file ber-ekstensi apa saja yang bisa di upload
29-32	mendeklarasikan beberapa properti dari inputan file, seperti nama file, file ekstensi, file size, dan file tmp
34-35	mendeklarasikan judul dan tanggal sekarang
37	pengecekan apakah file ekstensi ada dalam array ekstensi yang di izinkan, jika ada (true) maka berhasil
38	pengecekan apakah file size tidak lebih besar dari 1044070 (1Mb), jika lebih kecil, maka berhasil
39	menentukan lokasi menyimpanan/upload file, yaitu file akan di upload didalam folder files, dan merubah nama file yang diupload menjadi judul yang di inputkan tadi.
40	melakukan proses upload dengan fungsi move_uploaded_file()
41	melakukan query ke database untuk melakukan perintah INSERT data
43	pesan jika file berhasil di upload dan data tersimpan ke database -->