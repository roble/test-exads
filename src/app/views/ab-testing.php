<?php

use RenanRoble\Exads\ABTesting;

include('includes/header.php');
include('includes/back.php');

$promoId = rand(1, 3);

try {
    $abTesting = new ABTesting($promoId);
    $designs = $abTesting->getAllDesigns();
} catch (\Throwable $th) {
    header('Location: /?page=error404');
}

$design = $abTesting->pickRandomDesign();
$url   = $abTesting->getDesignUrl($design['designId']);

?>

<h1>4. A/B Testing</h1>
<p>
    Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
    Write a snippet of PHP code that redirects end users to the different designs based on the data
    provided by this library: <a href="https://packagist.org/packages/exads/ab-test-data" target="_blank">packagist.org/exads/ab-test-data</a>
</p>
<p>
    The data will be structured as follows:
</p>
<pre>
“promotion” => [
    “id” => 1,
    “name” => “main”,
    “designs” => [
        [ “designId” => 1, “designName” => “Design 1”, “splitPercent” => 50 ],
        [ “designId” => 2, “designName” => “Design 2”, “splitPercent” => 25 ],
        [ “designId” => 3, “designName” => “Design 3”, “splitPercent” => 25 ],
    ]
]
</pre>
<p>
    The code needs to be object-oriented and scalable. The number of designs per promotion may vary.
</p>
<hr />
<h2>Result:</h2>
<h3>Promotion generated randomly from 1 to 3: <?= $abTesting->getPromotionName() ?></h3>
<h3>Design picked by chance: <?= $design['designName'] ?></h3>
<a href="<?= $url ?>" target="_blank">Click here to see the design</a><br /><br />

<iframe src="<?= $abTesting->getDesignUrl($design['designId']) ?>" frameBorder="0" width="300px" height="300px"></iframe>

<br />
<hr />

<?php
include('includes/back.php');
include('includes/footer.php');
?>