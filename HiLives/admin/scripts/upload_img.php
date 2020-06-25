<?php
define ("MAX_SIZE","80000");

function getExtension($str) {

    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

$errors=0;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $image =$_FILES["fileToUpload"]["name"];
    $uploadedfile = $_FILES['fileToUpload']['tmp_name'];

    if ($image)
    {
        $filename = stripslashes($_FILES['fileToUpload']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        if (($extension != "jpg") && ($extension != "jpeg")
            && ($extension != "png") && ($extension != "gif"))
        {
            echo ' Unknown Image extension ';
            $errors=1;
        }
        else
        {
            $size=filesize($_FILES['fileToUpload']['tmp_name']);

            if ($size > MAX_SIZE*1024)
            {
                echo "You have exceeded the size limit";
                $errors=1;
            }

            if($extension=="jpg" || $extension=="jpeg" )
            {
                //$uploadedfile = $_FILES['fileToUpload']['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($extension=="png")
            {
                //$uploadedfile = $_FILES['fileToUpload']['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            }
            else
            {
                $src = imagecreatefromgif($uploadedfile);
            }

            list($width,$height)=getimagesize($uploadedfile);


            $newwidth1=300;
            $newheight1=300;
            $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

            //imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);

            imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,
                $width,$height);

            $nome= $_GET["id"];

            $filename= "img".$nome.".".$extension;
            $filename1 = "../uploads/img_perfil/".$filename;

            //imagejpeg($tmp,$filename,100);
            imagejpeg($tmp1,$filename1,100);

            imagedestroy($src);
            //imagedestroy($tmp);
            imagedestroy($tmp1);
        }
    }
}
//If no errors registred, print the success message

if(isset($_POST['Submit']) && !$errors)
{
    if (isset($_GET["id"]) && isset($_FILES["fileToUpload"]) ) {
        $idUser = $_GET["id"];
        $image = $filename;

        // We need the function!
        require_once("../connections/connection.php");

        // Create a new DB connection
        $link = new_db_connection();

        /* create a prepared statement */
        $stmt = mysqli_stmt_init($link);

        $query = "UPDATE users
              SET  profile_img = ?
              WHERE idUser = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'si',  $image, $idUser);

            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            }

                //header("Location: ../edit_profile.php?edit=".$idUser."");
            

            /* close statement */
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($link);
        }

        // mysql_query("update SQL statement ");
        echo "Image Uploaded Successfully!";
    }
}

