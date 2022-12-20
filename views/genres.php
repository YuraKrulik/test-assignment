<h1>Genres List</h1>
<a class="btn btn-success" href="/genres/add" role="button">Add Genre</a>
<table class="table">
  <thead>
  <tr>
    <th scope="col">id</th>
    <th scope="col">Name</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($data as $arr): ?>
    <tr>
        <?php foreach($arr as $key=>$value): ?>
          <th scope="row"><?php echo $value ?></th>
        <?php endforeach; ?>
      <th>
        <a class="btn btn-warning" href="/genres/edit/<?php echo $arr['id'] ?>" role="button">edit</a>
      </th>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
