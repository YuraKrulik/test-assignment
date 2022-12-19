<h1>Records list</h1>
<a class="btn btn-success" href="/records/add" role="button">Add Record</a>
<table class="table">
  <thead>
  <tr>
    <th scope="col">id</th>
    <th scope="col">Visitor</th>
    <th scope="col">Book</th>
    <th scope="col">Issue Date</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach($data as $arr): ?>
    <tr>
        <?php foreach($arr as $key=>$value): ?>
          <th scope="row"><?php echo $value ?></th>
        <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
