<?php
namespace Aplikasi\Kitab; //echo __NAMESPACE__; 
class Html
{
#==========================================================================================
	function inputTextMedan($jadual, $key)
	{	# istihar pembolehubah 
		$name = 'name="medan[' . $jadual . '][' . $key . ']"'
			  . ' id="' . $key . '"';
		
		$input = $key . '</td><td>'
			   . '<input type="text" ' . $name . ' value="' 
			   . $key . '" class="input-medium">';

		return $input . "\r";
	}

	function inputText($jadual, $key, $data)
	{	# istihar pembolehubah 
		$name = 'name="' . $jadual . '[' . $key . ']"'
			  . ' id="' . $key . '"';
		$medanApa = $jadual . '[' . $key . ']';
		$input = '<div class="input-prepend">' . $jadual
			   //. '<span class="add-on">' . $medanApa . '</span>' 
			   . '<input type="text" ' . $name . ' value="' 
			   . $data . '" class="input-medium"></div>';

		return '<td>' . $input . '</td>';
	}

	function semakMedanDaftar($myTable, $nama, $jenis, $data) 
	{
		return $myTable.'->'.$nama.'->'.$jenis.'='.$data;
	}

	function paparMedanDaftar($myTable, $nama, $jenis, $data) 
	{
		$namaMedan = 'name="' . $myTable . '[' . $nama . ']" '
				   . 'id="' . $nama . '"';
		$papar = null;
		
		if ($nama == 'password')
		{
			$papar = '<input type="password" ' . $namaMedan . ' class="span3">';
		}
		elseif ($nama == 'level')
		{
			$papar = '<select ' . $namaMedan . '>';
			$senaraiLevel= array('baru');
			
			foreach ($senaraiLevel as $key => $value)
			{
				$papar .= '<option value="' . $value . '">'
					   . ucfirst(strtolower($value)) 
					   . '</option>';
			}
			$papar .= '</select>';

		}
		elseif ($nama == 'jantina')
		{
			$papar = '<select ' . $namaMedan . '>';
			$senaraiJantina = array('lelaki','perempuan');
			
			foreach ($senaraiJantina as $key => $value)
			{
				$papar .= '<option value="' . $value . '">'
					   . ucfirst(strtolower($value)) 
					   . '</option>';
			}
			$papar .= '</select>';
		}
		else
		{
			$papar = inputDaftar($jenis, $namaMedan, $data);
		}

		return $papar;
	}

	function inputDaftar($jenis, $namaMedan, $data)
	{
			switch ($jenis) 
			{# mula - pilih type
			case 'varchar(15)':
				$papar = '<input type="text" ' . $namaMedan . ' class="span2">';
				break;
			case 'varchar(20)':
				$papar = '<input type="text" ' . $namaMedan . ' class="span3">';
				break;
			case 'varchar(35)':
				$papar = '<input type="text" ' . $namaMedan . ' class="span4">';
				break;
			case 'varchar(50)':
				$papar = '<input type="text" ' . $namaMedan . ' class="span5">';
				break;		
			case 'date':
				$papar = '<input type="text" ' . $namaMedan . ' class="input-small tarikh" readonly">';
				break;
			case 'text':
				$jenisText = $namaMedan . ' rows="3" cols="30" ';
				$papar = '<textarea ' . $jenisText . '></textarea>';
				break;
			default: 
				$papar="$namaMedan-$jenis-$data"; 
				break;
			}# tamat - pilih type

			return $papar;
	}

