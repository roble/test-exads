<?php

use App\Models\TVSeries;

include('includes/header.php');
include('includes/back.php');

$title = $_GET['title'] ?? '';
$datetime = $_GET['datetime'] ?? '';

$series = TVSeries::getNextWillAir($datetime, $title);

?>

<h1>3. TV Series</h1>
<p>
    Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
<pre>
tv_series -> (id, title, channel, gender);
tv_series_intervals -> (id_tv_series, week_day, show_time);
</pre>
<small>* Provide the SQL scripts that create and populate the DB;</small>
</p>
<p>
    Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
    inputted time-date, and that can be optionally filtered by TV Series title.
</p>
<hr />
<h2>Result:</h2>
<div class="tv-series-container">
    <form method="get">
        <input type="hidden" value="tv-series" name="page" />
        <input value="<?= $title ?>" type="text" name="title" id="title" placeholder="Filter by title" />
        <input value="<?= $datetime ?>" min="<?= date('Y-m-d')  ?>" type="datetime-local" name="datetime" id="datetime" title="Filter by datetime (mm/dd/yyyy hh:mm)" />
        <button type="submit" id="submit">Filter</button> <br>
        <small>Input date format: mm/dd/yyyy</small>
    </form>
    <div>
        <div>
            <?php if (empty($series) && !$firstSeries) : ?>
                <h2 style="color: #e3723e">
                    No TV series will air soon
                </h2>
            <?php else : ?>
                <h3>Results: </h3>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Gender</th>
                        <th>Channel</th>
                        <th>Next show</th>
                    </tr>
                    <?php foreach ($series as $key => $value) : ?>
                        <tr class="<?= $key === 0 ? 'next-show' : '' ?>">
                            <td>
                                <?= $value['title'] ?>
                                <?= $key === 0 ? '<span class="label">NEXT SHOW</span>' : '' ?>
                            </td>
                            <td><?= $value['gender'] ?></td>
                            <td><?= $value['channel'] ?></td>
                            <td><?= $value['next_show_time']->format('F j, Y, g:i a') ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include('includes/back.php');
include('includes/footer.php');
?>