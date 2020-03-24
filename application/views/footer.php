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

    <script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/global.js"></script>

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

    if (isset($sMessage) && $sMessage != ''){ ?>
        <script>
        $(document).ready(function() {
<?php   switch($sMessage){
            case 'save success': ?>
                toastr.success("Eintrag wurde erfolgreich gespeichert", "Speichern erfolgreich")
<?php       break;
            default: ?>
                toastr.error("<?= $sMessage;?>", "Fehler")
<?php       break;
        } ?>
        });
        </script>
<?php
    }
    if(isset($_SESSION['message']) && $_SESSION['message_kat'] == 'error'){
?>
        <script>
            $(document).ready(function () {
                toastr.error("<?= $this->session->flashdata('message') ?>", "<?= $this->session->flashdata('message_titel') ?>")
            })
        </script>
<?php
    }
    if(isset($_SESSION['message']) && $_SESSION['message_kat'] == 'success'){
?>
        <script>
            $(document).ready(function () {
                toastr.success("<?= $this->session->flashdata('message') ?>", "<?= $this->session->flashdata('message_titel') ?>")
            })
        </script>
<?php
    }
?>
</body>
</html>
