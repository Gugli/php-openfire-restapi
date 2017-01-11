<?php
    
    
// Simple test suite
    
print "php-openfire-restapi test suite\n";

define( 'PATH',	realpath( dirname(__FILE__)) );

require_once( PATH.'/vendor/autoload.php' );

require_once( PATH.'/Test_options.php' );

$api = new \Maniaplanet\OpenFireRestApi\OpenFireRestApi;
$api->secret = SERVER_SECRET;
$api->host   = SERVER_HOST;
$api->port   = SERVER_PORT;

// Users    
$User = new \Maniaplanet\OpenFireRestApi\Entity\User();
$User->username = 'debuguser01';
$User->name     = 'Debug User 01';
$User->email    = 'debuguser01@invqlidemail.com';
$User->password = 'pouet';
$result = $api->createUser($User);
print_r( $result );
{
    $RosterItem = new \Maniaplanet\OpenFireRestApi\Entity\RosterItem();
    $RosterItem->jid                   = ( 'debuguser02@chat.maniaplanet.com' );
    $RosterItem->nickname              = ( 'debuguser02' );
    $RosterItem->subscriptionType      = ( \Maniaplanet\OpenFireRestApi\Entity\RosterItem::SUBSCRIPTIONTYPEBOTH );
    $result = $api->addRosterItem($User->username, $RosterItem);
    print_r( $result );

    $RosterItem->subscriptionType      = ( \Maniaplanet\OpenFireRestApi\Entity\RosterItem::SUBSCRIPTIONTYPENONE );
    $result = $api->updateRosterItem($User->username, $RosterItem);
    print_r( $result );

    $RosterItem->subscriptionType      = ( \Maniaplanet\OpenFireRestApi\Entity\RosterItem::SUBSCRIPTIONTYPENONE );
    $result = $api->deleteRosterItem($User->username, $RosterItem->jid);
    print_r( $result );
}
$result = $api->deleteUser($User->username);
print_r( $result );
          

// Chatrooms          
$newRoom = new \Maniaplanet\OpenFireRestApi\Entity\ChatRoom;
$newRoom->roomName =  'roomtest3';
$newRoom->naturalName =  'RoomTest3';
$newRoom->description =  'Description test 3';
$newRoom->members =  array();
$result = $api->createChatRoom($newRoom, 'conference');
print_r( $result );

$result = $api->getChatRoom('roomtest3', 'conference');
$obj = $result['result'][0];
$str = json_encode( $obj );
print_r( $str."\n" );

$result = $api->deleteChatRoom('roomtest3', 'conference');
print_r( $result );

$result = $api->getChatRoom('roomtest3', 'conference');
$obj = $result['result'][0];
$str = json_encode( $obj );
print_r( $str."\n" );


		


