<?php
// Aktiviert die Anzeige aller Fehler für das Debugging.
ini_set('display_errors', 1);
error_reporting(E_ALL);
$logFilePath = '/var/www/html/logs/webhook.log';

// Funktion zum manuellen Schreiben von Fehlern und Nachrichten in die Log-Datei.
function log_message($message) {
	global $logFilePath;
	$timestamp = date('[Y-m-d H:i:s]');
	file_put_contents($logFilePath, "$timestamp $message\n", FILE_APPEND);
}

try
{
	log_message("### Webhook-Skript gestartet.");
	$secret= trim(getenv('WEBHOOK_SECRET'));
	//log_message("secret: $secret");
	$repo_path = '/mnt/dorei/_Dockers/www-aikido_zorn/www';
	if (empty($secret)) {
		log_message("secret empty bailing ");
		http_response_code(500);
		syslog(LOG_ERR,"Error: Secret key is empty.\n");
		die("Error: Secret key is empty.");
	}

	// check for POST request
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		log_message("method not post bailing");
		syslog(LOG_ERR,'FAILED - not POST - '. $_SERVER['REQUEST_METHOD']."\n");
		error_log('FAILED - not POST - '. $_SERVER['REQUEST_METHOD']);
		exit();
	}

	// get content type
	$content_type = isset($_SERVER['CONTENT_TYPE']) ? strtolower(trim($_SERVER['CONTENT_TYPE'])) : '';

	if ($content_type != 'application/json') {
		log_message('FAILED - not application/json - '. $content_type."\n");
		error_log('FAILED - not application/json - '. $content_type);
		exit();
	}

	// get payload
	$payload = trim(file_get_contents("php://input"));
	//log_message("payload: $payload");

	if (empty($payload)) {
		log_message('FAILED - no payload'."\n");
		error_log('FAILED - no payload');
		exit();
	}

	// get header signature
	$header_signature = isset($_SERVER['HTTP_X_FORGEJO_SIGNATURE']) ? $_SERVER['HTTP_X_FORGEJO_SIGNATURE'] : '';

	if (empty($header_signature)) {
		log_message('FAILED - header signature missing'."\n");
		error_log('FAILED - header signature missing');
		exit();
	}

	// calculate payload signature
	$payload_signature = hash_hmac('sha256', $payload, $secret, false);

	// check payload signature against header signature
	if ($header_signature !== $payload_signature) {
		log_message('FAILED - payload signature'."\n");
		error_log('FAILED - payload signature');
		exit();
	}

	// convert json to array
	$decoded = json_decode($payload, true);

	// check for json decode errors
	if (json_last_error() !== JSON_ERROR_NONE) {
		log_message('FAILED - json decode - '. json_last_error()."\n");
		error_log('FAILED - json decode - '. json_last_error());
		exit();
	}
	echo("actual payload: $decoded");
	//log_message("actual payload: ".print_r($decoded,true)."\n");
	$eventHeader = isset($_SERVER['HTTP_X_FORGEJO_EVENT']) ? $_SERVER['HTTP_X_FORGEJO_EVENT'] : null;
	if ($eventHeader === null) {
		$eventHeader = isset($_SERVER['HTTP_X_GITEA_EVENT']) ? $_SERVER['HTTP_X_GITEA_EVENT'] : null;
	}
	if ($eventHeader === 'push' ||$eventHeader === 'release') 
	{
		// This command will go into your repository and pull the latest changes.
		$command = "cd $repo_path && git pull origin main 2>&1"; // 2>&1 redirects standard error to standard output
		$output = shell_exec($command);
		log_message("cmd output: $output\n");
		http_response_code(200);
		echo "Success: Git repository hopefully updated.";
	}
		else log_message("not updating, not a release: $eventHeader\n");
} 
catch (Exception $e) 
{
	// Fängt alle unerwarteten Ausnahmen und schreibt sie in die Log-Datei.
	log_message("KRITISCHER FEHLER: Skript stürzte ab. Fehlermeldung: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
	http_response_code(500);
	echo "Internal Server Error.";
}
