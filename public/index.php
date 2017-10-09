<?php
include 'header.php';
require '../connect.php';
require '../vendor/autoload.php';

// Routeur basique, necessite une url index.php?route=xxx
$route = $_GET['route'];
// On appelle une methode d'un controlleur en fonction de la route saisie en URL
if ($route == 'showAll') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->showAllAction();
} elseif ($route == 'showOne') {
    $personController = new \WildTrombi\Controller\PersonController();
    echo  $personController->showOneAction($_GET['id']);
} else {
    echo 'La page n\'existe pas';
}

exit();

?>

<div class="jumbotron">
    <div class="container">
        <h1>Welcome on the WildTrombi!</h1>
        <p>Discover our wilders and teachers</p>
        <p>
            <a class="btn btn-primary btn-lg">Learn more</a>
        </p>
    </div>
</div>

<a href="addUpdate.php" class="pull-right btn btn-lg btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Add a Wilder
</a>
<h2 class="">Our wilders</h2>
<hr/>

<div class="row">

<?php
    $req = "SELECT p.id, firstname, lastname, c.name 
              FROM person p
                JOIN category c ON c.id=p.category_id
              LIMIT 0, 10";
    $result = mysqli_query($bdd, $req);

    while($data = mysqli_fetch_assoc($result)) : ?>

        <div class="col-sm-6 col-md-4 col-lg-3">
            <figure class="thumbnail">
                <img src="http://via.placeholder.com/353x353" alt="">
                <figcaption class="caption">
                    <h3><?= ucfirst(htmlentities($data['firstname'])) . ' ' . ucfirst(htmlentities($data['lastname'])) ?></h3>
                    <p><?= htmlentities($data['name']) ?></p>
                    <p>
                        <a href="addUpdate.php?id=<?= $data['id'] ?>" class="btn btn-primary">Edit</a>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>"/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </p>
                </figcaption>
            </figure>
        </div>

    <?php endwhile;?>

</div>


<?php
include 'footer.php';
?>
