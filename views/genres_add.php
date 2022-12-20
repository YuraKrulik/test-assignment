<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" value="<?php echo $data['name'] ?? ''?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>