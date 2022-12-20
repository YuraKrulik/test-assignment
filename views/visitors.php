<h1>Visitors List</h1>
<a class="btn btn-success" href="/visitors/add" role="button">Add Visitor</a>
<table class="table">
  <thead>
  <tr>
    <th scope="col">id</th>
    <th scope="col">Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">Email</th>
    <th scope="col">Phone</th>
  </tr>
  </thead>
  <tbody>
    <?php foreach($data as $arr): ?>
    <tr>
        <?php foreach($arr as $key=>$value): ?>
          <th scope="row"><?php echo $value ?></th>
        <?php endforeach; ?>
      <th>
        <a class="btn btn-warning" href="/visitors/edit/<?php echo $arr['id'] ?>" role="button">edit</a>
      </th>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
