<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_mnet_auto_add_remote_users'] = 'När detta är inställt till \'Ja\' så kommer en post för lokal användare att skapas automatiskt när en fjärranvändare loggar in för första gången.';
$string['auth_mnet_roamin'] = 'Den här värdens användare kan navigera vidare till Din webbplats.';
$string['auth_mnet_roamout'] = 'Dina användare kan navigera vidare till de här värdarna.';
$string['auth_mnet_rpc_negotiation_timeout'] = 'Timeout räknat i sekunder för autenticering via XMLRPC-transporten.';
$string['auth_mnetdescription'] = 'Användare autenticeras i enlighet med det nät av tillförlitlighet som har definierats i Dina inställningar för nätverk för Moodle.';
$string['auth_mnettitle'] = 'Autenticering i nätverk för Moodle';
$string['auto_add_remote_users'] = 'Lägg till fjärranvändare automatiskt';
$string['rpc_negotiation_timeout'] = 'Tiden för RPC-förhandling har gått ut';
$string['sso_idp_description'] = 'Offentliggör den här tjänsten för att tillåta att Dina användare navigerar vidare till $a webbplatsen för Moodle utan att behöva logga in där igen. <ul><li><em>Beroende</em>: Du måste också  <strong>prenumerera</strong> på SSO-tjänsten hos $a.</li></ul>Prenumerera på den tjänsten för att tillåta att autenticerade användare från $a får tillgång till Din webbplats utan att behöva logga in igen. <ul><li><em>Beroende</em>: Du måste också  <strong>offentliggöra</strong> SSO-tjänsten hos $a.</li></ul><br />';
$string['sso_idp_name'] = 'SSO (Tillhandahållare av identiteter)';
$string['sso_mnet_login_refused'] = 'Användarnamn $a[0] har inte tillstånd att logga in från $a[1].';
$string['sso_sp_description'] = 'Offentliggör den här tjänsten för att tillåta att autenticerade användare från $a får tillgång till Din webbplats utan att behöva logga in igen. <ul><li><em>Beroende</em>: Du måste också  <strong>prenumerera</strong> på SSO-tjänsten (tillhandahållare av identiteter) hos $a.</li></ul>Prenumerera på den tjänsten för att tillåta att Dina användare navigerar vidare till $a webbplatsen för Moodle utan att behöva logga in där igen.<ul><li><em>Beroende</em>: Du måste också  <strong>offentliggöra</strong> SSO-tjänsten (tillhandahållare av identiteter) hos $a.</li></ul><br />';
$string['sso_sp_name'] = 'SSO (tillhandahållare av tjänster)';