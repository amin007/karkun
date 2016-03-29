<?php
/*
echo '<pre>';
echo '$this->senarai:<br>'; print_r($this->senarai); 
echo '$this->cari:'; print_r($this->cari); 
echo '$this->carian:'; print_r($this->carian); 
echo '</pre>';
//*/

if(isset($this->senarai['data'][0]['id'])):
	// set pembolehubah
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = $this->cari;
	$mesej = '';//$carian .' ada dalam ' . $this->_jadual;
else:	// set pembolehubah
	$mencari = URL . 'kawalan/ubahCari/';
	$carian = null;
	$mesej = '::' . $this->cari .' tiada dalam ' . $this->_jadual;
endif;	
?>
<h1>Ubah Senarai<?=$mesej?></h1>
<div align="center"><form method="GET" action="<?=$mencari;?>" class="form-inline" autocomplete="off">
<div class="form-group"><div class="input-group">
	<input type="text" name="cari" class="form-control" value="<?=$carian;?>" 
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
if ($this->carian=='[tiada id diisi]')
{
    echo 'data kosong<br>';
}
else
{ // $this->carian=='id' - mula
    $cari = $this->carian;
    $s1 = '<span class="label">';
    $s2 = '</span>';
	$html = new \Aplikasi\Kitab\Html;
?>
	<form method="POST" action="<?php echo URL ?>kawalan/ubahSimpan/<?php echo $this->cari; ?>"
	class="form-horizontal">
	<!-- jadual rangka ########################################### --><?php
	foreach ($this->senarai as $myTable => $row)
	{// mula ulang $row
		for ($kira=0; $kira < count($row); $kira++)
		{//print the data row // <button type="button" class="btn btn-info">Info</button>
		#----------------------------------------------------------------------------
		foreach ($row[$kira] as $key=>$data): echo "\n\t\t";
			if (in_array($key,array('entah'))):
				echo '';
			else:
		?><div class="form-group">
			<label for="input<?php echo $key 
			?>" class="col-sm-2 control-label"><?php echo $key ?></label>
			<div class="col-sm-6">
			<?php $html->cariInput(null,$this->_jadual,$kira,$key,$data);
			echo "\n\t\t\t"; ?></div>
		</div><?php 
			endif;
		endforeach;
		}// final print the data row
		#----------------------------------------------------------------------------
	}// tamat ulang $row
	echo "\n\t\t";
	/*
	echo '<div class="form-group">
			<label for="inputSubmit" class="col-sm-3 control-label">Cth</label>
			<div class="col-sm-6">
				<input type="hidden" name="jadual" value="<?=$this->_jadual?>">
				
			</div>
		</div>';
	echo "\n\t\t";*/
	if(isset($this->kawalan['kes'][0]['newss'])):
	?><div class="form-group">
			<label for="inputSubmit" class="col-sm-3 control-label"><?=$this->_jadual?></label>
			<div class="col-sm-6">
				<input type="hidden" name="jadual" value="<?=$this->_jadual?>">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary btn-large">
			</div>
		</div>	
	</form>
	<hr>

<?php 
endif;
} // $this->carian=='sidap' - tamat ?><?php
// mula untuk kod php+html
function papar_jadual($row, $myTable, $pilih)
{
	if ($pilih == 2 && count($row) != 0)
    {	?><!-- Jadual <?php echo $myTable ?> ########################################### -->
		<span class="label label-success">Jadual <?php echo $myTable ?></span>
        <table class="table table-striped">
        <?php
        $printed_headers = false; ## mula bina jadual
        #-----------------------------------------------------------------
        for ($kira=0; $kira < count($row); $kira++)
        {##print the headers once:  
            if ( !$printed_headers )
            {	?><thead><tr>
        <th>#</th>
        <?php   foreach ( array_keys($row[$kira]) AS $tajuk ):
			?><th><?php echo $tajuk ?></th>
        <?php	endforeach; ?></tr></thead><?php
                $printed_headers = true;
            }#-----------------------------------------------------------------      
            ## print the data row ?>
            <tbody><tr>
            <td><?php echo $kira+1 ?></td>
            <?php foreach ( $row[$kira] as $key=>$data ) : ?>
            <td><?php echo $data ?></td><?php endforeach; ?>
        </tr></tbody>
		<?php
        }#-----------------------------------------------------------------
        ?></table><?php
    } 
}
// tamat untuk kod php+html 
