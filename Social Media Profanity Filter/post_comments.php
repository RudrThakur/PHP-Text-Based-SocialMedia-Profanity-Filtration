<?php
ob_start();
session_start();
require_once('config.php');

$name = $_SESSION['fullname'];

if(isset($_POST['user_comm']))
{
  $comment=$_POST['user_comm'];
  
 $old_violation_query = mysqli_query($conn, "select violationcount from user where fullname = '$name'");
  $old_violation_queryrow = mysqli_fetch_array($old_violation_query, MYSQLI_ASSOC);
  $old_violation_value = $old_violation_queryrow['violationcount'];
   
  
  if ($old_violation_value >10)
  {
  $update_ability_query = mysqli_query($conn, "update user set ability = 'disabled' where fullname = '$name'");
  header('Location: banned.php');
  
  }
  
  else{

  $current_violation_value = substr_count($comment, "*****");
  $new_violation_value = $old_violation_value + $current_violation_value;
  
  $update_violationcount_query = mysqli_query($conn,"update user set violationcount = '$new_violation_value' where fullname = '$name'");
          
  $insert=mysqli_query($conn,"insert into comments (name,comment,post_time) values('$name','$comment',CURRENT_TIMESTAMP)");
  
  $id=mysqli_insert_id($conn);

  
  
  
  $select=mysqli_query($conn,"select name,comment,post_time from comments where name='$name' and comment='$comment'");
  
  $old_violation_query = mysqli_query($conn, "select violationcount from user where fullname = '$name'");
  $old_violation_queryrow = mysqli_fetch_array($old_violation_query, MYSQLI_ASSOC);
  $old_violation_value = $old_violation_queryrow['violationcount'];
  
  $current_violation_value = substr_count($comment, "*****");
 /* $new_violation_value = $old_violation_value + $current_violation_value;*/
  
  $update_violationcount_query = mysqli_query($conn,"update user set violationcount = '$new_violation_value' where fullname = '$name'");
  
  }
  
  if($row=mysqli_fetch_array($select, MYSQLI_ASSOC))
  {
	  $fullname=$row['name'];
	  $comment=$row['comment'];
      $time=$row['post_time'];
  ?>
<div class="comment_div"> 
 <p class="name"><strong>Posted By:</strong> <?php echo $name;?>(Violation count :<?php echo $new_violation_value;?> )<span style="float:right"><?php echo date("j/m/Y g:ia", strtotime($time)) ?></span></p>
 <p class="comments"><?php echo $comment;?></p>	
</div>
  <?php
  }
exit;
}

?>