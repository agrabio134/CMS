

<h1>THIS IS THE CONNECTION FROM SECOND DATABASE</h1>


<table>
  <tr>
    <th>ID</th>
    <th>Event</th>
    <th>Time</th>
  </tr>
  <?php foreach ($events as $event): ?>
    <tr>
      <td><?php echo $event['id']; ?></td>
      <td><?php echo $event['event_name']; ?></td>
      <td><?php echo $event['time']; ?></td>
      
    </tr>
  <?php endforeach; ?>

</table>