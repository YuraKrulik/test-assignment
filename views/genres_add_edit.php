<form method="post">
    <?php
    if (isset($_SESSION['errors']['unknown'])) {
        $errors = $_SESSION['errors']['unknown'];
        include 'validation_error.php';
    }
    ?>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" value="<?php echo $data['name'] ?? ''?>">
        <?php
        if (isset($_SESSION['errors']['name'])) {
            $errors = $_SESSION['errors']['name'];
            include 'validation_error.php';
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>