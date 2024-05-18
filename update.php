<?php
include_once 'dbConfig.php';

$ID = isset($_GET['id']) ? $_GET['id'] : null;

if ($ID !== null) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $ms = $_POST['ms'] ?? '';
    $gen = $_POST['gen'] ?? '';
    $empid = $_POST['empid'] ?? '';
    $rm = $_POST['rm'] ?? '';
    $desg = $_POST['desg'] ?? '';
    $emptype = $_POST['emptype'] ?? '';
    $doj = $_POST['doj'] ?? '';
    $dept = $_POST['dept'] ?? '';
    $salf = $_POST['salf'] ?? '';
    $salbp = $_POST['salbp'] ?? '';
    $sald = $_POST['sald'] ?? '';
    $sald1 = $_POST['sald1'] ?? '';
    $pan = $_POST['pan'] ?? '';
    $ban = $_POST['ban'] ?? '';
    $bn = $_POST['bn'] ?? '';
    $adn = $_POST['adn'] ?? '';
    $ifsc = $_POST['ifsc'] ?? '';

    $insert = $db->query("UPDATE `emp` SET empname='$name', empemail='$email', empph='$mobile', empdob='$dob', empms='$ms', empgen='$gen', emp_no='$empid', rm='$rm', desg='$desg', empty='$emptype', empdoj='$doj', dept='$dept', salf='$salf',salbp='$salbp',sald='$sald',sald1='$sald1', pan='$pan', ban='$ban', bn='$bn', adn='$adn', ifsc='$ifsc' WHERE id='$ID'");

    echo $insert ? 'ok' : 'err';
} else {
    echo 'Invalid ID';
}
?>