	function paparMedanDaftarSesi($myTable, $nama, $jenis, $data, $sesi) 
	{
		$namaMedan = 'name="' . $myTable . '[' . $nama . ']" '
				   . 'id="' . $nama . '"';
		$papar = null;
			
		if ($nama == 'nama_penuh')
		{
			$papar = '<input type="text" ' . $namaMedan 
				   . ' value="' . $sesi['namaPenuh'] . '" class="span4">';
		}
		elseif ($nama == 'namapengguna')
		{
			$papar = '<input type="text" ' . $namaMedan 
				   . ' value="' . $sesi['pengguna'] . '" class="span4">';

		}
		elseif ($nama == 'level')
		{
			$papar = '<select ' . $namaMedan . '>';
			$senaraiPengguna= array('baru');
			
			foreach ($senaraiPengguna as $key => $value)
			{
				$papar .= '<option value="' . $value . '"';
				$papar .= ($value == $sesi['level']) ? ' selected >' : '>';
				$papar .= ucfirst(strtolower($value));
				$papar .= '</option>';
			}
			$papar .= '</select>';

		}
		elseif ($nama == 'jantina')
		{
			$papar = '<select ' . $namaMedan . '>';
			$senaraiJantina = array('lelaki','perempuan');
			
			foreach ($senaraiJantina as $key => $value)
			{
				$papar .= '<option value="' . $value . '">'
					   . ucfirst(strtolower($value)) 
					   . '</option>';
			}
			$papar .= '</select>';
		}
		elseif ($nama == 'password')
		{
			$papar = '<input type="password" ' . $namaMedan . ' class="span3">';
		}
		elseif ($nama == 'level')
		{
			$papar = '';
		}
		else
		{
			$papar = inputDaftar($jenis, $namaMedan, $data);
		}

		return $papar;
	}

	function ubahMedanSesi($myTable, $nama, $jenis, $data) 
	{
		$namaMedan = 'name="' . $myTable . '[' . $nama . ']" '
				   . 'id="' . $nama . '"';

		//$papar = null;
			
		if ($nama == 'level')
		{
			/*
			$papar = '<select ' . $namaMedan . '>';
			$senaraiPengguna= array('baru');
			
			foreach ($senaraiPengguna as $key => $value)
			{
				$papar .= '<option value="' . $value . '"';
				$papar .= ($value == $data) ? ' selected >' : '>';
				$papar .= ucfirst(strtolower($value));
				$papar .= '</option>';
			}
			$papar .= '</select>';
			*/
			$papar = null;

		}
		elseif ($nama == 'jantina')
		{
			$papar = '<select ' . $namaMedan . '>';
			$senaraiJantina = array('lelaki','perempuan');
			
			foreach ($senaraiJantina as $key => $value)
			{
				$papar .= '<option value="' . $value . '"';
				$papar .= ($value == $data) ? ' selected >' : '>';
				$papar .= ucfirst(strtolower($value));
				$papar .= '</option>';
			}
			$papar .= '</select>';
		}
		elseif ($nama == 'password')
		{
			$papar = '<input type="password" ' . $namaMedan . ' value="' . $data . '" class="span3">';
		}
		else
		{
			$papar = ubahInputDaftar($jenis, $namaMedan, $data);
		}

		return $papar;
	}

	function ubahInputDaftar($jenis, $namaMedan, $data)
	{
			switch ($jenis) 
			{# mula - pilih type
			case 'varchar(15)':
				$papar = '<input type="text" ' . $namaMedan . ' value="' . $data . '" class="span2">';
				break;
			case 'varchar(20)':
				$papar = '<input type="text" ' . $namaMedan . ' value="' . $data . '" class="span3">';
				break;
			case 'varchar(35)':
				$papar = '<input type="text" ' . $namaMedan . ' value="' . $data . '" class="span4">';
				break;
			case 'varchar(50)':
				$papar = '<input type="text" ' . $namaMedan . ' value="' . $data . '" class="span5">';
				break;
			case 'date':
				$papar = '<input type="text" ' . $namaMedan . ' value="' . $data . '" class="input-small tarikh" readonly">';
				break;
			case 'text':
				$jenisText = $namaMedan . ' rows="3" cols="30" ';
				$papar = '<textarea ' . $jenisText . '>' . $data . '</textarea>';
				break;
			default: 
				$papar="$namaMedan-$data"; 
				break;
			}# tamat - pilih type

			return $papar;
	}
	
