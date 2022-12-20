<h1>Books list</h1>
<a class="btn btn-success" href="/books/add" role="button">Add Book</a>
<table class="table">
  <thead>
  <tr>
    <th scope="col">id</th>
    <th scope="col">Name</th>
    <th scope="col">Author</th>
    <th scope="col">Release Year</th>
    <th scope="col">Genre</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($data as $arr): ?>
    <tr>
        <?php foreach($arr as $key=>$value): ?>
          <th scope="row"><?php echo $value; ?></th>
        <?php endforeach; ?>
      <th scope="row">
        <a class="btn btn-warning" href="/books/edit/<?php echo $arr['id'] ?>" role="button">edit</a>
      </th>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
