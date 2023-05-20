<?php

function getApps(): ?array
{
	if( ! $json = file_get_contents(  'db/apps.txt' ) ) return null;

	return json_decode( $json, true );
}

function addApp( string $name, string $phone ): bool
{
	if( ( $allApps = getApps() ) === null ) return false;

	$allApps[] = [
		'date'	=> date( 'Y-d-m H:i:s' ),
		'name'	=> $name,
		'phone'	=> $phone
	];

	return saveApps( $allApps );
}

function saveApps( array $apps ): bool
{
	$json = json_encode( $apps );

	if( ! file_put_contents( 'db/apps.txt', $json ) ) return false;

	return true;
}

