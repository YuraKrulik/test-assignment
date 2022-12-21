<form method="post">
    <?php
    if (isset($_SESSION['errors']['unknown'])) {
        $errors = $_SESSION['errors']['unknown'];
        include 'validation_error.php';
    }
    ?>
  <label for="visitor_id" class="form-label">Visitor</label>
  <select name="visitor_id" class="form-select mb-3" aria-label="Default select example">
        <?php foreach($data['visitors'] as $value): ?>
            <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
        <?php endforeach; ?>
    </select>
    <?php
    if (isset($_SESSION['errors']['visitor_id'])) {
        $errors = $_SESSION['errors']['visitor_id'];
        include 'validation_error.php';
    }
    ?>
  <label for="book_id" class="form-label">Book</label>
  <select name="book_id" class="form-select mb-3" aria-label="Default select example">
        <?php foreach($data['books'] as $value): ?>
            <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
        <?php endforeach; ?>
    </select>
    <?php
    if (isset($_SESSION['errors']['book_id'])) {
        $errors = $_SESSION['errors']['book_id'];
        include 'validation_error.php';
    }
    ?>
    <?php
    if (isset($_SESSION['errors']['book'])) {
        $errors = $_SESSION['errors']['book'];
        include 'validation_error.php';
    }
    ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>