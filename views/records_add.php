<form method="post">
  <label for="visitor_id" class="form-label">Visitor</label>
  <select name="visitor_id" class="form-select mb-3" aria-label="Default select example">
        <?php foreach($data['visitors'] as $value): ?>
            <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
        <?php endforeach; ?>
    </select>
  <label for="book_id" class="form-label">Book</label>
  <select name="book_id" class="form-select mb-3" aria-label="Default select example">
        <?php foreach($data['books'] as $value): ?>
            <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>