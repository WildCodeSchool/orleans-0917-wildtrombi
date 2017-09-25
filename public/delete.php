<?php

require '../connect.php';
$bdd = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

$id = mysqli_real_escape_string($bdd, $_POST['id']);

$req = "DELETE FROM person WHERE id='$id'";
$result = mysqli_query($bdd, $req);

header('Location: index.php');