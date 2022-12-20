<h1>Records list</h1>
<a class="btn btn-success" href="/records/add" role="button">Add Record</a>
<table class="table">
  <thead>
  <tr>
    <th scope="col">id</th>
    <th scope="col">Visitor</th>
    <th scope="col">Book</th>
    <th scope="col">Issue Date</th>
    <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($data as $arr): ?>
    <tr>
      <?php foreach($arr as $key=>$value): ?>
        <th scope="row"><?php echo $value ?></th>
      <?php endforeach; ?>
      <th>
        <form action="/records/edit/<?php echo $arr['id'] ?>" method="POST">
          <a class="btn btn-warning" onclick="this.parentNode.submit()" href="#" role="button">Return Book</a>
        </form>
      </th>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
