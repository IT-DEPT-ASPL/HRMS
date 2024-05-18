

<?php
// $timestamp = strtotime(($result['log_date']));
	$timestamp = new DateTime(date('Y-m-d H:i:s',strtotime('+11 hours +30 minutes',strtotime($result['log_date']))));
$timestamp = strtotime('2023-11-23 09:55:00');
$formattedDate = date('D d M', $timestamp);

echo $formattedDate;
?>
<?php echo '<br><br>' ?>
  <?php
$timestamp = strtotime('2023-11-23 09:55:00');
$formattedTime = date('h\H i\M', $timestamp);

echo $formattedTime;
?>