<?php


$number_of_files = $_POST['number_of_files'];
echo "Number of files : ".$number_of_files;


$files = [];

for ($i = 0; $i < $number_of_files; $i++){
    if (isset($_FILES['file'.$i])){
        $files[$i] = $_FILES['file'.$i];
    }
}

while ($number_of_files > count($files)){
   $files[] = 1; 
}

var_dump($files);

    $countfiles = count($files);

    foreach ($files as $file)
    {
        if ($file == 1){
            echo"Testing empty file input or wrong file ...";
        }else{
        $filename = $file['name'];
        move_uploaded_file($file['tmp_name'],'actualites_files/'.$filename);
        echo 'Upload de '.$filename.' réussi (normalement)';
        }
    }

?>