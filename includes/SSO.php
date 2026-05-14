<?php
if ( isset( $_ENV['SERVER'] ) && ( $_ENV['SERVER'] === 'production' ) ) {
	require './../includes/joomla.php';
}
else {
	$jid = "720";
	$jname = "Nimuel Agati Iskandu (Development Environment)";
	$jgroups = ["32", "30"];
}
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.eosfrontier.space/orthanc/v2/chars_player/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'accountID:' . $jid,
    'token:' . $_ENV['token']
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$logged_in_char = json_decode($response);
