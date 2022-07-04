<?php

use RenanRoble\Exads\ABTesting;

try {
    $abTesting = new ABTesting($_GET['promoId']);
    $design = $abTesting->getDesign($_GET['id']);
} catch (\Throwable $th) {
    header('Location: /?page=error404');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $design['designName'] ?></title>
    <style>
        body {
            background: #f4f4f4;
            padding: 0;
            margin: 0;
            font-family: monospace;
        }

        .ad-exads {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: calc(100% + 2px);
            height: 100vh;
            background-color: #05a8f7 !important;
            color: #fff;
            position: relative;
        }

        .ad-label {
            position: absolute;
            top: 0;
            right: 0;
            padding: 3px 5px;
            color: #666;
            border-radius: 0 0 0 7px;
            background: rgba(255, 255, 255, 0.35);
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ad-exads">
        <span class="ad-label">EXADS Ads</span>
        <h1><?= $design['designName'] ?></h1>
        <h2>Split Percent: <?= $design['splitPercent'] ?></h3>
    </div>
</body>

</html>