<h1>Books list</h1>
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
          <th scope="row"><?php echo $value ?></th>
        <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
