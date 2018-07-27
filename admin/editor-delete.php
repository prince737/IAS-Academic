<?php
    $src = $_POST['src']; // $src = $_POST['src'];
    $file_name = parse_url($src); // striping host to get relative path
    $file_name = explode('/',$file_name['path']);
	$path = $file_name[3].'/'.$file_name[4];
	
    if(unlink($path))
    {
        echo 'File Delete Successfully';
    }
?>