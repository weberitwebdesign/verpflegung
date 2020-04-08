<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-col-1" aria-expanded="false">
        <span class="sr-only">Navigation ein-/ausblenden</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-col-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="<?= site_url(); ?>order">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Bestellung
          </a>
        </li>
        <?php
        if($this->ion_auth->is_admin()){ ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Einstellungen <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?= site_url(); ?>Menulinie">
                  <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Upload Fotos
                </a>
              </li>
              <li>
                <a href="<?= site_url(); ?>/Dokument/zukunftige">
                  <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Download Bestellungen
                </a>
              </li>
              <li>
                <a href="<?= site_url(); ?>/Dokument/zukunftige">Lieferdaten und Bestellschluss</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Benutzerverwaltung <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?= site_url(); ?>/download">
                  <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Neuer Benutzer erfassen
                </a>
              </li>
              <li>
                <a href="<?= site_url(), $this->config->item('backend'); ?>/Upload">
                  <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Übersicht Benutzer
                </a>
              </li>
            </ul>
          </li>

<?php
        }
?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Benutzer <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?= site_url(); ?>auth/change_password">Passwort ändern</a>
            </li>
            <li>
              <a href="<?= site_url(); ?>auth/logout">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
