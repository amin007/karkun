<?php
//namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
function dpt_url()
{
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$url = rtrim($url, '/');
	$url = filter_var($url, FILTER_SANITIZE_URL);
	$url = explode('/', $url);

	return $url;
}

function pecah_url($ulang)
{
	$pecah  = explode("/", $_SERVER['REQUEST_URI']);
	$tambah = ($ulang+1);
	$buang  = ($ulang-1==0) ? 1 : ($ulang-1);
	$papar  = '<a href="' . URL . $pecah[2] 
			. '/' . $pecah[3] 
			. '/' . $pecah[4]
		    . '/' . $tambah . '">Tambah</a>|'
			. '<a href="' . URL . $pecah[2] 
			. '/' . $pecah[3] 
			. '/' . $pecah[4]
		    . '/' . $buang . '">Kurang</a>';

	/*$papar .= '<pre>' . print_r($pecah, 1) . '</pre>';
		$pecah = > Array
		(
			[0] => 
			[1] => ekonomi
			[2] => cari
			[3] => lokaliti
			[4] => johor
			[5] => 3
		)
	//*/
	
	return $papar;
}

function dpt_ip()
{
	# define('ALAMAT_IP', serialize (array()) );
	$IP = unserialize(ALAMAT_IP);
	
	return $IP;
}

function senarai_kakitangan()
{
	# define('PEGAWAI', serialize (array()) );
	$pegawai = unserialize(PEGAWAI);
    
    return $pegawai;
}

// semak data
function semakDataPOST($semua)
{
			foreach ($_POST as $myTable => $value)
			{	
				if ( in_array($myTable,$semua) ):
					//echo "myTable : $myTable <br>";
					foreach ($value as $kekunci => $papar):
						$ubahMedan = $_POST['medan'][$myTable][$kekunci];
						if ($kekunci != $ubahMedan)
						{	/*echo "$myTable - $kekunci = $ubahMedan | berubah :"
							. '$posmen['.$myTable.']['.$ubahMedan.'] '
							. '<= $posmen['.$myTable.']['.$kekunci.']='
							. bersih($papar) . '<br>';*/
							
							$posmen[$myTable][$ubahMedan] = bersih($papar);
							unset($posmen[$myTable][$kekunci]);
						}
						elseif ($papar == null || $papar == '0')
							unset($posmen[$myTable][$kekunci]);
						else 
							$posmen[$myTable][$kekunci] = bersih($papar);
						
					endforeach;
				endif;
			}
	
	return $posmen;
}

// sql limit
function pencamSqlLimit($bilSemua, $item, $ms)
{
    // Tentukan bilangan jumlah dalam DB:
    $jum['bil_semua'] = $bilSemua;
    // ambil halaman semasa, jika tiada, cipta satu! 
    $jum['page'] = ( !isset($ms) ) ? 1 : $ms; // mukasurat
    // berapa item dalam satu halaman
    $jum['max'] = ( !isset($item) ) ? 30 : $item; // item
    // Tentukan had query berasaskan nombor halaman semasa.
    $dari = (($jum['page'] * $jum['max']) - $jum['max']); 
    $jum['dari'] = ( !isset($dari) ) ? 0 : $dari; // dari
    // Tentukan bilangan halaman. 
    $jum['muka_surat'] = ceil($jum['bil_semua'] / $jum['max']);
    // nak tentukan berapa bil jumlah dlm satu muka surat
    $jum['bil'] = $jum['dari']+1; 
    
    return $jum;
}
// format perpuluhan
function kiraPerpuluhan($kiraan, $perpuluhan = 1)
{
	// pecahan kepada ratus
	return number_format($kiraan,$perpuluhan,'.',',');
} 

function kira($kiraan)
{
	// pecahan kepada ratus
	return number_format($kiraan,0,'.',',');
} 

function kira2($dulu,$kini)
{
	// buat bandingan dan pecahan kepada ratus
	return @number_format((($kini-$dulu)/$dulu)*100,0,'.',',');
	//@$kiraan=(($kini-$dulu)/$dulu)*100;
}

function kira3($kira,$n) 
{
	return str_pad($kira,$n,"0",STR_PAD_LEFT);
}

function pilihKeyData($key,$keyData,$data)
{
	//echo '$key:' . $key; single key
	//echo '$keyData:[' . $keyData[$key] . ']';
	//echo '$data:[' . $data[$keyData[$key]]  . ']';
	return $keyData[$key];
}

