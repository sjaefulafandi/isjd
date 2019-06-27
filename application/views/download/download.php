<?php
	$file = $file_url;

function UR_exists($url){
   $headers=get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}

if (UR_exists($file)) {
// We'll be outputting a PDF
header('Content-Type: '.$mime);

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');

// The PDF source is in original.pdf
readfile($file);

//header('Location: '.$file);
die();
}else{
	echo 'tidak ada';
	echo ($file);
}
?>