	public function cariInput($paparSahaja,$jadual,$kira,$key,$data)
	{	# istihar pembolehubah 
		$name = 'name="' . $jadual . '[' . $key . ']"';
		$inputText = $name . ' value="' . $data . '"';
		$tabline = "\n\t\t\t\t\t";
		$tabline2 = "\n\t\t\t\t";
		//if ( in_array($key,array(...)) )
		if(in_array($key,array('nota','catatan')))
		{#kod utk textarea
			$input = '<textarea ' . $name . ' rows="1" cols="20"' . $tabline2 
				   . ' class="form-control">' . $data . '</textarea>'
				   . $tabline2 . '<pre>' . $data . '</pre>'
				   . '';
		}
		elseif(in_array($key,array('nama','emailx')))
		{#kod utk input text saiz besar
			$input = '<div class="input-group input-group-lg">' . $tabline
				   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
				   . '<input type="text" ' . $inputText 
				   . ' class="form-control">'
				   . $tabline2 . '</div>'
				   . '';
		}
		elseif(in_array($key,array('email')))
		{#kod utk input text saiz biasa
			$input = '<div class="input-group input-group">' . $tabline
				   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
				   . '<input type="text" ' . $inputText 
				   . ' class="form-control">'
				   . $tabline2 . '</div>'
				   . '';
		}
		elseif(in_array($key,array('tel','fax','nohp')))
		{#kod utk input text saiz kecil
			$input = '<div class="input-group input-group-sm">' . $tabline
				   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
				   . '<input type="text" ' . $inputText 
				   . ' class="form-control">'
				   . $tabline2 . '</div>'
				   . '';
		}
		elseif(in_array($key,array('hasil','belanja','staf','gaji','aset','stok')))
		{#kod utk input paparkan nilai asal sebelum ubah
			$input = '<div class="input-group input-group-sm">' . $tabline
				   . '<span class="input-group-addon">Nilai</span>'		
				   . '<input type="text" ' . $inputText 
				   . ' class="form-control">' . $tabline
				   . '<span class="input-group-addon">' . kira($data) . '</span>'
				   . $tabline2 . '</div>'
				   . '';
		}
		elseif ( in_array($key,array('password')) )
		{#kod untuk input password
			$input = '<div class="input-group input-group-sm">' . $tabline
				   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
				   . '<input type="password" ' . $name
				   . $tabline . ' placeholder="Tukar kata laluan"'
				   . ' class="form-control">'
				   . $tabline2 . '</div>'
				   . '';			
		}
		elseif ( in_array($key,array('lawat','terima','hantar','hantar_prosesan')) )
		{#kod utk input tarikh
		#terima - style="font-family:sans-serif;font-size:10px;"
			$tandaX = 'name="' . $jadual . '[' . $key . 'X]"';
			$dataX = ($key=='hantar_prosesan') ?
				'<input type="checkbox" ' . $tandaX . ' value="x">Utk Prosesan : ' . $data
				: '<input type="checkbox" ' . $tandaX . ' value="x">' . $data;
			$input = '<div class="input-group input-group-sm">' . $tabline
				   . '<span class="input-group-addon">' . $dataX . '</span>' . $tabline
				   . '<input type="date" ' . $inputText //. 'class="input-date tarikh" readonly>'
				   . $tabline . ' class="form-control date-picker"'
				   . $tabline . ' placeholder="Cth: 2014-05-01"'
				   . $tabline . ' id="date' . $key . '" data-date-format="yyyy/mm/dd"/>'
				   . $tabline2 . '</div>'
				   . '';			   
		}
		elseif ( in_array($key,array('jantina')) )
		{#kod untuk input select option
			# set pembolehubah
			$input2 = null;
			$senaraiJantina = array('lelaki','perempuan');
			
			foreach ($senaraiJantina as $key => $value)
			{
				$input2 .= '<option value="' . $value . '"';
				$input2 .= ($value == $data) ? ' selected>*' : '>';
				$input2 .= ucfirst(strtolower($value));
				$input2 .= '</option>' . $tabline;
			}

			# cantumkan dalam input
			$input = '<div class="input-group input-group-sm">' . $tabline
				   . '<span class="input-group-addon">' . $data . '</span>' . $tabline
				   . '<select ' . $name . ' class="form-control">' . $tabline
				   . $input2 . '</select>'
				   . $tabline2 . '</div>'
				   . '';
		}
		# kod html untuk bukan input type		
		elseif ( in_array($key,array('keterangan')) )
		{#kod untuk papar jadual
			//echo '$paparSahaja-><pre>'; print_r($paparSahaja) . '<pre>';
			//var_export($paparSahaja) . '<pre>';
			# set nama class untuk jadual
			$jadual1 = ' table-striped'; # tambah zebra
			$jadual2 = ' table-bordered';
			$jadual3 = ' table-hover';
			$jadual4 = ' table-condensed'; 
			$classJadual = 'table' . $jadual4 . $jadual3;
			foreach ($paparSahaja as $myTable => $bilang)
			{# mula ulang $bilang
				$this->papar_jadual($bilang, $myTable, $pilih=4, $classJadual);
			}# tamat ulang $bilang //*/
			
			$input = '';
		}
		elseif ( in_array($key,array('alamat_baru')) )
		{#kod untuk  blockquote
			$input = '<blockquote>'
				   . '<p class="form-control-static text-info">' . $data . '</p>'
				   //. '<small>Alamat <cite title="Source Title">baru</cite></small>'
				   . '</blockquote>';
		}
		else
		{#kod untuk lain2
			$input = '<p class="form-control-static text-info">' . $data . '</p>';
		}
		
		return $input;
	}
	
