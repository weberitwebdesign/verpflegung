        <footer class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 navbar-text">
                        <div class="text-center">Bernet Catering GmbH, Neuhofstrasse 10, 8630 Rüti ZH | Telefonnummer: 055 240 81 05</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<!-- Bootstrap JS-->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Debug Bar JS -->
<?php
    if($_SERVER['CI_ENV'] != 'production'){ ?>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
<?php
    }

// Load Java Script
    foreach ($aJsFiles as $sJsFile) {
        echo '<script src="', base_url(), 'assets/js/', $sJsFile, '"></script>';
    }
?>
</body>
</html>
