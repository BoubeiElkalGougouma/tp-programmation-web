<?php
    echo "<h1>Réception des données</h1>";

    if (isset($_GET['data'])) {

        $data_recue = unserialize(urldecode($_GET['data']));

        echo "Voici le contenu du tableau reçu : <br>";
        echo "<pre>";
        print_r($data_recue); 
        echo "</pre>";
    } else {
        echo "Aucune donnée n'a été transmise.";
    }
?>
<br>
<a href="index.php">Retour au formulaire</a>