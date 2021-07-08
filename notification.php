<!doctype html>
<html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- NOTIFICATION -->
<?php
$id = $_SESSION['id'];

if(isset($_POST['submit'])){
  $stmt = $con->prepare("UPDATE `notification` SET read_status=1 WHERE receiver_id=?");
  $stmt->bind_param("i",$_POST['receiver_id']);
  $stmt->execute();
}

if(isset($_GET['notifID'])){
  $notiID = base64_decode(urldecode($_GET['notifID']));
  $stmt = $con->prepare("UPDATE `notification` SET read_status=1 WHERE id=?");
  $stmt->bind_param("i",$notiID);
  $stmt->execute();
}

$stmt = $con->prepare("SELECT * FROM `notification` WHERE receiver_id =? ORDER BY time DESC LIMIT 25");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$count = 0;
$style=' ';
$output='<div class="drop-content">';
while($row = $result->fetch_assoc()){

  $noti_id = $row['id'];
  $type = $row['type'];
  $content = $row['content_id'];
  $readStatus = $row['read_status'];
  $date = date_create($row['time']);
  $postBy = '';
  $link='';
  $pic = '';
  //change color of noti and count number of unread status
  if($readStatus==0){
      $seen = 'notification-box bg-gray';
      $count+=1;
  }else if($readStatus==1){
      $seen = 'notification-box';
  }

  //display date and time
  $time = date_format($date, 'G:i');
  $curr_date = date_create(date('Y-m-d H:i:s'));

  $date_diff = date_diff($date, $curr_date);
  $day_diff = $date_diff->format("%a");
  if($day_diff>7){
      $day = date_format($date, 'm M');
  }else if($day_diff>=2 && $day_diff<=7){
      $day = date_format($date, 'D');
  }
  else if($day_diff>1 && $day_diff<2){
      $day = 'Yesterday';
  }
  else{
      $day = 'Today';
  }

  //check for content event
  if($type == 'event'){
      $stmt = $con->prepare("SELECT `title`, `photo`  FROM `event` WHERE id=?");
      $stmt->bind_param("i", $content);
      $stmt->execute();
      $eventResult = $stmt->get_result();
      $stmt->close();
      //if event does not exist
      if(!( $event = $eventResult->fetch_assoc())){
        continue;
      }

      $postBy = 'FSKTM Admin posted an event';
      $text = $event['title'];
      $pic = '../images/event/'.$event['photo'];
      $link = '../alumni/eventdetail.php?eventID='.$content.'&notifID='.urlencode(base64_encode($noti_id));
  }
  //check for content friend
  else if($type == 'request' ||$type == 'acceptFriend' || $type == 'rejectFriend'){
      $stmt = $con->prepare("SELECT `title`, `fullname`, `profile_pic`  FROM `alumni_profile` WHERE alumni_id=?");
      $stmt->bind_param("i", $content);
      $stmt->execute();
      $friendResult = $stmt->get_result();
      $stmt->close();
      //if user does not exist
      if(!($friend = $friendResult->fetch_assoc())){
        continue;
      }

      $title = $friend['title'];
      $name = $friend['fullname'];
	  if ($friend['profile_pic']==NULL){
				$friend['profile_pic']='default.png';
			}
      $pic = '../images/profileimg/'.$friend['profile_pic'];

      //link to friend request tab
      $link  = '../alumni/friendRequest.php?notifID='.urlencode(base64_encode($noti_id));

      //check if alumni has title
      if(!isset($title)){
          $postBy = $name;
      }
      else{
          $postBy = $title.' '.$name;
      }
      
      //check whether accepted or requested
      if($type == 'request'){
          $text = 'Sent you a friend request';
      }
      else if($type == 'acceptFriend'){
          $text = 'Accepted your friend request';
      }else if($type == 'rejectFriend'){
          $text = 'Rejected your friend request';
      }
  }else{
      $text ='Notification not found';
  }

  $output .= '
  <li class="'.$seen.' seen"  data-id="'.$noti_id.'" onclick="location.reload();location.href = \''.$link.'\'">
  <div class="row mb-3" type="submitNoti">
    <div class="col-lg-3 col-sm-3 col-3 img-position">
      <img src="'.$pic.'" class="image-cover">
    </div>    
    <div class="col-lg-8 col-sm-8 col-8">
      <strong class="text-info"> '.$postBy.' </strong>
      <div>
        '.$text.'
      </div>
      <small style="color: grey;"> <i>'.$day.' at '.$time.'</i></small>
    </div> 
  </div>
  </li>';

}

//for displaying notification(3)
if($count==0){
  $displayCount = '';
}else{
  $displayCount = '('.$count.')';
}

$header='
<li class="head text-light bg-dark">
<div class="row">
<div class="col-lg-12 col-sm-12 col-12">
<form action="" method="post">
<div class="form-inline flex-box mt-2 mb-2 ml-2 mr-2">
<label>Notification'.$displayCount.'</label>
<input type="text" name="receiver_id" value="'.$id.'" hidden/>
<button onclick="location.reload()" name="submit" type="submit" class="btn btn-secondary btn-sm ml-5"  style="float: right;">Mark all as read</button>
</div>
</form>
</div>
</div>
</li>';

$overall = $header.$output.'</div>';  

if ($count == 0){
  $style = 'background-color: transparent; color:transparent;';
}

?>
            <div style="float: right;">
                <a href="#" style="border:0; text-decoration:none; outline:none;margin: 0;padding: 0;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="icon"><i style="border:0; text-decoration:none; outline:none;" class="bell fa fa-bell"></i><span class="noti badge" id="count" style="<?php echo $style ?>"><?php echo $count ?></span></div>
				        </a>
                  <div class="dropdown-menu">
                    <?php echo $overall ?>
                  </div>
            </div>
 <!-- NOTIFICATION ENDS -->

<script>

$(document).ready(function(){
  var count = <?php echo $count ?>;
  
 function load_unseen_notification()
 {
  
  $.ajax({
   url:'../notificationFetch.php',
   method:"POST",
   data:{user:<?php echo $id ?>},
   error: function (jqXHR, textStatus, errorThrown) {
    //alert(textStatus);
    },
   success:function(data)
   { 
    var json = JSON.parse(data);
    var unread = json.unread;
  if(count!= unread){
    $('.dropdown-menu').html(json.notification);
    console.log(true);
    if(unread > 0)
    {
      if(document.getElementById("count").hasAttribute("style")){
        document.getElementById("count").removeAttribute("style");
      }
      document.getElementById("count").innerText = unread;
    }else if(unread == 0){
      document.getElementById("count").setAttribute("style", "background-color: transparent; color:transparent;");
    }
  }

  if(count== 0 && unread == 0){
    document.getElementById("count").setAttribute("style", "background-color: transparent; color:transparent;");
  }
   }
   
  });
 }

 setInterval(function(){ 
  load_unseen_notification();
 }, 5000);
});
</script>
</html>
