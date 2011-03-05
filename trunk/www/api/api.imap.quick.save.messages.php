<?php
/**
*************
* Changes log
*
*************
* 2011 03 05
*************
* 
* Start revising the message saving methods from the IMAP API
* for optimizing performances 
*
* (trunk :: revision :: 89)
*
*/

// the Header inherit from the Api class
$class_header = $class_application::getHeaderClass();

$class_message = $class_application::getMessageClass();

$class_dumper = $class_application::getDumperClass();

$criteria = 'SUBJECT "slashdot"';

$mailbox =

$resource = NULL;

$_messages =

$search_results = array();

if ( is_null( $mailbox ) && is_null( $resource ) )

	$mailbox = self::getImapMailbox();

if ( is_null( $resource ) )

	$resource = self::openImapStream( $mailbox );

if ( is_null( $labels ) )

	$labels = array( $mailbox.'[Gmail]/All Mail' );

while ( list( , $label ) = each( $labels ) )
{
	imap_reopen( $resource, $label );			

	$search_results[$label]  =
		imap_search( $resource, $criteria, SE_UID )
	;
}

list( , $uids ) = each( $search_results );

end( $uids );

list( , $uid ) = each( $uids );

if ( $verbose )

	echo 'last uid: ', $uid;

$class_dumper::log(
	__METHOD__,
	array(
		'[last uid]',
		$uid
	),
	$verbose
);

//while ( list( $label, $uids ) = each( $search_results ) )
//{
//	while (
//		( list( , $uid ) = each( $uids ))
//	)
//	{
//		if ( $uid > 110213 )
//		{
//			imap_reopen( $resource, $label );
//	
//			$_messages[ $uid ] = array(
//				PROPERTY_BODY =>
//					imap_fetchbody( $resource, $uid, '1', FT_UID ),
//				PROPERTY_HEADER =>
//					imap_fetchheader( $resource, $uid, FT_UID ),
//				PROPERTY_STRUCTURE =>
//					imap_fetchstructure( $resource, $uid, FT_UID )
//			);
//		}
//	}
//
//	reset( $uids );
//}
//
//if ( is_array( $messages )  && count( $messages ) )
//{
//	end( $messages );
//	list( $uid ) = each( $messages );
//
//	echo $uid;
//
//	$class_dumper::log(
//		__METHOD__,
//		array(
//			'[latest uid]',
//			$uid
//		),
//		TRUE
//	);	
//
//	foreach ( $messages as $uid => $properties )
//	{
//		$header = $class_header::make(
//			$properties[PROPERTY_HEADER],
//			$uid
//		);
//	
//		$message = $class_message::make(
//			$properties[PROPERTY_BODY],
//			$header->{PROPERTY_ID}
//		);
//	}
//}
