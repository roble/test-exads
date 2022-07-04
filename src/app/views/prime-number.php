<?php

use RenanRoble\Exads\PrimeNumber;

include('includes/header.php');
include('includes/back.php');
$from = 1;
$to = 100;

?>

<h1>1. Prime Numbers</h1>
<p>
    Write a PHP script that prints all integer values from 1 to 100.
    Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
    only multiple of itself then print “[PRIME]”.
</p>
<hr />
<h2>Result:</h2>
<pre>
<?php
echo "##########################################\n";
echo "1. Prime numbers from ${from} to ${to} \n";
echo "##########################################\n\n";

for ($i = $from; $i <= $to; $i++) {
    echo PrimeNumber::formatPrimeOrMultiple($i) . "\n";
}
?>
</pre>

<?php
include('includes/back.php');
include('includes/footer.php');
?>