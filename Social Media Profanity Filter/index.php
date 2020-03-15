<?php
session_start();
if(!isset($_SESSION['uname'])){
header('Location: login.html');

}



?>
<html>
<head>
<title>Instant Comment</title>
<style>
body{
	font-family:helvetica;
	background:url(bg.jpg);
}
h1{
	text-align:center;
	margin-top:20px;
	font-size:40px;
	color:red;
	text-shadow: 2px 2px 0px rgba(255,255,255,.7), 5px 7px 0px rgba(0, 0, 0, 0.1); 
}
#profile{
border:1px solid blue;
margin-left:600px;
padding:10px;
width:200px;
text-align:center;
background-color:yellow;

}
#container{
	margin:auto;
	width:38%;
}
#username{
	width:100%;
	height:40px;
	border:1px solid silver;
	margin-top:40px;
	border-radius:5px;
	font-size:17px;
	padding:10px;
	font-family:helvetica;
	margin-bottom:10px;
}
#comment{
	width:100%;
	height:100px;
	border:1px solid silver;
	border-radius:5px;
	font-size:17px;
	padding:10px;
	font-family:helvetica;
}
#submit{
	width:200px;
	height:60px;
	border:none;
	background-color:tomato;
	color:#fff;
	margin-top:20px;
	border-radius:5px;
	font-size:20px;
	border-bottom:6px solid #E90003;
	margin-left:140px;
}
.comment_div
{
	width:500px;
	text-align:left;
	margin:20px auto;
	background:#F3F3F3;
	text-align:center;
}
.name{
	height:30px;
	line-height:30px;
	padding:8px;
	background:#fff;
	color:#777;
	text-align:left;
}
.comments{
	padding:0px 0px 24px 0px;
	font-size:20px;	
}
</style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">
function post()
{
  var comment = document.getElementById("comment").value;
  var commentarr = comment.split(" ");
  var abuse = ["idiot","lunatic","bad","bastard","arrogant","dirty","dumbass","crazy","porn","kiss","weed","smoke","drugs"];
  
  for(var i=0;i<commentarr.length;i++)
{
for (var j=0;j<abuse.length;j++)
{
if (commentarr[i].toUpperCase()===abuse[j].toUpperCase())
{

commentarr[i] = commentarr[i].replace(abuse[j],'*****');


}
}

}
comment = commentarr.join(' ').toString();

  if(comment)
  {
    $.ajax
    ({
      type: 'post',
      url: 'post_comments.php',
      data: 
      {
         user_comm:comment,
         
      },
      success: function (response) 
      {
	    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	    document.getElementById("comment").value="";
  
      }
    });
  }
  
  return false;
}
</script>
</head>

<body>

  <h1>REAL TIME COMMENT FILTERING AND MONITORING SYSTEM</h1>
  <div id= "profile">
  <?php
  echo"Your Username : ";
echo($_SESSION['uname']);
echo"<br><br>";
echo"Your Fullname : ";
echo $_SESSION['fullname'];
  ?>
  </div>
  <br><hr>

  <form method='post' action="" onsubmit="return post();" id="container">
	  <textarea id="comment" placeholder="Write Your Comment Here....."></textarea>  
	  <input type="submit" value="Post Comment" id="submit">
  </form>

  <div id="all_comments">
  <?php
require_once("config.php");
        
  $current_ability_query = mysqli_query($conn,"select ability from user where fullname = '$name'");
  $old_violation_query = mysqli_query($conn, "select violationcount from user where fullname = '$name'");
  $old_violation_queryrow = mysqli_fetch_array($old_violation_query, MYSQLI_ASSOC);
  $old_violation_value = $old_violation_queryrow['violationcount'];

          if ($current_ability_query == "allowed" && $old_violation_value >10)
  {
  $update_ability_query = mysqli_query($conn, "update user set ability = 'disabled' where fullname = '$name'");
  header('Location: banned.php');
  
  }
  else{
  
  $current_violation_value = substr_count($comment, "*****");
  $new_violation_value = $old_violation_value + $current_violation_value;
  $penalty = 100*$new_penalty_value;
  $_SESSION['violationcount'] = $new_violation_value;
  }
  
  $update_violationcount_query = mysqli_query($conn,"update user set violationcount = '$new_violation_value',penalty = '$penalty' where fullname = '$name'");
    $comm = mysqli_query($conn,"select name,comment,post_time from comments order by id desc");
    while($row=mysqli_fetch_array($comm))
    {
	  $name=$row['name'];
	  $comment=$row['comment'];
      $time=$row['post_time'];
    ?>
	
<div class="comment_div"> 
 <p class="name"><strong>Posted By:</strong> <?php echo $name;?>(Violation count :<?php echo $new_violation_value;?> )<span style="float:right"><?php echo date("j-M-Y g:ia", strtotime($time)) ?></span></p>
 <p class="comments"><?php echo $comment;?></p>	
</div>
  
    <?php
    }
    ?>
    
    <a color="yellow" href="logout.php">LOGOUT X </a>
  </div>

</body>
</html>