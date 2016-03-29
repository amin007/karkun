<?php
namespace Aplikasi\Kawal; //echo __NAMESPACE__; 
class Crud extends \Aplikasi\Kitab\Kawal
{
#==========================================================================================
	function __construct() 
	{
		echo '<br>class Index extends Kawal';
		parent::__construct();
        \Aplikasi\Kitab\Kebenaran::kawalMasuk();
	}
	
	function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('index/index');
	}
	
	function tambah() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('index/index');
	}
	
	function baca() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca('index/index');
	}
	
	public function medanUbah($cariID) 
	{ 
		# Set pemboleubah
		# buat link
		$alamat1 = 'http://xxx/crud/ubah2/",kp,"/'.$cariID.'/2010/2015/'; 
		$url1 = '" <a target=_blank href=' . $alamat1 . '>SEMAK 1</a>"';
		$url2 = 'concat("<a target=_blank href=' . $alamat1 . '>SEMAK 2</a>")';
		# Set pemboleubah untuk sql
        $senaraiMedan = 'id,'
			. 'concat_ws("|",nama,operator,' . $url1 . ',' . $url2 . ') nama,'
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," hasil",format(hasil,0)),' . "\r"
			. ' 	concat_ws("="," belanja",format(belanja,0)),' . "\r"
			. ' 	concat_ws("="," gaji",format(gaji,0)),' . "\r"
			. ' 	concat_ws("="," aset",format(aset,0)),' . "\r"
			. ' 	concat_ws("="," staf",format(staf,0)),' . "\r"
			. ' 	concat_ws("="," stok akhir",format(stok,0))' . "\r"
 			. ' ) as data5P,'
			. ' concat_ws("|",' . "\r"
			. ' 	concat_ws("="," tel",tel),' . "\r"
			. ' 	concat_ws("="," fax",fax),' . "\r"
			. ' 	concat_ws("="," orang",orang),' . "\r"
			. ' 	concat_ws("="," notel",notel),' . "\r"
			. ' 	concat_ws("="," nofax",nofax)' . "\r"
 			. ' ) as dataHubungi,'
			. 'concat_ws(" ",alamat1,alamat2,poskod,bandar) as alamat,' . "\r"
			//. 'concat_ws(" ",no,batu,( if (jalan is null, "", concat("JALAN ",jalan) ) ),tmn_kg,poskod,dp_baru) alamat_baru,' . "\r"
			. 'tel,notel,fax,nofax,responden,orang,email,esurat,'
			. 'hasil,belanja,gaji,aset,staf,stok' . "\r" 
			. '';	
		return $senaraiMedan;
	}
    
    public function ubah($cariID = null) 
    {//echo '<br>Anda berada di class Crud:ubah($cariID) extends \Aplikasi\Kitab\Kawal<br>';
                
        # senaraikan tatasusunan jadual dan setkan pembolehubah
        $jadualUbah = '...';
        $medanUbah = $this->medanUbah($cariID);
		$medanID = 'id';
	
        if (!empty($cariID)) 
        {
			$cari[] = array('fix'=>'like','atau'=>'WHERE','medan'=>$medanID,'apa'=>$cariID);
            # 1. mula semak dalam jadual
            $this->papar->senarai['data'] = $this->tanya->
				cariSemuaData($jadualUbah, $medanUbah, $cari, $susun = null);
				//cariSql($jadualUbah, $medanUbah, $cari);

			if(isset($this->papar->senarai['data'][0][$medanID])):
				$jumpaID = $this->papar->senarai['data'][0][$medanID];
				$this->papar->carian = $medanID;
			endif;
		}
        else
        {
            $this->papar->carian='[tiada id diisi]';
        }
        
        # isytihar pemboleubah
        $this->papar->lokasi = 'Enjin - Ubah';
		$this->papar->cari = (isset($this->papar->senarai['data'][0][$medanID])) ? $jumpaID : $cariID;
		$this->papar->_jadual = $jadualUbah;
		
        
		/*# semak data
		echo '<pre>';
		echo '$this->papar->cari:<br>'; print_r($this->papar->cari); 
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
		$this->papar->baca('kawalan/buang', 1);

    }
#==========================================================================================	
}