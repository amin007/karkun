<?php
/*
echo '<pre>';
echo '$this->senarai:<br>'; print_r($this->senarai); 
echo '<br>$this->cariID:'; print_r($this->cariID); 
echo '<br>$this->cariApa:'; print_r($this->cariApa); 
echo '<br>$this->jumpa:'; print_r($this->jumpa); 
echo '<br>$this->_jadual:'; print_r($this->_jadual); 
echo '<br>$this->_paparSahaja:'; print_r($this->_paparSahaja); 
echo '</pre>';
//*/

# set pembolehubah jika jumpa
if(isset($this->senarai['data'][0][$this->cariID])):
	$mencari = URL . 'crud/ubahCari/';
	$carian = $this->cariApa;
	$mesej = ''; // $this->cariApa .' ada dalam ' . $this->_jadual;
else: 
	$mencari = URL . 'crud/ubahCari/';
	$carian = null;
	$mesej = '::' . $this->cariID .' tidak jumpa di ' . $this->_jadual;
endif;	

# fikir atas umat
//$fikir = new \Aplikasi\Kitab\Vendor\Sultanjdt\Fikir; 
//$fikir = new \Aplikasi\Kitab\Vendor\Alamin\Fikir; 
$fikir = new Fikir; 
$fikir->umat();
?>
<h1>Ubah Senarai<?=$mesej?></h1>
<div align="center"><form method="GET" action="<?=$mencari?>" class="form-inline" autocomplete="off">
<div class="form-group"><div class="input-group">
	<input type="text" name="cari" class="form-control" value="<?=$carian?>" 
	id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
	<span class="input-group-addon">
	<input type="submit" value="mencari">
	</span>
</div></div>
<div class="suggestionsBox" id="suggestions" style="display: none;">
	<div class="suggestionList" id="autoSuggestionsList">&nbsp;</div>
</div>
</form></div><br>
<?php 
if ($this->cariApa=='[tiada id diisi]')
{
    echo 'data kosong<br>' . $this->jumpa;
}
else
{ # $this->carian=='id' - mula
	$lepas = array(); # medan yang tak perlu dipaparkan
	$html = new \Aplikasi\Kitab\Html; 
?>
	<form method="POST" action="<?php echo URL ?>crud/ubahSimpan/<?php echo $this->jumpa; ?>"
	class="form-horizontal">
	<!-- jadual rangka ########################################### --><?php
	paparMedanInput($this->senarai, $lepas, $html, $this->_jadual, $this->_paparSahaja);
	echo "\n\t\t"; //$cariID = 'xxx'; 
	$cariID = $this->cariID; 
	if(isset($this->senarai['data'][0][$cariID])):
	?><div class="form-group">
			<label for="inputSubmit" class="col-sm-3 control-label"><?=$this->_jadual?></label>
			<div class="col-sm-6">
				<input type="hidden" name="jadual" value="<?=$this->_jadual?>">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary btn-large">
			</div>
		</div>	
	</form><hr>
<?php 
endif;
} // $this->carian=='sidap' - tamat 

function paparMedanInput($senarai, $lepas, $html, $jadual, $_paparSahaja)
{
	foreach ($senarai as $myTable => $row)
	{# mula ulang $row
		for ($kira=0; $kira < count($row); $kira++)
		{#print the data row // <button type="button" class="btn btn-info">Info</button>
		#----------------------------------------------------------------------------
		foreach ($row[$kira] as $key=>$data): echo "\n\t\t";
			if (in_array($key,$lepas)): echo ''; else:
		?><div class="form-group">
			<label for="input<?php echo $key 
			?>" class="col-sm-2 control-label"><?php echo $key ?></label>
			<div class="col-sm-6">
			<?php echo $html->cariInput($_paparSahaja,$jadual,$kira,$key,$data);
			echo "\n\t\t\t"; ?></div>
		</div><?php 
			endif;
		endforeach;
		}# final print the data row
		#----------------------------------------------------------------------------
	}# tamat ulang $row
}