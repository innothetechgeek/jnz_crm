
<h4> My Leads </h4>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Id Number</th>
      <th scope="col">Signed Up For</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php foreach($leads as $key => $lead) { ?>
      <th scope="row"><?=$lead['name']?></th>
      <td><?=$lead['email']?></td>
      <td><?=$lead['phonenumber']?></td>
      <td><?=$lead['idnumber']?></td>
      <td>-</td>
    <?php } ?>
    </tr>
  </tbody>
</table>

