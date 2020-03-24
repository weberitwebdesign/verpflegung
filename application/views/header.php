<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Bernet Catering GmbH</title>
    <script>
        var base_url = "<?= $sUrlBase; ?>";
        var controller_name = "<?= $sCurrent; ?>";
    </script>

<!-- Font Link CSS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

<!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">


<!-- Toastr CSS -->
    <link href="<?php echo base_url(); ?>assets/css/toastr.min.css" rel="stylesheet">

<!-- Debug Bar CSS -->
<?php
    if($_SERVER['CI_ENV'] != 'production'){
?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/github.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<?php
    }

//Laden zusätzliche CSS-Files, übergeben vom Controller
    foreach ($aCssFiles as $sCssFile => $sMedia) {
      echo '<link media="', $sMedia, '" rel="stylesheet" href="', base_url(), 'assets/css/', $sCssFile, '" />';
    }

?>

<!-- JQuery JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class='container'>
        <div id='head' class="row">
            <h2 class='text-center well well-sm'>Administration - Shop</h2>
        </div>
        <div class="row">
            <?=$sMenu; ?>
        </div>
