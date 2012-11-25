<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'certificate', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Incluir uma outra opção de atividade';
$string['addlinktitle'] = 'Clique para incluir outra opção de atividade';
$string['areaintro'] = 'Introdução do certificado';
$string['awarded'] = 'Conquistado';
$string['awardedto'] = 'Conquistado para';
$string['back'] = 'Voltar';
$string['border'] = 'Borda';
$string['borderblack'] = 'Preto';
$string['borderblue'] = 'Azul';
$string['borderbrown'] = 'Marrom';
$string['bordercolor'] = 'Linhas da borda';
$string['bordercolor_help'] = 'Uma vez que as imagens podem aumentar significativamente o tamanho do arquivo PDF, você pode optar por imprimir uma borda de linhas ao invés de utilizar uma imagem de borda (verifique se a opção Imagem de Borda está definida como Não). As Linhas de Borda irão imprimir uma borla de três linhas de diferentes larguras na cor selecionada.';
$string['bordergreen'] = 'Verde';
$string['borderlines'] = 'Linhas';
$string['borderstyle'] = 'Imagem da borda';
$string['borderstyle_help'] = 'A opção Imagem de Borda permite que você escolha uma imagem a partir da pasta certificate/pix/borders. Seleciona a imagem de borda que você deseja em torno das bordas do certificado ou selecione Nenhuma Borda.';
$string['certificate'] = 'Código para verificação do certificado:';
$string['certificate:manage'] = 'Gerenciar certificado';
$string['certificate:printteacher'] = 'Imprimir Professor';
$string['certificate:student'] = 'Obter certificado';
$string['certificate:view'] = 'Ver certificado';
$string['certificatename'] = 'Nome do certificado';
$string['certificatereport'] = 'Relatório de Certificados';
$string['certificatesfor'] = 'Certificados para';
$string['certificatetype'] = 'Tipo do certificado';
$string['certificatetype_help'] = 'Aqui define-se qual o layout desejado para o certificado. A pasta type do módulo certificado inclui quatro certificados padrão:
A4 com fontes incorporadas, que imprime em papel tamanho A4, com as fontes inclusas no arquivo.
A4 sem fontes incorporados, que imprime em papel tamanho A4, sem incluir as fontes ao arquivo.
Carta com fontes incorporadas, que imprime em papel tamanho carta, com as fontes inclusas no arquivo.
Carta sem fontes incorporados, que imprime em papel tamanho carta, sem incluir as fontes ao arquivo.
Os tipos sem fontes incorporadas usam as fontes Helvetica e Times.
Se você não tiver certeza que seus usuários terão essas fontes nos seus computadores, ou se o seu idioma
utiliza caracteres ou símbolos que não são inclusos nas fontes Helvetica e Times, recomenda-se optar por
um tipo com fontes incorporadas. Os tipos com fontes incorporadas usam as fontes Dejavusans e Dejavuserif.
Esta opção criará arquivos pdf significativamente maiores, portanto não recomenda-se o uso de um tipo com
fontes incorporadas, a menos que você julgue necessário.
Pastas como novos tipos de layouts podem ser adicionadas a pasta certificate/type. O nome da pasta e
quaisquer novas palavras traduzidas para estes novos tipos devem ser adicionadas aos arquivos de idiomas
do módulo certificado.';
$string['certify'] = 'Isto é para certificar que';
$string['code'] = 'Código';
$string['completiondate'] = 'Conclusão de Curso';
$string['course'] = 'Para';
$string['coursegrade'] = 'Notas do curso';
$string['coursename'] = 'Curso';
$string['credithours'] = 'Carga-horária';
$string['customtext'] = 'Texto personalizado';
$string['date'] = 'Em';
$string['datefmt'] = 'Formato da data';
$string['datefmt_help'] = 'Escolha um formato de data para imprimir a data no certificado. Ou, escolha a última opção para imprimir a data no formato da linguagem escolhida pelo usuário.';
$string['datehelp'] = 'Data';
$string['deletissuedcertificates'] = 'Excluir certificados emitidos';
$string['delivery'] = 'Entrega';
$string['delivery_help'] = 'Escolha aqui como você gostaria que os certificado sejam entregues ao seus alunos.
Abrir em uma nova janela: Abre o certificado em uma nova janela do navegador.
Forçar Download: Abre a janela do navegador para o download do arquivo.
Enviar por e-mail : Escolhendo esta opção envia o certificado para o aluno como um anexo de e-mail.
Após o recebimento do certificado pelo usuário, se ele acessar o link a partir da página do curso, ele cerá a data do recebimento do certificado, bem como serão capazes de rever o certificado recebido.';
$string['designoptions'] = 'Opções de design';
$string['download'] = 'Forçar download';
$string['emailcertificate'] = 'Email (Deve também escolher salvar!)';
$string['emailothers'] = 'Outros e-mails';
$string['emailothers_help'] = 'Insira os endereços de e-mails aqui, separados por vírgula, daqueles que devem ser alertados com um e-mail sempre que alunos receberem um certificado.';
$string['emailstudenttext'] = 'Em anexo está o seu certificado para {$a->course}.';
$string['emailteachermail'] = '{$a->student} recebeu seu certificado: \'{$a->certificate}\'  para  {$a->course}.

