<?PHP // $Id$ 
      // report_security.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)


$string['check_configrw_details'] = '<p>Det rekommenderas att filrättigheterna i config.php ändras efter installation så att filen inte kan modifieras av webservern. Observera att detta inte ökar säkerheten på servern markant även om det minskar eller begränsar risken för exponering.</p>';
$string['check_configrw_name'] = 'Skrivbar config.php';
$string['check_configrw_ok'] = 'config.php kan inte modifieras av PHP skript.';
$string['check_configrw_warning'] = 'PHP script kan modifiera config.php.';
$string['check_cookiesecure_details'] = '<p>Om du aktiverar https-kommunikation rekommenderas att du också aktiverar säkra cookies. Du bör också lägga till permanent hänvisning från http till https.</p>';
$string['check_cookiesecure_error'] = 'Vänligen tillåt säkra cookies';
$string['check_cookiesecure_name'] = 'Säkra cookies';
$string['check_cookiesecure_ok'] = 'Säkra cookies tillåtna';
$string['check_courserole_anything'] = '\"Gör vad som helst\"-möjligheten är inte tillåten i den här <a href=\"$a\">kontexten</a>.';
$string['check_courserole_details'] = '<p>Varje kurs har en standard inskrivningsroll. Försäkra dig om att inga riskabla egenskaper finns för denna roll.</p>
<p>Den enda supporterade arvtypen för standard kursroll är <em>Student</em>.</p>';
$string['check_courserole_error'] = 'Felaktigt definierade standardroller för kurs hittade!';
$string['check_courserole_name'] = 'Standardroller (kurser)';
$string['check_courserole_notyet'] = 'Använd bara standard kursroll.';
$string['check_courserole_ok'] = 'Standard kursrollsdefinition är OK.';
$string['check_courserole_risky'] = 'Riskabla egenskaper hittade i <a href=\"$a\">kontext</a>.';
$string['check_courserole_riskylegacy'] = 'Riskabel arvtyp hittad i <a href=\"$a->url\">$a->shortname</a>.';
$string['check_defaultcourserole_anything'] = '\"Gör vad som helst\"-möjligheten är inte tillåten i den här <a href=\"$a\">kontexten</a>.';
$string['check_defaultcourserole_details'] = '<p>Standard studentroll för kursinskrivning specificerar standardrollen för kurser. Försäkra dig om att inga riskabla egenskaper finns för denna roll.</p>
<p>Den enda supporterade arvtypen för standard kursroll är <em>Student</em>.</p>';
$string['check_defaultcourserole_error'] = 'Felaktigt definierad standardroll \"$a\" för kurs hittade!';
$string['check_defaultcourserole_legacy'] = 'Riskabel arvtyp upptäckt.';
$string['check_defaultcourserole_name'] = 'Standard kursroll (global)';
$string['check_defaultcourserole_notset'] = 'Standardroll är inte satt.';
$string['check_defaultcourserole_ok'] = 'Site standardrolldefinition är OK.';
$string['check_defaultcourserole_risky'] = 'Riskfyllda egenskaper hittade i <a href=\"$a\">kontext</a>.';
$string['check_defaultuserrole_details'] = '<p>Alla inloggade användare ges funktionerna i den förvalda användarens roll. Se till att inga riskabla funktioner är tillåtna i denna roll.</p>
<p>Det enda arvtyp som stöds  för den förvalda användarrollen är <em> autentiserad användare </ em>. Kursvy egenskap får inte vara aktiverat.</p>';
$string['check_defaultuserrole_error'] = 'Standardanvädarrollen \"$a\" är felaktigt definierad!';
$string['check_defaultuserrole_name'] = 'Standardroll för alla användare';
$string['check_defaultuserrole_notset'] = 'Standardroll är inte satt.';
$string['check_defaultuserrole_ok'] = 'Standardrolldefinition för alla användare är OK.';
$string['check_displayerrors_details'] = '<p>Aktivering av PHP-inställningen <code>display_errors</code> är inte rekommenderad på produktionssiter eftersom felmeddelanden kan avslöja känslig information om din server.</p>';
$string['check_displayerrors_error'] = 'PHP-inställningen för att visa fel är aktiverad. Det rekommenderas att den avaktiveras.';
$string['check_displayerrors_name'] = 'Visning av PHP-fel';
$string['check_displayerrors_ok'] = 'Visning av PHP-fel avaktiverad.';
$string['check_emailchangeconfirmation_details'] = '<p>Det rekommenderas att ett e-postbekräftelsesteg krävs när användarna ändrar sin e-postadress i sin profil. Om avaktiverat kan spammarna försöka utnyttja servern för att skicka skräppost.</p>
<p>E-mail fält kan också låsas från autentiseringsplugins. Denna möjlighet är inte övervägd här.';
$string['check_emailchangeconfirmation_error'] = 'Användare kan mata in bilken e-mail som helst.';
$string['check_emailchangeconfirmation_info'] = 'ANvändare får bara mata in e-mail från tillåtna domäner.';
$string['check_emailchangeconfirmation_name'] = 'Bekräftelse av e-mailändring';
$string['check_emailchangeconfirmation_ok'] = 'Bekräftelse av e-mailändring i användarprofil.';
$string['check_embed_details'] = '<p>Obegränsad objektinbäddning är mycket farligt - alla registrerade användare kan starta en XSS-attack mot andra server-användare. Denna inställning bör inaktiveras på produktionsservrar.</p>';
$string['check_embed_error'] = 'Obegränsad objektinbäddning aktiverad - detta är mycket farligt för de flesta servrar.';
$string['check_embed_name'] = 'Tillåt EMBED och OBJECT';
$string['check_embed_ok'] = 'Obegränsad objektinbäddning är inte tillåten.';
$string['check_frontpagerole_details'] = '<p>Standardrollen för förstasida ges till alla registrerade användare för förstasidesaktiviteter. Försäkra dig om att inga riskabla egenskaper är tillåtna för denna roll.</p>
<p>Det rekommenderas att en specialroll skapas flr detta syfte och att en arvtyproll inte används.</p>';
$string['check_frontpagerole_error'] = 'Felaktigt definierad förstasidesroll \"$a\" hittad!';
$string['check_frontpagerole_name'] = 'Förstasidesroll';
$string['check_frontpagerole_notset'] = 'Förstasidesroll är inte satt.';
$string['check_frontpagerole_ok'] = 'Förstasidesroll definition är OK.';
$string['check_globals_details'] = '<p>Globala register anses vara en väldigt osäker PHP-inställning.</p>
<p><code>register_globals=off</code> måste sättas i PHOP-konfigurationen. Denna inställning kontrolleras genom editering av <code>php.ini</code>, Apache/IIS konfiguration eller <code>.htaccess</code> file.</p>';
$string['check_globals_error'] = 'Globala register MÅSTE inaktiveras. Ändra PHP-inställningarna på servern omedelbart!';
$string['check_globals_name'] = 'Globala register';
$string['check_globals_ok'] = 'Globala register inaktiverade.';
$string['check_google_details'] = '<p>Öppna till Google inställningen tillåter sökmotorer att nå kurser med gästaccess. Det är ingen mening med att aktivera den här inställningen om Gästlogin är inte tillåtet.</p>';
$string['check_google_error'] = 'Sökmotoraccess är tillåten men gäst-access är inaktiverad.';
$string['check_google_info'] = 'Sökmotorer kan vara gäster.';
$string['check_google_name'] = 'Öppen för Google';
$string['check_google_ok'] = 'Sökmotoraccess är inaktiverad.';
$string['check_guestrole_details'] = '<p>Gästrollen används för gäster, inte inloggad användare och tillfällig gäst access. Se till att inga riskabla funktioner är tillåtna för denna roll.</p><p>Den ända supporterade arvtypen för gästrollen är <em>Gäst</em>.</p>';
$string['check_guestrole_error'] = 'Gästrollen \"$a\" är felaktigt definierad!';
$string['check_guestrole_name'] = 'Gästroll';
$string['check_guestrole_notset'] = 'Gästrollen är inte satt.';
$string['check_guestrole_ok'] = 'Gästrollsdefinition är OK.';
$string['check_mediafilterswf_details'] = '<p>Automatisk swf-embedding är väldigt farligt - en registrerad användare kan starta en XSS attack mot andra serveranvändare. Avakjtivera detta på produktionsservrar.</p>';
$string['check_mediafilterswf_error'] = 'Flash Media Filtret är aktiverad - detta är mycket farligt för de flesta servrar.';
$string['check_mediafilterswf_name'] = 'Aktiverat .swf media filter';
$string['check_mediafilterswf_ok'] = 'Flash mediafilter är inaktiverat.';
$string['check_noauth_details'] = '<p><em>Ingen autentisering</em>pluginen är inte avsedd för produktionssiter. Inaktivera det om inte detta är en utvecklingssite.</p>';
$string['check_noauth_error'] = 'Ingen autentisering-pluginen är inte avsedd för produktionssiter.';
$string['check_noauth_name'] = 'Ingen autentisering';
$string['check_noauth_ok'] = 'Ingen autentiseringsplugin är inaktiverad.';
$string['check_openprofiles_details'] = '<p>Öppna användarprofiler kan missbrukas av spammare. Det rekommenderas att antingen <code> tvinga användarna att logga in för profiler</code> eller <code> tvinga användarna att logga in </code> är aktiverat. </p>';
$string['check_openprofiles_error'] = 'Vem som helst kan se användarprofiler utan att logga in.';
$string['check_openprofiles_name'] = 'Öppna användarprofiler';
$string['check_openprofiles_ok'] = 'Login krävs för att kunna se användarprofiler.';
$string['check_passwordpolicy_details'] = '<p>Det rekommenderas att lösenordspolicy är satt, eftersom lösenordsgissningar ofta är det enklaste sättet att få obehörig åtkomst.
Gör inte kraven alltför stränga, eftersom detta kan resultera i att användarna inte kan minnas sina lösenord och antingen glömmer dem eller skriva ner dem. </p>';
$string['check_passwordpolicy_error'] = 'Lösenordpolicy inte aktiverad';
$string['check_passwordpolicy_name'] = 'Lösenordpolicy';
$string['check_passwordpolicy_ok'] = 'Lösenordpolicy aktiverad';
$string['check_passwordsaltmain_details'] = '<p>Att sätta ett lösenord salt minskar kraftigt risken för lösenordsstöld.</p>
<p>För att ange ett lösenord salt, lägg till följande rad i config.php filen:</p>
<code>\$CFG->passwordsaltmain = \'några långa slumpmässiga strängar här med massor av tecken\';</code>
<p>Slumpmässig teckensträng bör vara en blandning av bokstäver, siffror och andra tecken. En stränglängd på minst 40 tecken rekommenderas.</p>
<p>Se<a href=\"$a\" target=\"_blank\"> lösenord saltning dokumentation</a>om du vill ändra lösenordet salt. Efter inställningen, ta INTE bort ditt lösenord salt! Annars kommer du inte längre att kunna logga in på din webbplats! </p>';
$string['check_passwordsaltmain_name'] = 'Lösendords salt';
$string['check_passwordsaltmain_ok'] = 'Lösendords salt är OK';
$string['check_passwordsaltmain_warning'] = 'Inget Lösendords salt är satt';
$string['check_passwordsaltmain_weak'] = 'Lösendords salt är svagt';
$string['check_riskadmin_detailsok'] = '<p>Verifiera följande lista på systemadministratörer:</p>$a';
$string['check_riskadmin_detailswarning'] = '<p>Kontrollera följande lista för systemadministratörer:</p>$a->admins
<p>Det rekommenderas att tilldela administratörroll i systemsammanhang endast. Följande användare har (ickestödd) tilldelning av admin roll i andra sammanhang:</p>$a->unsupported';
$string['check_riskadmin_name'] = 'Administratörer';
$string['check_riskadmin_ok'] = 'Hittade $a serveradministratörer.';
$string['check_riskadmin_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) granska rolltilldelning</a>';
$string['check_riskadmin_warning'] = 'Hittade $a->admincount serveradministratörer och $a->unsupcount ickestödda admin rolltilldelningar.';
$string['check_riskbackup_details_overriddenroles'] = '<p>Dessa aktiva åsidosättanden ger användarna möjlighet att inkludera användardata i säkerhetskopior. Kontrollera att detta tillstånd är nödvändigt.</p> $a';
$string['check_riskbackup_details_systemroles'] = '<p>Följande systemroller tillåter för närvarande användare att inkludera användardata i säkerhetskopior. Kontrollera att detta tillstånd är nödvändigt.</p> $a';
$string['check_riskbackup_details_users'] = '<p>På grund av ovanstående roller eller lokala åsidosättningar har följande användarkonton för närvarande tillstånd att göra säkerhetskopior som innehåller privata data från alla användare inskrivna i deras kurs. Kontrollera att de är (a) pålitliga och (b) skyddas av starka lösenord: </p> $a';
$string['check_riskbackup_detailsok'] = 'Inga roller tillåter uttryckligen backup av användardata. Observera dock att admins med \"doanything\" förmåga är fortfarande sannolikt kan göra detta.';
$string['check_riskbackup_editoverride'] = '<a href=\"$a->url\">$a->name i $a->contextname</a>';
$string['check_riskbackup_editrole'] = '<a href=\"$a->url\">$a->name</a>';
$string['check_riskbackup_name'] = 'Backup av användardata';
$string['check_riskbackup_ok'] = 'Inga roller tillåter explicit backup av användardata.';
$string['check_riskbackup_unassign'] = '<a href=\"$a->url\">$a->fullname ($a->email) in $a->contextname</a>';
$string['check_riskbackup_warning'] = 'Hittade $a->rolecount roller, $a->overridecount övertar och $a->usercount använader med möjlighet att backa upp användardata.';
$string['check_riskxss_details'] = '<p>RISK_XSS betecknar alla farliga funktioner som endast betrodda användare kan använda.</p>
<p>Vänligen kontrollera följande lista med användare och se till att du litar på dem helt och hållet på den här servern:</p><p>$a</p>';
$string['check_riskxss_name'] = 'XSS betrodda användare';
$string['check_riskxss_warning'] = 'RISK_XSS - hittade $a användare som måste vara betrodda.';
$string['check_unsecuredataroot_details'] = '<p>Datarootkatalogen får inte vara tillgänglig via webben. Det bästa sättet att se till att katalogen inte är tillgänglig är att använda en katalog utanför den publika webbkatalogen.</p>
<p>Om du flyttar katalogen, måste du uppdatera <code>\$CFG->dataroot</code> inställning i <code>config.php</code>med detta.</ p>';
$string['check_unsecuredataroot_error'] = 'Din datarootkatalog <code>$a</code> ligger på fel ställe och är åtkomlig via webben!';
$string['check_unsecuredataroot_name'] = 'Osäker dataroot';
$string['check_unsecuredataroot_ok'] = 'Datarootkatalogen får inte vara åtkomliga via webben.';
$string['check_unsecuredataroot_warning'] = 'Din datarootkatalog <code>$a</code> ligger på fel ställe och kan vara åtkomlig via webben.';
$string['configuration'] = 'Konfigurering';
$string['description'] = 'Beskrivning';
$string['details'] = 'Detaljer';
$string['issue'] = 'Problem';
$string['reportsecurity'] = 'Säkerhetsöversikt';
$string['security:view'] = 'Visa säkerhetsrapport';
$string['status'] = 'Status';
$string['statuscritical'] = 'Kritisk';
$string['statusinfo'] = 'Information';
$string['statusok'] = 'OK';
$string['statusserious'] = 'Allvarlig';
$string['statuswarning'] = 'Varning';
$string['timewarning'] = 'Databearbetning kan ta lång tid. Vänligen ha tålamod...';

?>
