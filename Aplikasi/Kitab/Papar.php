<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Papar
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>1. Anda berada di class Papar<br>';
	}
#==========================================================================================
	public function bacaan($nama, $noInclude = false)
	{
		//echo 'Anda berada di class Papar::' . $nama . '()<br>';

		if ($noInclude == true) 
		{
			require PAPAR . $nama . '.php';	
		}
		else 
		{
			require PAPAR . 'diatas.php';
			require PAPAR . 'menu_atas.php';
			require PAPAR . $nama . '.php';
			require PAPAR . 'dibawah.php';	
		}
	}

	public function baca($nama, $noInclude = false)
	{
		//echo '<br>1.Anda berada di class Papar::' . $nama . '()<br>';
		
		$namafail = explode('/', $nama);
        $failPapar = GetMatchingFiles(
			GetContents(PAPAR . '/' . $namafail[0]),
			$namafail[1] . '.php');
		$paparFail = $failPapar[0];
		/*
        echo '<hr size=2>PAPAR=' . PAPAR . '<br>';
        echo '$namafail=<pre>'; print_r($namafail) . '</pre><br>';
        echo '$failPapar=<pre>'; print_r($failPapar) . '</pre><br>';
		echo '$paparFail->' . $paparFail . '<br>';
		//*/
		
		$cariNama = array ('index/index', 'index/login',
		'index/login_automatik','index/daftar','index/muar');
		$cariJQM = array('mobile/mobile','mobile/iconjqm');

		if ($paparFail == false) 
		{
			\Aplikasi\Kitab\Route::failPaparTidakWujud();
			//echo 'failPaparTidakWujud()';
		}
		//elseif (in_array($nama,$cariJQM)) 
		elseif ( $namafail[0]=='mobile')
		{
			require PAPAR . '/diatas-jqm.php';
			require $paparFail;
			require PAPAR . '/dibawah-jqm.php';
		}
		elseif ($noInclude == true) 
		{
			require $paparFail;
		}
		else 
		{
			if( in_array($nama,$cariNama) )
				require $paparFail;	
			elseif ( $nama == 'semak')
				require $paparFail;	
			else
			{				
				require PAPAR . '/diatas.php';
				require PAPAR . '/menu_atas.php';
				require $paparFail;
				require PAPAR . '/dibawah.php';	
			}
		}
//*/		
	}
#==========================================================================================
#------------------------------------------------------------------------------------------
	public function paparTemplate($nama, $template, $noInclude = false)
	{
		$namafail = explode('/', $nama);
        $failPapar = GetMatchingFiles(
			GetContents(PAPAR . '/' . $namafail[0]),
			$namafail[1] . '.php');
		$paparFail = $failPapar[0];
		$lokasiTemplate = '/template/' . $template;
		
		/*echo '<hr size=2>PAPAR=' . PAPAR . '<br>';
		//echo '$namafail=<pre>'; print_r($namafail) . '</pre><br>';
		//echo '$failPapar=<pre>'; print_r($failPapar) . '</pre><br>';
		echo '$paparFail->' . $paparFail . '<br>'
			. '$template->' . $template . '<br>' 
			. '$lokasiTemplate->' . $lokasiTemplate . '<br>'
			. '$noInclude->' . $noInclude . '<br>'
			. '';//*/
		
		echo '<hr>require ' . PAPAR . $lokasiTemplate . '/diatas.php'
			. '<br>require ' . PAPAR . $lokasiTemplate . '/menu_atas.php'
			. '<br>require ' . $paparFail
			. '<br>require ' . PAPAR . $lokasiTemplate . '/dibawah.php'
			. '';//*/
	}
#------------------------------------------------------------------------------------------
	public function bacaTemplate($nama, $template, $noInclude = false)
	{
		$namafail = explode('/', $nama);
        $failPapar = GetMatchingFiles(
			GetContents(PAPAR . '/' . $namafail[0]),
			$namafail[1] . '.php');
		$paparFail = $failPapar[0];
		$lokasiTemplate = '/template/' . $template;
		
		/*echo '<hr size=2>PAPAR=' . PAPAR . '<br>';
		//echo '$namafail=<pre>'; print_r($namafail) . '</pre><br>';
		//echo '$failPapar=<pre>'; print_r($failPapar) . '</pre><br>';
		echo '$paparFail->' . $paparFail . '<br>'
			. '$template->' . $template . '<br>' 
			. '$lokasiTemplate->' . $lokasiTemplate . '<br>'
			. '$noInclude->' . $noInclude . '<br>'
			. '';//*/
		
		if ($noInclude == true) 
		{
			require PAPAR . $nama . '.php';	
		}
		else 
		{
			require PAPAR . $lokasiTemplate . '/diatas.php';
			require PAPAR . $lokasiTemplate . '/menu_atas.php';
			require PAPAR . $lokasiTemplate . '/menu-tengah-atas.php';
			require $paparFail;
			require PAPAR . $lokasiTemplate . '/menu-tengah-bawah.php';
			require PAPAR . $lokasiTemplate . '/dibawah.php';			
		}//*/
	}
#-----------------------------------------------------------------------------------------
	function pilihTemplate($template = 0)
	{
	#^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#		
		switch ($template)
		{
			case 2: $jenis = 'startbootstrap-sb-admin-2-1.0.8';
			break;

			case 1: $jenis = 'FlatAdmin-V.2';
			break;

			default: $jenis = 'AdminLTE-2.3.0';
			break;
		}
	#^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#	
		return $jenis;
	}
#-----------------------------------------------------------------------------------------
#==========================================================================================
}