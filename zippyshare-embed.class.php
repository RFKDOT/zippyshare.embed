<?php
/*
 * 		zippyshare.embed
 * 		a PHP Class to extract all the data of each Zippyshare Link.
 *
 *      zippyshare-embed.class.php
 *
 *      2012 RFKDOT <rfkdot@gmail.com>
 *
 * 		https://github.com/RFKDOT/zippyshare.embed
 *
 */
class ZSe
{

	public function getInfo($url_link)
	{

		$dev = preg_match_all ('/\p{N}+/', $url_link, $result );

		if($dev != 2){ return 0; }

		$data['server'] = $result[0][0];
		$data['id_elem'] = $result[0][1];

		$file = @file("http://www".$data['server'].".zippyshare.com/v/".$data['id_elem']."/file.html");

		if($file === FALSE){ return 1; }

		if(strpos($file[164], "File does not exist on this server") !== FALSE){ return 2; }

		if(strpos($file[164], "File has expired and does not exist anymore on this server") !== FALSE){ return 3; }

		$lines = array(
		187 => "name",
		188 => "size",
		189 => "uploaded",
		190 => "last_dorn");

		foreach($lines as $line => $name)
		{

			$text_line = $file[$line];
			$text_line = strip_tags($text_line);
			$text_line = explode(':', $text_line, 2);
			$text_line = trim($text_line[1]);
			$data[$name] = $text_line;

		}

		return $data;

	}

	public function debugLink($url_link)
	{

		$dev = preg_match_all ('/\p{N}+/', $url_link, $result );

		if($dev != 2){ return 0; }

		$data['server'] = $result[0][0];
		$data['id_elem'] = $result[0][1];

		$file = @file("http://www".$data['server'].".zippyshare.com/v/".$data['id_elem']."/file.html");

		if($file === FALSE){ return 1; }

		if(strpos($file[164], "File does not exist on this server") !== FALSE){ return 2; }

		if(strpos($file[164], "File has expired and does not exist anymore on this server") !== FALSE){ return 3; }

		foreach($file as $num_line => $text)
		{
			$text_line = $file[$num_line];
			$text_line = strip_tags($text_line);
			//$text_line = @explode(':', $text_line, 2);
			$text_line = @trim($text_line);
			$data[$num_line] = $text_line;

		}

		return array_filter($data);

	}

	public function makePlayer($server,$id_elem)
	{

		return "<script type='text/javascript'>
		var zippywww='$server';
		var zippyfile='$id_elem';
		var zippytext='#000000';
		var zippyback='#e8e8e8';
		var zippyplay='#ff6600';
		var zippywidth=850;
		var zippyauto=false;
		var zippyvol=80;
		var zippywave = '#000000';
		var zippyborder = '#cccccc';
		</script>
		<script type='text/javascript' src='http://api.zippyshare.com/api/embed_new.js'></script><br />";

	}

}
?>
