<?php
    $fileName = "to-do-list.txt";
    $error_msg="";

    function txtLength(){
        $file = "to-do-list.txt";
        $fileData = file_get_contents($file);
        $fileDataArray = explode("\n", $fileData);
        return sizeof($fileDataArray)-1;

    }
    if(isset($_GET["add"])){
        if(isset($_GET["listText"]) && $_GET["listText"]!=""){
            $string = $_GET["listText"];
            file_put_contents($fileName,$string."\n",FILE_APPEND);
        }
        else{
            $error_msg="input field empty";
        }
    }

    function removeTXT($rmText){
        $returnData="";
        $file = "to-do-list.txt";
        $fileData = file_get_contents($file);
        $fileDataArray = explode("\n",$fileData);
        for($i=0;$i<txtLength();$i++){
            if(!strcmp($rmText,$fileDataArray[$i])){
                continue;
            }
            else{
                $returnData .= $fileDataArray[$i]."\n";
            }
        }
        return $returnData;
    }

    $dataSize = txtLength();
    for($i=0;$i<$dataSize;$i++){
        if(isset($_GET["del".$i])){
            $newText = removeTXT($_GET["item".$i]);
            file_put_contents($fileName,$newText);
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>To-DO</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/to-do.css">
    </head>

    <body>
        <div class="headAlign">
            <h1>TO-DO || NOT TO-DO</h1>
        </div>

        <div class="container">
            <form action="to-do.php" method="get" class="center-all">

                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="basic-addon1" name="listText">
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-default" name="add" value="+">
                    </span>
                </div>

                <div class="headAlign">
                    <h4><?=$error_msg?></h4>
                </div>

                <table class="table to-do-table">
                    <?php
                        $fileData = file_get_contents($fileName);
                        $fileDataArray = explode("\n", $fileData);

                        for($value=0;$value<sizeof($fileDataArray)-1;$value++){
                                $tempData = $fileDataArray[$value];
                            ?>
                            <tr>
                                <td>
                                    <span><?=$tempData?></span>
                                    <input type="hidden" value="<?=$tempData?>" name="<?='item'.$value?>">
                                </td>
                                <td class="td-width">
                                    <input type="submit" class="btn btn-danger" name="<?='del'.$value?>" value="-">
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </form>
        </div>
    </body>
</html>