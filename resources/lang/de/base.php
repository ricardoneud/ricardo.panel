<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Base Pterodactyl Language.
    |--------------------------------------------------------------------------
    |
    | These base strings are used throughout the front-end of Pterodactyl but
    | not on pages that are used when viewing a server. Those keys are in server.php
    |
    */
    'failed' => 'Falsches Passwort!',
    'throttle' => 'Zu viele Login-Versuche! Versuchen Sie, in :seconds Sekunde.',
    'view_as_admin' => 'Ihr sind ein admin. So können Sie alle Server zu sehen.',
    'server_name' => 'Der Server-Name',
    'no_servers' => 'Keine Server gefunden.',
    'form_error' => 'Diese Fehler traten auf:',
    'password_req' => 'Passwörter müssen die folgenden Anforderungen erfüllen: mindestens einen Großbuchstaben, einen Kleinbuchstaben, eine Ziffer und mindestens 8 Zeichen lang sein.',
    'account' => [
        'totp_header' => 'Zwei-Faktor- Authentifizierung',
        'totp_qr' => 'TOTP QR Code', /* TODO */
        'totp_enable_help' => 'It appears that you do not have Two-Factor authentication enabled. This method of authentication adds an additional barrier preventing unauthorized entry to your account. If you enable it you will be required to input a code generated on your phone or other TOTP supporting device before finishing your login.', /* TODO */
        'totp_apps' => 'You must have a TOTP supporting application (e.g Google Authenticator, DUO Mobile, Authy) to use this option.', /* TODO */
        'totp_enable' => 'Aktivieren der Zwei-Faktor-Authentifizierung', 
        'totp_disable' => 'Deaktivieren Zwei-Faktor-Authentisierung',
        'totp_token' => 'TOTP Zeichen', 
        'totp_disable_help' => 'In order to disable TOTP on this account you will need to provide a valid TOTP token. Once validated TOTP protection on this account will be disabled.',  /* TODO */
        'totp_checkpoint_help' => 'Please verify your TOTP settings by scanning the QR Code to the right with your phone\'s authenticator application, and then enter the 6 number code generated by the application in the box below. Press the enter key when finished.',  /* TODO */
        'totp_enabled' => 'Your account has been enabled with TOTP verification. Please click the close button on this box to finish.',  /* TODO */
        'totp_enabled_error' => 'The TOTP token provided was unable to be verified. Please try again.',  /* TODO */
        'update_email' => 'Update per E-Mail',
        'new_email' => 'Neue e-mail',
        'new_password' => 'Neues Kennwort',
        'update_pass' => 'Passwort aktualisieren'
    ]
];
/*
German Translation by Jboy
*/
