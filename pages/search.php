
<?php
require_once("session.php");
require_once("connexiondb.php");

if(isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];
    $query = "SELECT * FROM utilisateur WHERE login LIKE ?";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$searchTerm%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $outgoing_id = isset($_SESSION['outgoing_id']) ? $_SESSION['outgoing_id'] : null;

    foreach($results as $row) {
        echo '<img src="../images/' . $row['img'] . '" style="width:40px;height:40px;">' ;
        echo "<span >" . $row['login'] . "</span><br>";

        // Fetching the last message between the current user and the searched user
        $iduser = $row['iduser'];
        $requeteMsg = "SELECT * FROM messages WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :iduser) OR (outgoing_msg_id = :iduser AND incoming_msg_id = :outgoing_id) ORDER BY msg_id DESC LIMIT 1";
        $stmtMsg = $pdo->prepare($requeteMsg);
        $stmtMsg->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
        $stmtMsg->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $stmtMsg->execute();
        $rowMsg = $stmtMsg->fetch(PDO::FETCH_ASSOC);

        // Check if a message is available
        $msg = ($rowMsg) ? $rowMsg['msg'] : "No message available";

        // Checking if the user is the outgoing user
        $you = "";
        if (!empty($rowMsg['outgoing_msg_id']) && $outgoing_id == $rowMsg['outgoing_msg_id']) {
            $you = "You: ";
        }

        // Construction de la sortie
        echo '<a href="chatarea.php?iduser=' . $row['iduser'] . '">  <p>' . $msg. '</p> </div>';
    }
} else {
    echo "Paramètre de recherche non défini.";
}

?>
