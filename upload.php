<?php
header('Content-type:application/json;charset=utf-8');

// CONFIGURATION START
// Here you can add your tokens ("token1, token2, token3")
$tokens = array("token, bad, something");
// Here you can change the amount of Zero width spaces you want to have (this is optional.)
$lengthofstring = 20; 
// CONFIGURATION END

function ZeroWidthSpace($length) {
    $keys = array("\u{e0061}","\u{e0062}","\u{e0063}","\u{e0064}","\u{e0065}","\u{e0066}","\u{e0067}","\u{e0068}","\u{e0069}","\u{e006a}","\u{e006b}","\u{e006c}","\u{e006d}","\u{e006e}","\u{e006f}","\u{e0070}","\u{e0071}","\u{e0072}","\u{e0073}","\u{e0074}","\u{e0075}","\u{e0076}","\u{e0077}","\u{e0078}","\u{e0079}","\u{e007a}","\u{e007f}");
 
    for($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }

    return $key;
}
 
echo $key;

if(isset($_POST['secret']))
{
    if(in_array($_POST['secret'], $tokens))
    {
        $filename = ZeroWidthSpace($lengthofstring);
        $target_file = $_FILES["sharex"]["name"];
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        if (move_uploaded_file($_FILES["sharex"]["tmp_name"], $filename.'.'.$fileType))
        {
            $json = ['status' => 'OK','errormsg' => '','url' => $filename];
        }
            else
        {
           $json = ['status' => 'ERROR','errormsg' => '','url' => 'File upload failed. Does the folder exist and did you CHMOD the folder?'];
        }  
    }
    else
    {
        $json = ['status' => 'ERROR','errormsg' => '','url' => 'Invalid secret key.'];
    }
}
else
{
    $json = ['status' => 'ERROR','errormsg' => '','url' => 'No POST data recieved.'];
}
echo(json_encode($json));
?>