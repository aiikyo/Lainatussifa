<?php

/**
 * @Lainatussifa Dalimunthe
 * @adapted from http://w-shadow.com/
 */

//show all possible errors
error_reporting(E_ALL);

require_once 'includes/summarizer.php';
require_once 'includes/html_functions.php';

$summarizer = new Summarizer();

if (!empty($_POST['text'])){
	//echo '<pre>';
	$text = $_POST['text'];
	
	//replace some Unicode characters with ASCII
	$text = normalizeHtml($text);
	//generate the summary with default parameters
	$rez = $summarizer->summary($text);
	//print_r($rez);
	
	//$rez is an array of sentences. Turn it into contiguous text by using implode().
	$summary = implode(' ',$rez);
	//echo '</pre>';
}

?>
<head>
<title>Peringkas Artikel</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="header">
    	<h1>Peringkas Artikel Berbahasa Indonesia</h1>
		<h1>Menggunakan Algoritma <i>General Statistics Method</i></h1>
	</div>
	<div class="center">

	<form action="index.php" method="post">
		<div class="areaInput">
		<p>Masukkan Teks</p>
		<textarea name="text" rows="20" cols="58">
		<?php 
			echo !empty($_POST['text'])?htmlspecialchars($_POST['text']):''; 
		?>
		</textarea>
		<br>
		<button type="submit" class="button" name="submit">Ringkas</button>
		</div>
	</form>
			
		<div class="areaOutput">
		<p>Hasil Ringkasan</p>
		<textarea name="text" rows="20" cols="58">
		<?php
			if(!empty($summary)) echo $summary;
		?>
		</textarea>
		</div>

	</div>
	

</body>