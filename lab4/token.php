<?php
 
$token = $_COOKIE['sendpulse_token'];
 
/**
 * @param NULL
 * @return mixed
 */
 
function getToken () {
 
	$tokenArr = array(
		'grant_type' => 'client_credentials',
		'client_id' => '59141abc2f1023505d62de20b55afea3',
		'client_secret' => '1d4f0b544d85f646a46b46c7f5df79db'
	);
 
	$tokenGo = array(
	    'http' => array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query($tokenArr)
	    )
	);
 
	$tokenMass = file_get_contents("https://api.sendpulse.com/oauth/access_token", false, stream_context_create($tokenGo));
 
 
	$json = json_decode($tokenMass);
 
	return $json->access_token;
}
 

 
if (!$_COOKIE['sendpulse_token']) {
 
	setcookie('sendpulse_token', getToken(), time()+3600);
	echo "token install!!!";
 
} else {
 
	echo "token found!!!<br/>";
	echo $token;
 
}
 
echo "<hr/>";


$email = array('email' => 'antonstrkv03@gmail.com')












/*    'html' => 'PHA+RXhhbXBsZSB0ZXh0PC9wPg==',
    'text' => 'Example text',
    'subject' => 'Example subject',
    'from' => array(
        'name' => 'Anton',
        'email' => 'as@to4tonado.net',
    ),
    'to' => array(
        array(
            'name' => 'Client',
            'email' => 'antonstrkv03@gmail.com',
        )
    )
);*/


if( $curl = curl_init() ) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: OAuth 05dd3dd84ff948fdae2bc4fb91f13e22bb1f289ceef0037']);
    curl_setopt($curl, CURLOPT_URL, 'https://api.sendpulse.com/addressbooks/693562/emails');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $email);
    $out = curl_exec($curl);
    echo $out;
    curl_close($curl);
  }
 
/*var_dump(getEmails($token));*/
/*var_dump(smtpSendMail($email));*/


