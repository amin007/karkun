<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Crud extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		//echo '<br>class Crud extends Kawal';
		parent::__construct();
        \Aplikasi\Kitab\Kebenaran::kawalMasuk();
	}
	
	function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('crud/index');
	}
	
	function tambah() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('crud/tambah');
	}
	
	function papar() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('crud/papar');
	}
	   
    public function ubah($cariID = null, $medanID = null, $jadualUbah = null) 
    {//echo '<br>Anda berada di class Crud:ubah($cariID) extends \Aplikasi\Kitab\Kawal<br>';
                
        # senaraikan tatasusunan jadual dan setkan pembolehubah
		$medanUbah = $this->tanya->medanUbah2($cariID);
		//$medanID = ''; $jadualUbah = ''; # 
	
		if (!empty($cariID)) 
		{
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>$medanID,'apa'=>$cariID);
			# 1. mula semak dalam jadual
			$this->papar->senarai['data'] = $this->tanya->
				tatasusunanUbah2($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSql($jadualUbah, $medanUbah, $cari, $susun = null);

			if(isset($this->papar->senarai['data'][0][$medanID])):
				$this->papar->jumpa = $this->papar->senarai['data'][0][$medanID];
				# cari data lain jika jumpa
				$this->papar->_paparSahaja = $this->tanya->
					tatasusunanUbah2A($jadualUbah, $medanUbah, $cari, $susun = null);
					//cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
					//cariSql($jadualUbah, $medanUbah, $cari, $susun = null);
			else:
				$this->papar->jumpa = '[tiada jumpa apa2]';
			endif;
			
			$this->papar->cariID  = $medanID;
			$this->papar->cariApa = $cariID;
		}
		else
		{
			$this->papar->senarai['data'] = array();
			$this->papar->cariID  = '[mahu cari apa]';
			$this->papar->cariApa = '[tiada id diisi]';
			$this->papar->jumpa   = '[hendak cari apa kalau id tiada]';
		}
				
		# isytihar pemboleubah
		$this->papar->lokasi = 'Enjin - Ubah';
		$this->papar->_jadual = $jadualUbah;
		
        
		/*# semak data
		echo '<pre>';
		echo '$this->papar->senarai:<br>'; print_r($this->papar->senarai); 
		echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '<br>$this->papar->jumpa:'; print_r($this->papar->jumpa); 
		echo '<br>$this->papar->_jadual:'; print_r($this->papar->_jadual); 
		echo '</pre>'; //*/
		
        # pergi papar kandungan
        $this->papar->baca('crud/ubah', 0);

    }
    
	public function ubahCari()
	{
		//echo '<pre>$_GET->', print_r($_GET, 1) . '</pre>';
		# bersihkan data $_POST
		$input = bersih($_GET['cari']);
		$dataID = str_pad($input, 12, "0", STR_PAD_LEFT);
		
		# Set pemboleubah utama
        $this->papar->lokasi = 'Enjin - Ubah';
		
		# pergi papar kandungan
		//echo '<br>location: ' . URL . 'crud/ubah/' . $dataID . '';
		header('location: ' . URL . 'crud/ubah/' . $dataID);

	}

    public function ubahSimpan($dataID)
    {
        $posmen = array();
        $medanID = '...';
		$senarai = array('');
    
        foreach ($_POST as $myTable => $value)
        {   if ( in_array($myTable,$senarai) )
            {   foreach ($value as $kekunci => $papar)
				{	$posmen[$myTable][$kekunci]= 
						( in_array($kekunci,array('hasil','belanja','gaji','aset','staf','stok')) ) ?
						str_replace( ',', '', bersih($papar) )// buang koma	
						: bersih($papar);
				}	$posmen[$myTable][$medanID] = $dataID;
            }
        }
        
		# ubahsuai $posmen
			# buat peristiharan
			$jadual = ''; // jadual 
			if (isset($posmen[$jadual]['respon']))
				$posmen[$jadual]['respon']=strtoupper($posmen[$jadual]['respon']);
			if (isset($posmen[$jadual]['email']))
				$posmen[$jadual]['email']=strtolower($posmen[$jadual]['email']);
			if (isset($posmen[$jadual]['responden']))
				$posmen[$jadual]['responden']=mb_convert_case($posmen[$jadual]['responden'], MB_CASE_TITLE);
			if (isset($posmen[$jadual]['hasil']))
			{
				eval( '$hasil = (' . $posmen[$jadual]['hasil'] . ');' );
				$posmen[$jadual]['hasil'] = $hasil;
			}
			if (isset($posmen[$jadual]['belanja']))			
			{
				eval( '$belanja = (' . $posmen[$jadual]['belanja'] . ');' );
				$posmen[$jadual]['belanja'] = $belanja;
			}
			if (isset($posmen[$jadual]['gaji']))
			{
				eval( '$gaji = (' . $posmen[$jadual]['gaji'] . ');' );
				$posmen[$jadual]['gaji'] = $gaji;
			}
			if (isset($posmen[$jadual]['aset']))			
			{
				eval( '$aset = (' . $posmen[$jadual]['aset'] . ');' );
				$posmen[$jadual]['aset'] = $aset;
			}
			if (isset($posmen[$jadual]['staf']))
			{
				eval( '$staf = (' . $posmen[$jadual]['staf'] . ');' );
				$posmen[$jadual]['staf'] = $staf;
			}
			if (isset($posmen[$jadual]['stok']))			
			{
				eval( '$stok = (' . $posmen[$jadual]['stok'] . ');' );
				$posmen[$jadual]['stok'] = $stok;
			}
			/*if (isset($posmen[$jadual]['no']))
				$posmen[$jadual]['no']=strtoupper($posmen[$jadual]['no']);
			if (isset($posmen[$jadual]['batu']))
				$posmen[$jadual]['batu']=strtoupper($posmen[$jadual]['batu']);
			if (isset($posmen[$jadual]['jalan']))
				$posmen[$jadual]['jalan']=strtoupper($posmen[$jadual]['jalan']);
			if (isset($posmen[$jadual]['tmn_kg']))
				$posmen[$jadual]['tmn_kg']=strtoupper($posmen[$jadual]['tmn_kg']);
			if (isset($posmen[$jadual]['dp_baru']))
				$posmen[$jadual]['dp_baru']=ucwords(strtolower($posmen[$jadual]['dp_baru']));//*/
        //echo '<br>$dataID=' . $dataID . '<br>';
        //echo '<pre>$_POST='; print_r($_POST) . '</pre>';
        //echo '<pre>$posmen='; print_r($posmen) . '</pre>';
 
        # mula ulang $senarai
        foreach ($senarai as $kunci => $jadual)
        {// mula ulang table
            $this->tanya->ubahSimpan($posmen[$jadual], $jadual, $medanID);
        }// tamat ulang table
        
        # pergi papar kandungan
		//$this->papar->baca('crud/ubah/' . $dataID);
		header('location: ' . URL . 'crud/ubah/' . $dataID);
 //*/       
    }

	function buang($id) 
	{
		# Set pemboleubah utama	
        if (!empty($id)) 
        {
			# $carian, $susun
			$this->tanya->cariSemuaData($myTable, $medan, $carian, $susun);
		}
		else
		{
			$this->papar->carian='[tiada id diisi]';
		}

		# pergi papar kandungan
		$this->papar->baca('crud/buang', 1);

    }
#==========================================================================================	
}