<?php

use RenanRoble\Exads\ASCIIArray;

include('includes/header.php');
include('includes/back.php');

$from = ',';
$to = '|';
$elementRemoved = null;

$array = ASCIIArray::generateArray($from, $to);
$arrayShuffled = ASCIIArray::generateRandomArray($from, $to);
ASCIIArray::removeRandomElement($arrayShuffled, $elementRemoved);
$missingElement = ASCIIArray::findMissingElementUsingSum($arrayShuffled, $from, $to);
$missingElementArrayDiff = ASCIIArray::findMissingElementUsingDiff($arrayShuffled, $from, $to);

?>

<h1>2. ASCII Array</h1>
<p>
    Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
    pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
    Write the code to efficiently determine the missing character.
</p>
<hr />
<h2>Result:</h2>

<h3>Normal Array:</h3>
<pre><?= implode(' ', $array); ?></pre>

<h3>Shuffled array:</h3>
<pre><?= implode(' ', $arrayShuffled); ?></pre>

<h3>Remove and discard an arbitrary element:</h3>
<pre>
Element randomly removed : <?= $elementRemoved ?>
</pre>

<h3>Find missing character using SUM:</h3>
<pre>
Missing character: <?= $missingElement ?>
</pre>

<h3>Find missing character using Array Diff:</h3>
<pre>
Missing character: <?= $missingElementArrayDiff ?>
</pre>

<?php
include('includes/back.php');
include('includes/footer.php');
?>