<?php

function materii_profesor()
{
    session_start();
    include 'grades_classification.php';
    include 'db.php';
    $DB = new db();

    if (!isset($_SESSION['email'])) {
        $arr = array('error' => 'You must be logged in !');
        echo json_encode($arr);
        die();
    }
    $query = "SELECT materie.id, denumire FROM materie INNER JOIN profesor WHERE materie.profesor_id=profesor.id AND profesor.username='" . $_SESSION['email'] . "'";
    $stmt = $DB->execute_SELECT($query);
    $materii = array();
    if (count($stmt) == 0) {
        $arr = array('Error' => 'No Records found!');
        echo json_encode($arr);
        die();
    } else {
        foreach ($stmt as $row) {
            $materii[] = array('id' => $row['id'], 'denumire' => $row['denumire'], 'email' => $_SESSION['email']);
        }
        echo json_encode($materii);
    }
}
?>