<?php
if(!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['mobile'])|| !empty($_POST['dob'])|| !empty($_POST['ms'])|| !empty($_POST['gen'])|| !empty($_POST['empid'])|| !empty($_POST['rm'])|| !empty($_POST['desg'])|| !empty($_POST['emptype'])|| !empty($_POST['salbp'])|| !empty($_POST['doj'])|| !empty($_POST['dept'])|| !empty($_POST['salf'])|| !empty($_POST['sald'])|| !empty($_POST['pan'])|| !empty($_POST['ban'])|| !empty($_POST['bn'])|| !empty($_POST['adn']) || !empty($_POST['ifsc']) || !empty($_FILES['file']['name'])){
    $uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){

        $fileName = $_POST['name'] . '_' . $_FILES['file']['name'];
        // $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("pdf");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file"]["type"] == "application/pdf")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "pdfs/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
        }
    }

    $uploadedFile1 = '';
    if(!empty($_FILES["file1"]["type"])){
        $fileName = $_POST['name'] . '_' . $_FILES['file1']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file1"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/jpg") || ($_FILES["file1"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file1']['tmp_name'];
            $targetPath = "pics/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile1 = $fileName;
            }
        }
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $ms = $_POST['ms'];
    $gen = $_POST['gen'];
    $empid = $_POST['empid'];
    $rm = $_POST['rm'];
    $desg = $_POST['desg'];
    $emptype = $_POST['emptype'];
    $salbp = $_POST['salbp'];
    $doj = $_POST['doj'];
    $dept = $_POST['dept'];
    $salf = $_POST['salf'];
    $sald = $_POST['sald'];
    $pan = $_POST['pan'];
    $ban = $_POST['ban'];
    $bn = $_POST['bn'];
    $adn = $_POST['adn'];
    $ifsc = $_POST['ifsc'];
    $sald1 = $_POST['sald1'];
    $empstatus = $_POST['empstatus'];
    

    
    //include database configuration file
    include_once 'dbConfig.php';
    
    $insert = $db->query("INSERT into emp(empname,empemail,empph,empdob,empms,empgen,emp_no,rm,desg,empty,salbp,empdoj,dept,salf,sald,sald1,pan,ban,bn,adn,ifsc,pdf,pic,empstatus) VALUES ('".$name."','".$email."','".$mobile."','".$dob."','".$ms."','".$gen."','".$empid."','".$rm."','".$desg."','".$emptype."','".$salbp."','".$doj."','".$dept."','".$salf."','".$sald."','".$sald1."','".$pan."','".$ban."','".$bn."','".$adn."','".$ifsc."','".$uploadedFile."','".$uploadedFile1."','".$empstatus."')");
 
    echo $insert?'ok':'err';
}
?>