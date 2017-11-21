<?php
include('../autoload.php');

$npcobj     = new npc();
$npcs       = $npcobj->ListarSemImagens();

header('Content-Type: application/json');
echo json_encode($npcs);
?>