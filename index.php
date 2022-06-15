<?

$user = $_GET["user"];
$file = file_get_contents("./userdata/".$user.".mudae");
$list = preg_split("/((\r?\n)|(\r\n?))/", $file);

/* -- TODO: image cache -- */ 

// $cache_file = 'content.cache';
// if(file_exists($cache_file)) {
//   if(time() - filemtime($cache_file) > 86400) {
//      // too old , re-fetch
//      $cache = file_get_contents('YOUR FILE SOURCE');
//      file_put_contents($cache_file, $cache);
//   } else {
//      // cache is still fresh
//   }
// } else {
//   // no cache, create one
//   $cache = file_get_contents('YOUR FILE SOURCE');
//   file_put_contents($cache_file, $cache);
// }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <style type="text/css">
        
        .gallery-title
        {
            font-size: 36px;
            color: #42B32F;
            text-align: center;
            font-weight: 500;
            margin-bottom: 70px;
        }
        .gallery-title:after {
            content: "";
            position: absolute;
            width: 7.5%;
            left: 46.5%;
            height: 45px;
            border-bottom: 1px solid #5e5e5e;
        }
        .filter-button
        {
            font-size: 18px;
            border: 1px solid #42B32F;
            border-radius: 5px;
            text-align: center;
            color: #42B32F;
            margin-bottom: 30px;

        }
        .filter-button:hover
        {
            font-size: 18px;
            border: 1px solid #42B32F;
            border-radius: 5px;
            text-align: center;
            color: #ffffff;
            background-color: #42B32F;

        }
        .btn-default:active .filter-button:active
        {
            background-color: #42B32F;
            color: white;
        }

        .port-image
        {
            width: 100%;
        }

        .gallery_product
        {
            margin-bottom: 30px;
        }

    </style>

</head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>

     <div class="container-fluid col-md-10 col-md-offset-1">
            <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title"><?=$user?>'s harem</h1>
            </div>


                <? foreach ($list as $item) {
                    $item_d = preg_split("/%/", $item);
                    #echo "rank: ".$item_d[0]." name: ".$item_d[1]." link: ".$item_d[2];

                    //$link = "https://mudae.net/uploads/8582936/n_Y1e2ffcFE_njXInb7J~1YFkavo.png";
                    $image = file_get_contents($item_d[2]); ?>

                    <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                        <? echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>'; ?>
                        <label><?="#".$item_d[0]." - ".$item_d[1]?></label>
                    </div>

                    
                <? } ?>

            </div>
        </div>
    </section>

</body>


</html>
