<?
$errors = 0;
ini_set('display_errors', $errors);
ini_set('display_startup_errors', $errors);
//error_reporting(E_NONE);

$user = $_GET["user"];
$file = file_get_contents("./userdata/".$user.".mudae");
$harem = preg_split("/((\r?\n)|(\r\n?))/", $file);
array_pop($harem);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$user?>'s harem</title>


    <style type="text/css">
        
        .gallery-title
        {
            font-size: 36px;
            color: #42B32F;
            text-align: center;
            font-weight: 500;
            margin-bottom: 70px;
        }

        .gallery_product
        {
            margin-bottom: 30px;
        }

        label{
            font-size: 11px;
        }

    </style>

</head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="shortcut icon" href="favicon.png" />
<!------ Include the above in your HEAD tag ---------->

<body>

     <div class="container-fluid col-md-10 col-md-offset-1">
            <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title"><?=$user?>'s harem</h1>
            </div>


                <?  

                    foreach ($harem as $char) {
                    
                        $char_a = preg_split("/%/", $char);

                        $image_url = pathinfo($char_a[3]); //get url pathinfo
                        $image_file_name = "./cache/".$image_url["filename"].".".$image_url["extension"]; //get file name with extension

                        if(file_exists($image_file_name) && filesize($image_file_name) > 0){ //si tengo cache del archivo lo cargo ?> 

                            <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                <img src="<?=$image_file_name?>"/>
                                <label><?="".$char_a[0]." - ".$char_a[1]?></label> <label style="color: blue;"><?="(".$char_a[2]." ka)"?></label>
                            </div>

                        <? } else { //si no la descargo

                            // if(file_exists($image_file_name)){
                            //     unlink(image_file_name);
                            // }

                            try{
                                $image = file_get_contents($char_a[3]); //get image from mudae
                                file_put_contents($image_file_name, $image); ?>

                            <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                <img src="data:image/jpeg;base64,<?=base64_encode($image)?>"/>
                                <label ><?="".$char_a[0]." - ".$char_a[1]?></label> <label style="color: blue;"><?="(".$char_a[2]." ka)"?></label>
                            </div>

                        <? } catch (Exeption $e){echo "error";};
                        } //end if
                    } //end foreach?>


            </div>
        </div>
    </section>

</body>


</html>
