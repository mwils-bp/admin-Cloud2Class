<div class="end_lesson">
<?php
$link= mysqli_connect("cpd-db","cpd","dkfj55.1","cpd");
$qw = "select * from pool where pool_ref = '{$_POST['pool_ref']}'";
$resw = mysqli_query($link, $qw);
$rows = mysqli_fetch_row($resw);
$pool_id = $rows[0];

if(isset($pool_id)){
$q = "select * from lesson where pool_id = {$pool_id}";
$res = mysqli_query($link, $q);
$row = mysqli_fetch_row($res);  
$started = $row[2];
$minutes = (int)$row[3];
$lesson_id = (int)$row[4];
$shell_user = $row[5];
$shell_pass = $row[6];
?>
<input type="hidden" id="pool_ref" value="<?php echo $_POST['pool_ref']; ?>"/>
 <h1><a href="#" class="gobacktopools"><b style="float:left;" class="glyphicon glyphicon-arrow-left"></b></a>Lesson Details <b>(<?php echo $_POST['pool_ref']; ?>)</b>
<?php
$me = (int)$_POST['user_id'];
$owner = (int)$row[0];
?>
<a id="menu-toggle" href="#" class="btn btn-success"><i class="glyphicon glyphicon-align-right"></i></a></h1>
<hr>
<?php echo "<code>username is: {$shell_user}</code><br><code>password is: {$shell_pass}</code>"; ?>
 <h3>Started At:<br> <?php echo date("H:i a", strtotime($started)); ?></h3>
 <h3>Finished At:<br>

<?php
$finished = strtotime("+".$minutes." minutes", strtotime($started));
$ttl = date("H:i a", $finished); 
echo $ttl;

$current = date("H:i:s");
$time_now = strtotime($current);
$diff = $finished - $time_now;
?>   
</h3>
<div id="CountDownTimer<?php if ($diff > 60) { echo "Hourly"; } ?>" data-timer="<?php echo $diff; ?>" style="width:361px; height: 180px; margin-left:auto; margin-right:auto;"></div>
</div>
<?php
if($owner == $me){
?>
  <button type="button" class="btn btn-primary" data-toggle="button">give me 30 more minutes</button>
  <button type="button" id="end_lesson" class="btn btn-danger" data-toggle="button">end</button>
<?php
} else {
echo "";
}
if($diff > 0){
}elseif($diff <= 0){
}
?>
</div>
<?php
}
?>