	# mula untuk kod php+html 
	function papar_jadual($row, $myTable, $pilih, $classTable = null)
	{
		if ($pilih == 1) 
		{
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
			?><!-- Jadual <?php echo $myTable ?> -->	
			<table border="1" class="excel" id="example">
			<?php $printed_headers = false; # mula bina jadual
			#-----------------------------------------------------------------
			for ($kira=0; $kira < count($row); $kira++)
			{	# print the headers once: 	
				if ( !$printed_headers ) : ?><thead><tr>
			<th>#</th><?php foreach ( array_keys($row[$kira]) as $tajuk ) :
			?><th><?php echo $tajuk ?></th>
			<?php endforeach; ?></tr></thead>
			<?php	$printed_headers = true; 
				endif;
			#- print the data row --------------------------------------------
			?><tbody><tr>
			<td><?php echo $kira+1 ?></td>	
			<?php foreach ( $row[$kira] as $key=>$data ) : 
			?><td><?php echo $data ?></td>
			<?php endforeach; ?></tr></tbody>
			<?php
			}#-----------------------------------------------------------------
			?></table><?php echo "\r" ?><!-- Jadual <?php echo $myTable ?> --><?php
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
		} elseif ($pilih == 2) {
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
			?><!-- Jadual <?php echo $myTable ?> -->	
			<table border="1" class="excel" id="example"><?php
			$printed_headers = false; # mula bina jadual
			#-----------------------------------------------------------------
			for ($kira=0; $kira < count($row); $kira++)
			{	# cetak tajuk hanya sekali sahaja :
				if ( !$printed_headers ) : ?>
			<thead><tr>
			<th>#</th><?php
					foreach ( array_keys($row[$kira]) AS $tajuk ) 
					{ 	if ( !is_int($tajuk) ) :
							$paparTajuk = ($tajuk=='nama') ?
							$tajuk . '(jadual:' . $myTable . ')'
							: $tajuk; ?>
			<th><?php echo $paparTajuk ?></th>
			<?php		endif;
					}
			?></tr></thead><?php
					$printed_headers = true; 
				endif; 
			#- cetak hasil $data ---------------------------------------------?>
			<tbody><tr>
			<td><?php echo $kira+1 ?></td>	
			<?php
				foreach ( $row[$kira] AS $key=>$data ) 
				{
					if ($key=='sidap') :
						$sidap= $data;
						$ssm = substr($data,0,12); 
					elseif ($key=='nama') :
						$syarikat = $data;
					endif;
					?><td><?php echo $data ?></td>
			<?php
				} 
				?></tr></tbody>
			<?php
			}
			#-----------------------------------------------------------------
			?></table><!-- Jadual <?php echo $myTable ?> --><?php
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
		} elseif ($pilih == 3) {
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
			?><!-- Jadual <?php echo $myTable ?>  --><?php
			for ($kira=0; $kira < count($row); $kira++)
			{// ulang untuk $kira++ ?>
			<table border="1" class="excel" id="example">
			<tbody><?php foreach ( $row[$kira] as $key=>$data ):?>
			<tr>
			<td><?php echo $key ?></td>
			<td><?php echo $data ?></td>
			</tr>
			<?php endforeach; ?></tbody>
			</table>
			<?php
			}# ulang untuk $kira++ ?>
			<!-- Jadual <?php echo $myTable ?> --><?php
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
		} elseif ($pilih == 4) { 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
			?><!-- Jadual <?php echo $myTable ?> -->	
			<table class="<?php echo $classTable ?>">
			<?php $printed_headers = false; # mula bina jadual
			#-----------------------------------------------------------------
			for ($kira=0; $kira < count($row); $kira++)
			{	# cetak tajuk hanya sekali sahaja :
				if ( !$printed_headers ) : ?><thead><tr>
			<th>#</th><?php foreach ( array_keys($row[$kira]) as $tajuk ) :
			?><th><?php echo $tajuk ?></th><?php endforeach; 
			?></tr></thead>
			<?php	$printed_headers = true; 
				endif;
			# cetak hasil $data --------------------------------------------
			?><tbody><tr>
			<td><?php echo $kira+1 ?></td><?php 
				foreach ( $row[$kira] as $key=>$data ) : 
			?><td><?php echo $data ?></td><?php 
				endforeach; ?>  
			</tr></tbody>
			<?php
			}
			#-----------------------------------------------------------------
			?></table><?php echo "\r\t\t\t"; ?><!-- Jadual <?php echo $myTable ?> --><?php echo "\r\t\t\t";
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
		} elseif ($jadual == 5) { 
		# nilai akan dipulangkan balik
			$bil_tajuk = $row['bil_tajuk'];// => 8
			$bil_baris = $row['bil_baris']; 

			$output  = null; 
			//$output .= '<br>$bil_tajuk=' . $bil_tajuk;
			//$output .= '<br>$bil_baris=' . $bil_baris;
			$output .= '<table border="1" class="excel" id="example">
			<thead><tr>
			<th colspan="' . $bil_tajuk . '">
			<strong>Jadual ' . $myTable . ' : ' . $bil_tajuk . '
			</strong></th>
			</tr></thead>';

			# mula bina jadual
			$printed_headers = false; 
			#-----------------------------------------------------------------
			for ($kira=0; $kira < $bil_baris; $kira++)
			{
				//print the headers once: 	
				if ( !$printed_headers ) 
				{##============================================================
				$output .= "\r\t<thead><tr>\r\t<th>#</th>";
				foreach ( array_keys($row[$kira]) as $tajuk ) :
					$output .= "\r\t" . '<th>' . $tajuk . '</th>';
				endforeach;
				$output .= "\r\t" . '</tr></thead>';
				##=============================================================
					$printed_headers = true; 
				} 
			#-----------------------------------------------------------------		 
				//print the data row 
				$output .= "\r\t<tbody><tr>\r\t<td>" . ($kira+1) . '</td>';
				foreach ( $row[$kira] as $key=>$data ) :
					$output .= "\r\t" . '<td>' . $data . '</td>';
				endforeach; 
				$output .= "\r\t" . '</tr></tbody>';
			}
			#-----------------------------------------------------------------
			$output .= "\r\t" . '</table>';

			return $output;

		} # tamat if ($jadual == 5
	}
	# tamat untuk kod php+html 

#==========================================================================================
}