Você pode revê-lo aqui:
{$a->url}';
$string['emailteachermailhtml'] = '{$a->student} recebeu seu certificado: <i>\'{$a->certificate}\'</i> para {$a->course}.

Você pode revê-lo aqui:

<a href="{$a->url}">Certificado</a> .';
$string['emailteachers'] = 'Enviar e-mail aos professores';
$string['emailteachers_help'] = 'Se ativado, os professores receberão um e-mail sempre que os alunos receberem um certificado.';
$string['entercode'] = 'Entre o código do certificado para verificar:';
$string['getcertificate'] = 'Obtenha o seu certificado';
$string['grade'] = 'Nota';
$string['gradedate'] = 'Data da nota';
$string['gradefmt'] = 'Formato da nota';
$string['gradefmt_help'] = 'Existem três formatos disponíveis se você optar por imprimir uma nota no certificado:
Nota Percentual: Imprime a nota como uma porcentagem.
Nota em Pontos: Imprime o valor do ponto da nota. Nota em Letras: Imprime a nota percentual como uma letra.';
$string['gradeletter'] = 'Nota em Letra';
$string['gradepercent'] = 'Nota Percentual';
$string['gradepoints'] = 'Nota em Pontos';
$string['incompletemessage'] = 'Para fazer o download do certificado, você deve primeiro preencher todas as atividades necessárias. Por favor retorne para o curso para concluí-lo.';
$string['intro'] = 'Introdução';
$string['issued'] = 'Emitido';
$string['issueddate'] = 'Data de emissão';
$string['issueoptions'] = 'Opções de emissão';
$string['landscape'] = 'Paisagem';
$string['lastviewed'] = 'Você recebeu este certificado pela última vez em:';
$string['letter'] = 'Carta';
$string['lockingoptions'] = 'Bloquear Opções';
$string['modulename'] = 'Certificado';
$string['modulenameplural'] = 'Certificados';
$string['mycertificates'] = 'Meus certificados';
$string['nocertificates'] = 'Não existem certificados';
$string['nocertificatesissued'] = 'Não há certificados que foram emitidos';
$string['nocertificatesreceived'] = 'Ainda não recebeu os certificados do curso.';
$string['nogrades'] = 'Nenhuma nota disponível';
$string['notapplicable'] = 'N/A';
$string['notfound'] = 'O número do certificado não pôde ser validado.';
$string['notissued'] = 'Não emitido';
$string['notissuedyet'] = 'Ainda não emitido';
$string['notreceived'] = 'Você não recebeu este certificado';
$string['openbrowser'] = 'Abrir em nova janela';
$string['opendownload'] = 'Clique no botão abaixo para salvar o seu certificado para o seu computador.';
$string['openemail'] = 'Clique no botão abaixo e seu certificado será enviado a você como um anexo no e-mail.';
$string['openwindow'] = 'Clique no botão abaixo para abrir seu certificado em numa nova janela do navegador.';
$string['or'] = 'Ou';
$string['orientation'] = 'Orientação';
$string['orientation_help'] = 'Escolha se você quer que a orientação do certificado seja retrato ou paisagem.';
$string['pluginadministration'] = 'Administração de certifcado';
$string['pluginname'] = 'Certificado';
$string['portrait'] = 'Retrato';
$string['printdate'] = 'Data de impressão';
$string['printdate_help'] = 'Esta é a data que será impressa, se uma data for adicionada à impressão. Se a data de conclusão do curso for selecionada, mas o aluno ainda não tiver concluído o curso, a data de recebimento será impressa. Você também pode optar por imprimir a data com base em quando uma atividade recebeu a nota. Se um certificado for emitido antes que a atividade receber uma nota, a data de recebimento será impressa.';
$string['printerfriendly'] = 'Página de impressão amigável';
$string['printgrade'] = 'Imprimir nota';
$string['printgrade_help'] = 'Você pode escolher qualquer atividade com nota disponível no curso, para imprimir como nota do certificado. As atividades disponíveis são listadas na ordem em que aparecem no relatório de notas. Escolha o formato da nota abaixo.';
$string['printhours'] = 'Imprimir carga horária';
$string['printhours_help'] = 'Digite aqui a carga horária a ser impressa no certificado.';
$string['printnumber'] = 'Imprimir código';
$string['printnumber_help'] = 'Um código de 10 dígitos exclusivos de letras e números aleatórios pode ser impresso no certificado. Este número pode então ser verificado comparando com o número de código exibido no relatório certificado.';
$string['printoutcome'] = 'Imprimir Resultados';
$string['printoutcome_help'] = 'Pode-se escolher qualquer informação de retorno das atividades do curso que o usuário recebeu, para imprimir no certificado. Um exemplo prático seroa: Resultado no curso: Proficiente.';
$string['printseal'] = 'Imagem de selo ou logotipo';
$string['printseal_help'] = 'Esta opção permite que você selecione um selo ou logotipo para ser impresso no certificado na pasta certificate/pix/seals. Por padrão, essa imagem é colocada no canto inferior direito do certificado.';
$string['printsignature'] = 'Imagem de assinatura';
$string['printsignature_help'] = 'Esta opção permite imprimir uma imagem de assinatura na pasta certificate/pix/signatures. Você pode imprimir uma representação gráfica de uma assinatura, ou imprimir uma linha para uma assinatura por escrito. Por padrão, essa imagem é colocada na parte inferior esquerda do certificado.';
$string['printteacher'] = 'Imprimir Nome(s) Professor(es)';
$string['printteacher_help'] = 'Para imprimir o nome do professor no certificado, defina o papel de professor no nível do módulo certificado. Isto possibilita que mesmo havendo mais de um professor para o curso, ou se houver a disponibilização de mais de um certificado no curso onde pretende-se imprimir nomes de professor diferentes em cada certificado. Para isto, acesse a edição do certificado, e em seguida, clique na guia de papéis atribuídos localmente. Em seguida, atribua o papel de Professor (professor editor) ao certificado (lembrando que o usuário não precisa ser necessariamente um professor no curso - é possível atribuir esse papel qualquer pessoa). Esses nomes serão impressos no certificado para o professor.';
$string['printwmark'] = 'Imagem de marca d\'água';
$string['printwmark_help'] = 'Uma marca de água pode ser colocada no plano de fundo do certificado. Uma marca d\'água é um figura desbotada. Uma marca d\'água pode ser um logotipo, selo, frase, ou o que você deseja usar como uma figura de plano de fundo.';
$string['receivedcerts'] = 'Certificados recebidos';
$string['receiveddate'] = 'Data de Recebimento';
$string['removecert'] = 'Certificados emitidos removidos';
$string['report'] = 'Relatório';
$string['reportcert'] = 'Relatório detalhado de certificados';
$string['reportcert_help'] = 'Optando-se pela opção sim aqui, a data de recebimento deste certificado, o seu código, e o nome do curso será mostrado nos relatórios de certificado dos usuários. Se você optar por imprimir uma nota no certificado, então esta nota também aparecerá no relatório certificado.';
$string['reviewcertificate'] = 'Rever seu certificado';
$string['savecert'] = 'Salvar certificador';
$string['savecert_help'] = 'Se você escolher esta opção, então uma cópia do arquivo pdf do certificado de cada usuário é salvo nos arquivos do curso na pasta moddata para esse certificado. Um link para certificado salvo de cada usuário será exibido no relatório certificado.';
$string['sigline'] = 'linha';
$string['statement'] = 'completou o curso';
$string['summaryofattempts'] = 'Resumo dos certificados recebidos
anteriormente';
$string['textoptions'] = 'Opções de texto';
$string['title'] = 'CERTIFICADO de CONCLUSÃO';
$string['to'] = 'Concedido a';
$string['typeA4_embedded'] = 'A4 com fontes incorporadas';
$string['typeA4_non_embedded'] = 'A4 sem fontes incorporadas';
$string['typeletter_embedded'] = 'Carta com fontes incorporadas';
$string['typeletter_non_embedded'] = 'Carta sem fontes incorporadas';
$string['userdateformat'] = 'Formato de data do Usuário';
$string['validate'] = 'Verificar';
$string['verifycertificate'] = 'Verificar certificado';
$string['viewcertificateviews'] = 'Ver {$a} certificados emitidos';
$string['viewed'] = 'Você recebeu este certificado em:';
$string['viewtranscript'] = 'Ver certificados';
