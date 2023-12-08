<?php
$whitePlayerProfileID = $_POST['whitePlayerProfileID']; // ID профиля белого игрока
$blackPlayerProfileID = $_POST['blackPlayerProfileID']; // ID профиля черного игрока
$result = $_POST['result']; // Результат партии (например, "Победа белых")
$time = $_POST['time']; // Время партии
$movesNumber = $_POST['movesNumber']; // Количество ходов

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения на ошибки
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-запрос для вставки результата партии в таблицу Сonsignments
$stmt = $conn->prepare("INSERT INTO Сonsignments (white, black, result, time, moves_number) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iissi", $whitePlayerProfileID, $blackPlayerProfileID, $result, $time, $movesNumber);

if ($stmt->execute()) {
    echo "Результат партии успешно сохранен в базе данных";
} else {
    echo "Ошибка при сохранении результата партии: " . $stmt->error;
}

// Закрытие подготовленного запроса и соединения с базой данных
?>
