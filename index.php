<?php
session_start();
require_once 'routeClient.php';

if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit;
}

$token = $_SESSION['token'];

// Récupérer les stats via l'API
$response = routeClient::getStatistiques($token);
$stats    = $response['data']['stats']   ?? [];
$players  = $response['data']['players'] ?? [];

// Mapper les variables pour les cartes
$playerCount   = $stats['totalJoueurs'] ?? 0;
$injuredCount  = 0;
foreach ($players as $p) {
    if (stripos($p['Statut'] ?? '', 'bles') !== false) $injuredCount++;
}
$wins         = $stats['victoires']    ?? 0;
$totalMatches = $stats['totalMatchs']  ?? 0;

// Prochain match (plus proche futur)
$nextMatch = null;
$now = new DateTime();
foreach ($players as $m) {
    if (!empty($m['nextMatchDate'])) {
        $matchDate = new DateTime($m['nextMatchDate']);
        if ($matchDate > $now && (!$nextMatch || $matchDate < new DateTime($nextMatch['nextMatchDate']))) {
            $nextMatch = $m;
        }
    }
}

// Si vous avez un vrai champ "prochain match" dans $stats, utilisez-le
$nextMatchDate = $stats['nextMatchDate'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Joueurs - Accueil</title>
    <link rel="icon" type="image/png" href="/Vue/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Vue/CSS/common.css">
    <link rel="stylesheet" href="Vue/CSS/index.css">
</head>
<body>
    <?php include 'Vue/Afficher/navbar.php'; ?>

    <!-- Section des statistiques -->
    <div class="container my-5">
        <div class="row g-4 mb-5">
            <!-- Joueurs enregistrés -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="stat-number"><?= $playerCount ?></h3>
                    <p class="stat-label">Joueurs Enregistrés</p>
                </div>
            </div>

            <!-- Joueurs blessés -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon">
                        <img src="Vue/img/infirmary.svg" alt="Infirmerie" style="width:48px;height:48px;" />
                    </div>
                    <h3 class="stat-number"><?= $injuredCount ?></h3>
                    <p class="stat-label">Joueurs Blessés</p>
                </div>
            </div>

            <!-- Matchs gagnés / total -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h3 class="stat-number"><?= $wins ?>/<?= $totalMatches ?></h3>
                    <p class="stat-label">Matchs gagnés / Total</p>
                </div>
            </div>

            <!-- Prochain match -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>
                    <h3 class="stat-number">
                        <?php
                        if (!empty($nextMatchDate)) {
                            echo date('d/m/y H:i', strtotime($nextMatchDate));
                        } else {
                            echo 'Aucun';
                        }
                        ?>
                    </h3>
                    <p class="stat-label">Prochain Match</p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'Vue/Afficher/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>