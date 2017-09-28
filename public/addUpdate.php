<?php
include 'header.php';
require '../connect.php';
$bdd = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);

$isUpdate = false;

if (!empty($_GET['id'])) {
    $isUpdate = true;
    $req = "SELECT firstname, lastname, category_id as category
            FROM person
              WHERE id='" . $_GET['id']. "'";
    $result = mysqli_query($bdd, $req);
    while($data = mysqli_fetch_assoc($result))  {
        $cleanPost['firstname'] = $data['firstname'];
        $cleanPost['lastname'] = $data['lastname'];
        $cleanPost['category'] = $data['category'];
    }
} else {
    $title = 'Add';
}

if ($_POST) {

    foreach ($_POST as $key=>$value) {
        $cleanPost[$key] = trim(mysqli_real_escape_string($bdd, $value));
    }

    if (empty($_POST['firstname'])) {
        $errors[] = 'Firstname is required';
    } elseif (strlen($_POST['firstname']) < 3) {
        $errors[] = 'Firstname should be at least 3 characters';
    }

    if (empty($_POST['lastname'])) {
        $errors[] = 'Lastname is required';
    }

    if (empty($_POST['category'])) {
        $errors[] = 'Category is required';
    }

    if (!empty($errors)) : ?>

        <div class="alert alert-danger">
            <button type="button" class="close" data - dismiss="alert" aria - hidden="true">&times;</button>
            <strong> Errors!</strong>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php
    else :
        $firstname = $cleanPost['firstname'];
        $lastname = $cleanPost['lastname'];
        $category = $cleanPost['category'];

        if (empty($cleanPost['id'])) :
            $req = "INSERT INTO person (firstname, lastname, category_id) 
                    VALUES ('$firstname', '$lastname', '$category' )";
        else :
            $id = $cleanPost['id'];
            $req = "UPDATE person SET firstname='$firstname', lastname='$lastname', category_id='$category'
                      WHERE id='$id'";
        endif;

        $result = mysqli_query($bdd, $req);

        header("Location: index.php");
    endif;
}



?>

<h1>
    <?php
        if ($isUpdate) {
            echo 'Update ' . ucfirst($cleanPost['firstname']) .' '. ucfirst($cleanPost['lastname']);
        }  else {
            echo 'Add a new Wilder';
        }
    ?>
</h1>

<form action="addUpdate.php" method="post">

    <fieldset class="form-group">
        <legend>Enter your name</legend>
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname"
               placeholder="Enter your firstname" value="<?= $cleanPost['firstname'] ?? '' ?>"/>
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname"
               placeholder="Enter your lastname"  value="<?= $cleanPost['lastname'] ?? '' ?>"/>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?? '' ?>" />
    </fieldset>

    <fieldset class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control">
            <?php
            $req = "SELECT id, name FROM category";
            $result = mysqli_query($bdd, $req);
            while($data = mysqli_fetch_assoc($result)) : ?>
                <option value="<?= $data['id'] ?>"
                    <?php if (!empty($cleanPost) && $cleanPost['category'] == $data['id']) : ?>
                        selected
                    <?php endif; ?>
                >
                    <?= ucfirst($data['name']) ?>
                </option>
            <?php endwhile;
            ?>
        </select>
    </fieldset>

    <button type="submit" class="btn btn-<?= $isUpdate ? 'info' : 'success' ?> ">

        <span class="glyphicon glyphicon-<?= $isUpdate ? 'edit' : 'plus' ?>"></span> <?= $isUpdate ? 'Update' : 'Add' ?> Wilder
    </button>
</form>

<hr/>
<a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back to Home</a>

<?php
include 'footer.php';
?>

