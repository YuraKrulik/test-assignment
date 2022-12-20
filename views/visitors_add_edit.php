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
    <div class="mb-3">
        <label for="surname" class="form-label">Last Name</label>
        <input name='surname' type="text" class="form-control" id="surname" value="<?php echo $data['surname'] ?? ''?>">
        <?php
        if (isset($_SESSION['errors']['surname'])) {
            $errors = $_SESSION['errors']['surname'];
            include 'validation_error.php';
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="email" value="<?php echo $data['email'] ?? ''?>">
        <?php
        if (isset($_SESSION['errors']['email'])) {
            $errors = $_SESSION['errors']['email'];
            include 'validation_error.php';
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $data['phone'] ?? ''?>">
        <?php
        if (isset($_SESSION['errors']['phone'])) {
            $errors = $_SESSION['errors']['phone'];
            include 'validation_error.php';
        }
        ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>