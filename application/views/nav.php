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
                    <a href="<?= site_url(), $this->config->item('backend'); ?>/Home">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Dateitransfer <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/download">
                                <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Download Bestellungen
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/Upload">
                                <span class="glyphicon glyphicon-import" aria-hidden="true"></span> Upload Daten
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= site_url(), $this->config->item('backend'); ?>/Nachrichten">
                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Nachrichten
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Accounts<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/Kunde">
                                <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Kundenverwaltung
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/Lieferort">
                                <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Verwaltung Lieferort
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/User">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Benutzerverwaltung
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= site_url(), $this->config->item('backend'); ?>/Bestellung">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Loggin as
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Einstellungen <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= site_url(), $this->config->item('backend'); ?>/Menulinie">Menulinien</a>
                        </li>
                        <li>
                            <a href="<?= site_url(); ?>/Dokument/zukunftige">Standardwerte</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Benutzer <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= site_url(); ?>/Setting/heute">Profil</a>
                        </li>
                        <li>
                            <a href="<?= site_url(); ?>Auth/change_password">Passwort ändern</a>
                        </li>
                        <li>
                            <a href="<?= site_url(); ?>acc/auth/logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
