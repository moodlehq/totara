<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_changingemailaddress'] = 'Você pediu a mudança do email de $a->oldemail para $a->newemail. Estamos enviando um email ao novo endereço para confirmação. Clique o link no email para completar o processo de atualização.';
$string['auth_emailchangecancel'] = 'Excluir mudança no email';
$string['auth_emailchangepending'] = 'Atualização pendente. Seguir as indicações do email enviado a $a->preference_newemail.';
$string['auth_emaildescription'] = 'Confirmação via correio eletrônico é o método de autenticação predefinido. Depois que o usuário se inscrever, escolhendo o nome de usuário e a senha, receberá uma mensagem de confirmação via Email. Essa mensagem contém um link seguro a uma página onde o usuário deve confirmar a sua inscrição. Quando o usuário preencher os campos relativos ao nome de usuário e à senha na página de ingresso, estes dados serão confrontados com os valores arquivados na base de dados.';
$string['auth_emailnoemail'] = 'A tentativa de lhe enviar um email falhou!';
$string['auth_emailnoinsert'] = 'Impossível adicionar seu registro no banco de dados!';
$string['auth_emailnowexists'] = 'O endereço email escolhido já foi utilizado por um outro usuário. Use um outro endereço.';
$string['auth_emailrecaptcha'] = 'Adiciona uma confirmação visual/sonora para o formulário da página de inscrição, nos registros por e-mail. Isso protege seu site contra spammers e contribui para uma causa que vale à pena. Veja http://recaptcha.net/learnmore.html para mais detalhes.';
$string['auth_emailrecaptcha_key'] = 'Ativar elemento reCAPTCHA';
$string['auth_emailsettings'] = 'Configurações';
$string['auth_emailtitle'] = 'Autenticação via correio eletrônico';
$string['auth_emailupdate'] = 'Mudança de endereço email';
$string['auth_emailupdatemessage'] = '$a->fullname,

Você ativou o pedido de mudança de endereço email como usuário do site $a->site. Clique o seguinte link para confirmar esta mudança.

$a->url';
$string['auth_emailupdatesuccess'] = 'Endereço email do usuário <em>$a->fullname</em> substituito por <em>$a->email</em>.';
$string['auth_emailupdatetitle'] = 'Confirmação de atualização de endereço email em $a->site';
$string['auth_invalidnewemailkey'] = 'Erro: se você está tentando confirmar a mudança de endereço email, provavelmente copiou o URL incompleto. Tente novamente.';
$string['auth_outofnewemailupdateattempts'] = 'O seu pedido de atualização do endereço email foi anulado. Você superou o número de tentativas permitidas.';