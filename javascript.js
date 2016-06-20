<?php header("Content-type: application/javascript"); ?>

$(function() {
    $( "#progressbar" ).progressbar({
        value: <?php echo $_SESSION['value'] ?>
    });

    // ... more javascript ...