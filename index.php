<?php
/*
 * Ini fail index.php
 * Dalam ini kita isytiharkan
 * 1. laporan tahap kesilapan kod PHP
 * 2. zon masa kita pada Asia/Kuala Lumpur
 * 3. setkan tatarajah sistem
 * 4. masukkan semua fail class dari folder PUSTAKA
 * 5. istihar class Mulakan
 */
 
// 1. laporan tahap kesilapan kod PHP
error_reporting(E_ALL);
 
// 2. isytiharkan zon masa => Asia/Kuala Lumpur
date_default_timezone_set('Asia/Kuala_Lumpur');
 
// 3. setkan tatarajah sistem
require 'tatarajah.php';

/** 4. masukkan semua fail class dari folder PUSTAKA
 * URL : http://www.php-fig.org/psr/psr-4/examples/
 * An example of a project-specific implementation.
 *      
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($namaClass)
{
	# tentukan namespace 
	//$prefix = 'Aplikasi\\Kitab\\'; //echo '<br>' . $prefix;
	# folder asas bagi namespace prefix
	//$base_dir = __DIR__ . '/' . KITAB . '/'; //echo '<br>' . $base_dir;
	# does the class use the namespace prefix?
	/*$len = strlen($prefix); //echo '<br>' . $len;
	if (strncmp($prefix, $namaClass, $len) !== 0) 
		# no, move to the next registered autoloader
		return;//*/
	# dapatkan nama class tanpa namespace
	//$class = substr($namaClass, $len); //echo '<br>' . $relative_class;
	# dapatkan fail class tanpa namespace
	//$file = $base_dir . str_replace('\\', '/', $class) . '.php';
	
	# buat pecahan tatasusunan $namaClass
	$class = explode('\\', $namaClass); //print_r($class) . '<br>';
	# semak kewujudan class
	echo '<hr>nama class:' . $class[count($class)-1] . ' | ';
	$cariFail = GetMatchingFiles(GetContents('Aplikasi'),$class[count($class)-1] . '.php');
	# jika fail wujud, masukkan 
	foreach($cariFail as $kitabApa)
	{	
		echo '$kitabApa->' . $kitabApa . '<br>';
		if (file_exists($kitabApa)) require $kitabApa;
		//else echo 'tidak jumpa daa<br>';
	}
});
/* 5. istihar class 
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 * 
 *      new \Foo\Bar\Baz\Qux;
 */
$aplikasi = new \Aplikasi\Kitab\Route();
			//new \Route();
