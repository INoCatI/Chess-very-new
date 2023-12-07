<?php
require_once('engine/chess_game.php');

$human_color = $_POST['human_color']; // 

$game = new ChessGame();
$game->createNewGame($human_color);
$data = $game->getClientJsonGameState();
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);