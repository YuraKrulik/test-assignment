<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" value="<?php echo $data['name'] ?? ''?>">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Last Name</label>
        <input name='surname' type="text" class="form-control" id="surname" value="<?php echo $data['surname'] ?? ''?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="email" value="<?php echo $data['email'] ?? ''?>">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $data['phone'] ?? ''?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>