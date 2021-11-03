<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload php</title>
</head>
<?php

class Upload {
       
    static function uploadAnexo($arquivo){ if(isset($arquivo))
        {
            $errors=array();
            $allowed_ext= array('jpg','jpeg','png','gif','txt','zip','docx','doc','xls','xlsx');
            $file_name =$arquivo['name'];
            $file_ext = strtolower( end(explode('.',$file_name)));


            $file_size=$arquivo['size'];
            $file_tmp= $arquivo['tmp_name'];
            echo $file_tmp;echo "<br>";

            $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
            $data = file_get_contents( $file_tmp );
            $base64 = 'data:temp/' . $type . ';base64,' . base64_encode($data);
            echo "Base64 is ".$base64;



            if(in_array($file_ext,$allowed_ext) === false)
            {
                $errors[]='Extensão não permitida';
            }

            if($file_size > 20971520) //em bytes máximo 20 MB
            {
                $errors[]= 'Tamanho máximo de 2MB';

            }
            if(empty($errors))
            {
            if( move_uploaded_file($file_tmp, 'temp/'.$file_name));
            {
                echo 'Upload feito com sucesso!';
            }
            }
            else
            {
                foreach($errors as $error)
                {
                    echo $error , '<br/>'; 
                }
            }
            print_r($errors);

        }
    }
}

Upload::uploadAnexo($_FILES['anexo']);

?>

<body>
    <form action="" method="post" enctype="multipart/form-data">
    <label for="anexo">Inserir Anexo</label>

    <input type="file" name="anexo">
    <button type="submit">Enviar</button>
    </form>
</body>

</html>