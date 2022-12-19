<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input name='author' type="text" class="form-control" id="author">
    </div>
    <div class="mb-3">
        <label for="release_year" class="form-label">Release Year</label>
        <input name="release_year" type="number" class="form-control" id="release_year">
    </div>

  <label for="genre_id" class="form-label">Genre</label>
  <select name="genre_id" class="form-select mb-3" aria-label="Default select example" id="genre_id">
        <?php foreach($data as $genre): ?>
          <option value="<?php echo $genre['id']?>"><?php echo $genre['name']?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>