<?php
require_once("session.php");
require_once('connexiondb.php');
$incoming_id_from_url =isset($_GET['iduser']) ? $_GET['iduser'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/chatstyle.css">
    
    <title>CahtArea</title>
</head>
<body>
<div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="userChatApp.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="<?php echo $_SESSION['user']['img'] ?>">
            <div class="details">
			<span><?php echo  ' '.$_SESSION['user']['login']?> </span>
            <p>active now</p>
                </div>
            
</header>
<div class="chat-box " style="overflow-y:scroll;">
    
</div>
<form action="insertdatachat.php" class="typing-area">
    <input type="hidden" name="incoming_id" value="<?php echo $incoming_id_from_url; ?>"> 
    <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['user']['iduser']; ?>">
    <input type="text" name="message" placeholder="Type a message...">
    <button><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</form>
</section>
</div>
<script src="../js/chat.js"></script>
</body>
</html>
