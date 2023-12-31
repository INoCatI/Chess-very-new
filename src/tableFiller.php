<?php
session_start();
require_once("connection.php");
if(isset($_SESSION['userid'])){
    $userId = $_SESSION['userid'];
    $sql = "SELECT 
    CASE 
        WHEN c.white IS NULL THEN 'User' 
        ELSE 'White'
    END AS Color,
    c.result AS Result,
    c.moves_number AS MovesNumber,
    c.time AS StartTime,
    CASE 
        WHEN c.black IS NULL THEN 'User' 
        ELSE 'Black'
    END AS Opponent
FROM 
    Consignments c
WHERE 
    c.white = $userId OR c.black = $userId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
    // Выводим информацию о партиях в таблицу
    while ($row = $result->fetch_assoc()) {
        if($row['Color'] == "White" && $row['Result'] == "w"){
            $row['Result'] = "Победа";
        }else if($row['Result']){
            $row['Result'] = "Ничья";
        }else{
            $row['Result'] = "Поражение";
        }
        echo '<tr>';
        echo '<td>' . $row['Color'] . '</td>';
        echo '<td>' . $row['Result'] . '</td>';
        echo '<td>' . $row['MovesNumber'] . '</td>';
        echo '<td>' . $row['StartTime'] . '</td>';
        echo '<td>' . $row['Opponent'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">Нет данных о партиях для этого пользователя.</td></tr>';
}
}
?>
