<?php

// This file replaces:
//   * STATEMENTS section in db/install.xml
//   * lib.php/modulename_install() post installation hook
//   * partially defaults.php

function xmldb_quiz_install() {
    global $DB;

/// Install logging support
//    update_log_display_entry('local_oauth', 'add', 'local_oauth', 'name');

    // create a default entry for all Google OAuth integration
    $record = new object();
    $record->name                = 'google.com';
    $record->request_token_url   = 'https://www.google.com/accounts/OAuthGetRequestToken';
    $record->authorize_token_url = 'https://www.google.com/accounts/OAuthAuthorizeToken';
    $record->access_token_url    = 'https://www.google.com/accounts/OAuthGetAccessToken';
    $record->consumer_key        = '<your consumer key>';
    $record->consumer_secret     = '<your consumer secret>';
    $record->enabled             = '0';
    $DB->insert_record('oauth_site_directory', $record);

    // default the config to disabled
    set_config('oauthenabled', 0, 'local_oauth');

}
