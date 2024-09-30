<?php
require_once("session.php");
require_once("connexiondb.php");


$outgoing_id = isset($_SESSION['outgoing_id']) ? $_SESSION['outgoing_id'] : null;
$output = '';
    // Récupération des paramètres de pagination et de recherche
    $login = isset($_GET['login']) ? $_GET['login'] : "";
    $size = isset($_GET['size']) ? $_GET['size'] : 5;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $size;

    // Requête principale pour récupérer les utilisateurs
    $requeteUser = "select * from utilisateur where login like :login limit $offset, $size";
    $stmtUser = $pdo->prepare($requeteUser);
    $stmtUser->bindValue(':login', "%$login%", PDO::PARAM_STR);
    $stmtUser->execute();

    // Requête pour compter le nombre total d'utilisateurs
    $requeteCount = "select count(*) as nbUser from utilisateur";
    $stmtCount = $pdo->query($requeteCount);
    $tabCount = $stmtCount->fetch();
    $nbrUser = $tabCount['nbUser'];

    // Requête pour récupérer le dernier message de chaque utilisateur
    $requeteMsg = "SELECT u.iduser, u.login, u.img, m.msg, m.outgoing_msg_id, m.incoming_msg_id, m.msg_id FROM (SELECT * FROM messages WHERE outgoing_msg_id = :iduser OR incoming_msg_id = :iduser ORDER BY msg_id DESC) m INNER JOIN utilisateur u ON m.outgoing_msg_id = u.iduser OR m.incoming_msg_id = u.iduser GROUP BY u.iduser";
    $stmtMsg = $pdo->prepare($requeteMsg);
    $stmtMsg->bindParam(':iduser', $iduser, PDO::PARAM_INT);

    // Affichage des utilisateurs et de leur dernier message
    while ($rowUser = $stmtUser->fetch(PDO::FETCH_ASSOC)) {
        $iduser = $rowUser['iduser'];
        $stmtMsg->execute();
        $rowMsg = $stmtMsg->fetch(PDO::FETCH_ASSOC);

        // Vérification de l'existence du message
        $result = ($stmtMsg->rowCount() > 0) ? $rowMsg['msg'] : "no message available";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

        // Vérification de l'identité de l'utilisateur actuel
        $you = "";
        if (!empty($rowMsg['outgoing_msg_id'])) {
            if ($outgoing_id == $rowMsg['outgoing_msg_id']) {
                $you = "You:";
            }
        }

        // Vérification du statut en ligne/hors ligne
        $offline = ($rowUser['status'] == "offline now") ? "offline" : "";

        // Construction de la sortie
        $output .= '<a href="chat.php?userid=' . $rowUser['iduser'] . '"> <div class="content"> <img src="../images/' . $rowUser['img'] . '" alt="' . $rowUser['login'] . '"> <p>' . $you . $msg . '</p> </div> <div class="status-dot"></div> </a>';
    }

   
?>
