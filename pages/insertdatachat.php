
<?php
require_once("session.php");
require_once('connexiondb.php');

// Récupération des données du formulaire
$incoming_id = isset($_POST['incoming_id']) ? $_POST['incoming_id'] : 0; 
$outgoing_id = isset($_POST['outgoing_id']) ? $_POST['outgoing_id'] : 0;
$message = isset($_POST['message']) ? $_POST['message'] : "";

if(!empty($message)){
    // Vérifiez que $outgoing_id n'est pas vide avant d'exécuter la requête d'insertion
    
        $requete = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (?, ?, ?)";
        $params = array($incoming_id,$outgoing_id,$message);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location: chatarea.php');
        exit(); // Ajout d'un exit après la redirection
   
} else {
    echo "Le champ du message est vide.";
}
?>
