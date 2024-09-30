<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (isset($_SESSION['erreurLogin']))
    $erreurLogin = $_SESSION['erreurLogin'];
else {
    $erreurLogin = "";
}
session_destroy();
?>
<! DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!--link rel="stylesheet" type="text/css" href="../css/monstyle.css"-->
    <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
</head>
<body>
    <img src="../images/pinterest-video.gif" style="border-radius: 20px; 
    box-shadow: 0 4px 8px rgba(1, 6, 6, 0.1); 
    width: 1000px;height: 600px;"></img>
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 position">
    <div class="panel panel-primary margetop">
        <div class="header">Se connecter :</div><br><br>
        <div class="panel-body">
            <form method="post" action="seConnecter.php" class="form">

                <?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?>
                    </div>
                <?php } ?>
                <br><br><br><br>
                <div class="form-group">
                    <label for="login " style="color:rgba(47, 217, 240, 0.851);">Login :<br></label>
                    <input type="text" name="login" placeholder="Login"
                           class="form-control " autocomplete="off" style="font-size: 14px;" />
                </div>

                <div class="form-group">
                    <label for="pwd" style="color:rgba(47, 217, 240, 0.851);">Mot de passe :</label>
                    <input type="password" name="pwd"
                           placeholder="Mot de passe" class="form-control " />
                           <i class="fa fa-eye" style="position: absolute;right: 50px;top: 56%;color: #ccc;cursor: pointer;transform: translateY(-50%);"></i>
                     </div>
                <br><br>
                <button type="submit" class="btn text-center">
            </span>
                    Se connecter
                </button>
                </div>
            </form>
            <div class="text-center">
                    <a href="AddUser.php">Créer un compte</a>
                </div>
                <br>
        </div>
    </div>
</div>
<!--script src="../js/login.js">  </script-->
<script src="../js/file.js">  </script>
</body>
</HTML>
