<?php    
// *********** REKOMENDASI UNTUK DIUBAH - KONFIGURASI LOKAL ********************
/*
* +----------------------------------------------------------------------+
* | Modified by Hendro Subagyo (hendro.subagyo@gmail.com) May 2011       |
* | and Al Hafiz Akbar Maulana Siagian (alha002@gmail.com) January 2012  |
* | For ISJD                pdii.lipi.go.id                              |
* +----------------------------------------------------------------------+
*/
// PEAR SETUP
// use PEAR classes
//
// if you do not find PEAR, use something like this
//ini_set('include_path', '.:/usr/share/php:/www/oai/PEAR');
// Windows users might like to try this
//ini_set('include_path', '.;c:\xampp\php\pear');
ini_set('include_path', '.:/opt/lampp/lib/php');
ini_set('include_path', '.:/usr/share/php');
// MUST (only one)
// the earliest datestamp in your repository,
// please adjust
// batasi dengan tanggal entry data sejak (misal 2011-01-01)
$earliestDatestamp    = '2000-09-01'; 

// MUST (multiple)
// please adjust
$adminEmail			= array('budinugroho78@gmail.com'); // isi dengan email admin yang digunakan

// MUST (only one)
// please adjust (Silahkan ganti dengan nama identitas repository yang di inginkan misal ISJD PDII-LIPI)
$repositoryName = 'ISJD PDII-LIPI';

$baseURL			  = $MY_URI;
// You can use a static URI as well.
// $baseURL 			= "http://my.server.org/oai/oai2.php";

// change according to your website setup.
// Ubah dengan alamat website yang digunakan Misal: localhost/isjd
$ISJD['provider']  = 'http://isjd.pdii.lipi.go.id/oai2/index.php';
$ISJD['appname']  = '';
//$ISJD['baseURL']   = 'http://'.$_SERVER['SERVER_NAME']."/".$ISJD['appname'].'index.php/Search.html?act=tampil&id=';
$ISJD['baseURL']   = 'http://'.$_SERVER['SERVER_NAME']."/".$ISJD['appname'].'index.php';
// MUST (only one)
// You may choose any name, but for repositories to comply with the oai 
// format for unique identifiers for items records. 
// see: http://www.openarchives.org/OAI/2.0/guidelines-oai-identifier.htm
// Basically use domainname-word.domainname
// please adjust
$repositoryIdentifier = $ISJD['provider']; 

// DATABASE SETUP
// change according to your local DB setup.
$DB_HOST   = 'localhost';
$DB_USER   = 'root';
$DB_PASSWD = 'mysqlpd11l1p12016';
$DB_NAME   = 'contoh01';								

// *********** end(REKOMENDASI UNTUK DIEDIT) *****************

?>