function pilihValueData($key,$keyData,$data)
{
	//echo '$key:' . $key; single key
	//echo '$keyData:[' . $keyData[$key] . ']';
	//echo '$data:[' . $data[$keyData[$key]]  . ']';
	return $data[$keyData[$key]];
}


function huruf($jenis , $papar) 
{
	/*
	$_POST=strtoupper($_POST['']['']);
	$_POST=strtolower($_POST['']['']);
	$_POST=mb_convert_case($_POST[''][''], MB_CASE_TITLE);
	ucfirst
	*/
	
	switch ($jenis) 
	{// mula - pilih $jenis
	case "BESAR":
		$papar = strtoupper($papar);
		break;
	case "kecil":
		$papar = strtolower($papar);
		break;
	case "Besar":
		$papar = ucfirst($papar);
		break;
	case "Besar_Depan":
		$papar = mb_convert_case($papar, MB_CASE_TITLE);
		break;
	}// tamat - pilih $jenis
	
	return $papar;

}

function bersih($papar) 
{
	# lepas lari aksara khas dalam SQL
	//$papar = mysql_real_escape_string($papar);
	# buang ruang kosong (atau aksara lain) dari mula & akhir 
	$papar = trim($papar);
	
	return $papar;
}

function gambar_latarbelakang($lokasi)
{
	// '$lokasi=' . $lokasi;
    //$tmpt1 = '../private_html/bg/bg'; // utk localhost
	$tmpt1 = '../../../../private_html/bg/bg'; // utk localhost
    //$tmpt2 = '../../../../bssu/bg/bg'; // utk website amin007
	//$tmpt = ($lokasi=='localhost') ? $tmpt1 : $tmpt2;
    $dh = opendir($tmpt1);
    $i=1;
    while (($file = readdir($dh)) !== false) 
    {
        if($file != "."
            && $file != ".."
            && $file != "Thumbs.db"
            && $file != "index.html"
            && $file != "index.php") 
        {
            if ($file=='index.php') {echo "";}
            elseif (is_dir($file)==false) 
            { 
                //echo "\n" . $i++ . ")" . $file . "<br>";
                $gambar = $file;
                if (substr($gambar,-3) == 'jpg') 
                    $papar[]=$gambar;
            }
        }
 
    }
    closedir($dh);
 
    /*
    foreach(scandir($tmpt) as $gambar) 
    {
        if (substr($gambar,-3) == 'jpg') 
            $papar[]=$gambar;
    }
    */
     
    $today = rand(0, count($papar)-1); 
    return $papar[$today];
}

// lisfile2 - mula
function GetMatchingFiles($files, $search) 
{
	// Split to name and filetype
	if(strpos($search,".")) 
	{
		$baseexp=substr($search,0,strpos($search,"."));
		$typeexp=substr($search,strpos($search,".")+1,strlen($search));
	} 
	else 
	{ 
		$baseexp=$search;
		$typeexp="";
	} 
		
	// Escape all regexp Characters 
	$baseexp=preg_quote($baseexp); 
	$typeexp=preg_quote($typeexp); 
		
	// Allow ? and *
	$baseexp=str_replace(array("\*","\?"), array(".*","."), $baseexp);
	$typeexp=str_replace(array("\*","\?"), array(".*","."), $typeexp);
		   
	// Search for Matches
	$i=0;
	$matches=null; // $matches adalah array()
	foreach($files as $file) 
	{
		$filename=basename($file);
			  
		if(strpos($filename,".")) 
		{
			$base=substr($filename,0,strpos($filename,"."));
			$type=substr($filename,strpos($filename,".")+1,strlen($filename));
		} 
		else 
		{ 
			$base=$filename;
			$type="";
		}

		if(preg_match("/^".$baseexp."$/i",$base) && preg_match("/^".$typeexp."$/i",$type))  
		{
			$matches[$i]=$file;
			$i++;
		}
	}
	
	return $matches;
}

// Returns all Files contained in given dir, including subdirs
function GetContents($dir,$files=array()) 
{
	if(!($res=opendir($dir))) exit("$dir doesn't exist!");
		while(($file=readdir($res))==TRUE) 
		if($file!="." && $file!="..")
			if(is_dir("$dir/$file")) 
				$files=GetContents("$dir/$file",$files);
			else array_push($files,"$dir/$file");
		 
	closedir($res);
	return $files;
}
// listfile2 - tamat