<?php
include 'header.php';


if ($_POST) {

    foreach ($_POST as $key=>$value) {
        $cleanPost[$key] = trim(htmlentities($value));
    }

    if (empty($_POST['firstname'])) {
        $errors[] = 'Firstname is required';
    } elseif (strlen($_POST['firstname']) < 3) {
        $errors[] = 'Firstname should be at least 3 characters';
    }

    if (empty($_POST['lastname'])) {
        $errors[] = 'Lastname is required';
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
        ?>
        <div class="well">
            Hello <?= $cleanPost['firstname'] . ' ' . $cleanPost['lastname'] ?>

        </div>
    <?php
    endif;
}



?>

<h1>Add a wilder</h1>

<form action="" method="post">

    <fieldset class="form-group">
        <legend>Enter your name</legend>
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname"
               placeholder="Enter your firstname" value="<?= $cleanPost['firstname'] ?? '' ?>"/>
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname"
               placeholder="Enter your lastname"  value="<?= $cleanPost['lastname'] ?? '' ?>"/>
    </fieldset>

    <fieldset class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control">
            <?php
            $options = ['wilder', 'teacher'];
            foreach ($options as $option) : ?>
                <option value="<?= $option ?>"
                    <?php if (!empty($cleanPost) && $cleanPost['category'] == $option) : ?>
                        selected
                    <?php endif; ?>
                >
                    <?= 'You are a ' . ucfirst($option) ?>
                </option>
            <?php endforeach;
            ?>
        </select>
    </fieldset>

    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Wilder</button>
</form>

<hr/>
<a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Back to Home</a>

<?php
include 'footer.php';
?>

