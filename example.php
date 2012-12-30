<?php
/*
 * 		zippyshare.embed
 * 		a PHP Class to extract all the data of each Zippyshare Link.
 *
 *      example.php
 *
 *      2012 RFKDOT <rfkdot@gmail.com>
 *
 * 		https://github.com/RFKDOT/zippyshare.embed
 *
 */

include "zippyshare-embed.class.php";

$errors = array(
	"Invalid Link",
	"Error Unknown",
	"File Not Exist",
	"File Expired");

$zippylinks = array(
	"http://www65.zippyshare.com/v/62977902/file.html",						//TYPE 1 LINK
	"http://www65.zippyshare.com/view.jsp?locale=ro&key=62977902",			//TYPE 2 LINK
	"http://www65.zippyshare.com/v/49982495/file.html",						//MORE EXAMPLES
	"http://www658.zippyffshare.com/55view.jsp?locale=ro&key=621917172",	//MALFORMED LINK
	"http://www.zippyshare.com/view.jsp?__incorrect_link__",				//INCORRECT LINK
	"http://www14.zippyshare.com/v/66912583/file.html",						//FILE NOT EXIST
	"http://www66.zippyshare.com/view.jsp?locale=sv&key=50904764");			//FILE EXPIRED

$z = new ZSe;

$ret = "";

foreach( $zippylinks as $link )
{
	//$data = $z->getInfo($link);
	$data = $z->debugLink($link);

	$ret .= "<b>".$link."</b><br />";

	if(is_int($data))
	{
		$ret .= $errors[$data];
	}
	else
	{
		$ret .= $z->makePlayer($data['server'], $data['id_elem']);
		$ret .= "<pre>".print_r($data,1)."</pre>";
	}

	$ret .= "<hr>";



}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html lang="es">
	<head>
	<title>zippyshare.embed EXAMPLE</title>
	</head>
	<body>
	<?= $ret ?>
	</body>
</html>
