<?php

session_start();
require_once("connexiondb.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['outgoing_id'])) {
    echo "Utilisateur non connecté.";
    exit; // Arrêter l'exécution du script si l'utilisateur n'est pas connecté
}
$login = isset($_POST['login']) ? $_POST['login'] : "";
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
$requete = "select * from utilisateur where login='$login' and pwd=MD5('$pwd')";

$resultat = $pdo->query($requete);
$user = $resultat->fetch();
if ($user !== false) {
    $_SESSION['outgoing_id'] = $user['iduser'];
} else {

/****echo '<img src="../images/' . $row['img'] . '" style="width:40px;height:40px;">' ; */
    if(isset($_POST['incoming_id'])) {
        $incoming_id = $_POST['incoming_id'];
        
        // Vérifier si l'utilisateur est connecté
        if(isset($_SESSION['outgoing_id'])) {
            $outgoing_id = $_SESSION['outgoing_id'];
    
            $query = "SELECT * FROM messages WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id) OR (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id) ORDER BY msg_id ASC";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $output = "";
    
            foreach ($messages as $message) {
    $message_class = ($message['outgoing_msg_id'] == $outgoing_id) ? "outgoing" : "incoming";
    $you = ($message['outgoing_msg_id'] == $outgoing_id) ? "You: " : "";
    
    if ($message_class == "incoming") {
        // Récupérer le chemin d'accès à l'image de la personne qui a envoyé le message
        $query = "SELECT img FROM utilisateur WHERE iduser = :outgoing_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':outgoing_id', $message['outgoing_msg_id'], PDO::PARAM_INT);
        $stmt->execute();
        $sender_image = $stmt->fetchColumn();
        
        $output .= '<div class="chat ' . $message_class . '">';
       
        $output .= '<div class="details col-md-6">';
        $output .= '<img src="' . $sender_image . '" alt="Profil Image"  style="float: left; margin-right: 10px;">';
        $output .= '<p style="float: left; margin-right: 10px;">' . $you . $message['msg'] . '</p>';
        $output .= '</div>';
        
        $output .= '</div>';
    } else {
        $output .= '<div class="chat ' . $message_class . '">';
        $output .= '<div class="details">';
        $output .= '<p>' . $you . $message['msg'] . '</p>';
        $output .= '</div>';
        $output .= '</div>';
    }
}

echo $output;
           
        } else {
            echo "Utilisateur non connecté.";
        }
    } else {
        echo "Aucun identifiant entrant spécifié.";
    }
    
     
}
?>

