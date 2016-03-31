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
		$this->_folder = 'crud';
	}
	
	function index() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/index');
	}
	
	function tambah() 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/tambah');
	}
	
	public function paparxlimit($cariID = null, $cariApa = null) 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$item = 1000; $ms = 1;
		# kod asas panggil sql
			$medan = '*'; # papar semua medan
			$carian[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			#foreach ($senaraiJadual as $key => $myTable)
			#{# mula ulang table
				/*# dapatkan bilangan jumlah rekod
				$bilSemua = $this->tanya->tatasusunanP
					//cariSemuaData //cariSql //kiraKes
					($myTable, $medan, $carian);
				# tentukan bilangan mukasurat. bilangan jumlah rekod
				//echo '$bilSemua:' . $bilSemua . ', $item:' . $item . ', $ms:' . $ms . '<br>';
				$jum = pencamSqlLimit($bilSemua, $item, $ms);
				$susun[] = array_merge($jum, array('kumpul'=>null,'susun'=>null) );
				$this->papar->bilSemua[$myTable] = $bilSemua;//*/
				# sql guna limit //$this->papar->senaraiApa = array();
				$this->papar->senaraiApa['data'] = $this->tanya->tatasusunanUbah2A
					//cariSemuaData //cariSql
					($myTable, $medan, $carian, $susun);
				# halaman
				$this->papar->halaman[$myTable] = halaman($jum);
			#}# tamat ulang table

		# semak data
		echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->senaraiApa:<br>'; print_r($this->papar->senaraiApa);
 		echo '</pre>'; //*/
		
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/papar');
	}

	public function paparlimit($cariID = null, $cariApa = null) 
	{
		# Set pemboleubah utama
		$this->papar->Tajuk_Muka_Surat='Enjin CRUD';
		$item = 1000; $ms = 1;
		# kod asas panggil sql
			$medan = '*'; # papar semua medan
			$jadual = '{jadual}';
			$cari[] = array('fix'=>'x=','atau'=>'WHERE','medan'=>$cariID,'apa'=>$cariApa);
			$jum2 = pencamSqlLimit(300, $item, $ms); #
			$susun[] = array_merge($jum2, array('kumpul'=>null,'susun'=>null) );
			# tanya Sql
			$this->papar->senaraiApa = $this->tanya->tatasusunanUbah2A
				//cariSemuaData //cariSql
				($jadual, $medan, $cari, $susun = null);

		/*# semak data
		echo '<pre>';
		//echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		//echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '$this->papar->senaraiApa:<br>'; print_r($this->papar->senaraiApa);
 		echo '</pre>'; //*/
		
		# pergi papar kandungan
		$this->papar->baca($this->_folder . '/papar');
	}
	   
    public function ubah($cariID = null, $medanID = null, $jadualUbah = null) 
    {//echo '<br>Anda berada di class Crud:ubah($cariID) extends \Aplikasi\Kitab\Kawal<br>';
                
        # senaraikan tatasusunan jadual dan setkan pembolehubah
		$this->papar->lokasi = 'Enjin - Ubah';
		$this->papar->_jadual = $jadualUbah;
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

		/*# semak data
		echo '<pre>';
		echo '$this->papar->senarai:<br>'; print_r($this->papar->senarai); 
		echo '<br>$this->papar->cariID:'; print_r($this->papar->cariID); 
		echo '<br>$this->papar->cariApa:'; print_r($this->papar->cariApa); 
		echo '<br>$this->papar->jumpa:'; print_r($this->papar->jumpa); 
		echo '<br>$this->papar->_jadual:'; print_r($this->papar->_jadual); 
		echo '</pre>'; //*/
		
        # pergi papar kandungan
        $this->papar->baca($this->_folder . '/ubah', 0);

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
		//echo '<br>location: ' . URL . $this->_folder . '/ubah/' . $dataID . '';
		header('location: ' . URL . $this->_folder . '/ubah/' . $dataID);

	}

    public function ubahSimpan($dataID)
    {
		# Set pemboleubah utama
    	$posmen = array();
		$nilaiRM = array('hasil','belanja','gaji','aset','staf','stok');
    	$medanID = '';
		$senarai = array('');
    
		# masuk dalam $posmen, validasi awal
        foreach ($_POST as $myTable => $value)
        {   if ( in_array($myTable,$senarai) )
            {   foreach ($value as $kekunci => $papar)
				{	$posmen[$myTable][$kekunci]= 
						( in_array($kekunci,$nilaiRM) ) ? # $nilaiRM rujuk line 154
						str_replace( ',', '', bersih($papar) ) # buang koma	
						: bersih($papar);
				}	$posmen[$myTable][$medanID] = $dataID;
            }
        }
        
		# ubahsuai $posmen, valiadi terperinci
			$jadual = ''; # setkan nama jadual 
			# valid guna gelung foreach
			foreach ($nilaiRM as $keyRM) # $nilaiRM rujuk line 154
			{# kod php untuk formula matematik
				if(isset($posmen[$jadual][$keyRM])):
					eval( '$data = (' . $posmen[$jadual][$keyRM] . ');' );
					$posmen[$jadual][$keyRM] = $data;
				endif;
			}/*$nilaiTEKS = array('no','batu','jalan','tmn_kg');
			foreach ($nilaiTEKS as $keyTEKS)
			{# kod php untuk besarkan semua huruf aka uppercase
				if(isset($posmen[$jadual][$keyTEKS])):
					$posmen[$jadual][$keyTEKS] = strtoupper($posmen[$jadual][$keyTEKS]);
				endif;
			}//*/ # valid guna if
			if (isset($posmen[$jadual]['email']))
				$posmen[$jadual]['email']=strtolower($posmen[$jadual]['email']);
			//if (isset($posmen[$jadual]['dp_baru']))
			//	$posmen[$jadual]['dp_baru']=ucwords(strtolower($posmen[$jadual]['dp_baru']));
			if (isset($posmen[$jadual]['responden']))
				$posmen[$jadual]['responden']=mb_convert_case($posmen[$jadual]['responden'], MB_CASE_TITLE);
			if (isset($posmen[$jadual]['password']))
			{
				//$pilih = null;
				$pilih = 'md5'; # Hash::rahsia('md5', $posmen[$jadual]['password'])
				//$pilih = 'sha256'; # Hash::create('sha256', $posmen[$jadual]['password'], HASH_PASSWORD_KEY)
				if (empty($posmen[$jadual]['password']))
					unset($posmen[$jadual]['password']);
				elseif ($pilih == 'md5')
					$posmen[$jadual]['password'] = 
						\Aplikasi\Kitab\Hash::rahsia('md5', $posmen[$jadual]['password']);
				elseif ($pilih == 'sha256')
					$posmen[$jadual]['password'] = 
						\Aplikasi\Kitab\Hash::create('sha256', $posmen[$jadual]['password'], HASH_PASSWORD_KEY);
			}
			
			# semak data
			echo '<pre>$_POST='; print_r($_POST) . '</pre>';
			echo '<pre>$posmen='; print_r($posmen) . '</pre>';
 
		# mula ulang $senarai
		foreach ($senarai as $kunci => $jadual)
		{# tanya sql sama ada papar atau simpan
			$this->tanya->ubahSqlSimpan//ubahSimpan
			($posmen[$jadual], $jadual, $medanID);
		}# tamat ulang $senarai
        
        # pergi papar kandungan
		//$this->papar->baca($this->_folder . '/ubah/' . $dataID);
		//header('location: ' . URL . $this->_folder . '/ubah/' . $dataID);
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
		$this->papar->baca($this->_folder . '/buang', 1);

    }
#==========================================================================================	
}