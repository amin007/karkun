<?php 
if ($this->senaraiApa=='[id:0]')
{
	echo 'data kosong<br>';
}
else
{ // $this->senaraiApa=='' - mula
	$html = new \Aplikasi\Kitab\Html; 
?>

<div class="tabbable tabs-top">
	<ul class="nav nav-tabs putih">
<?php 
foreach ($this->senaraiApa as $jadual => $baris)
{
	if ( count($baris)==0 )
		echo '';
	else
	{	//$mula = ($jadual=='rangka') ? ' class="active"' : '';
	?>
	<li><a href="#<?php echo $jadual ?>" data-toggle="tab">
		<span class="badge badge-success"><?php echo $jadual ?></span>
		<span class="badge"><?php echo count($baris) ?></span>
		</a></li>
<?php
	}
}
?>	</ul>
<div class="tab-content">
<?php 
foreach ($this->senaraiApa as $myTable => $row)
{
	if ( count($row)==0 )
		echo '';
	else
	{
		$mula2 = ($jadual=='xxx') ? ' active' : '';?>
	<div class="tab-pane<?php echo $mula2?>" id="<?php echo $myTable ?>"><?php 
	echo "\r";
	# set nama class untuk jadual
	$jadual1 = ' table-striped'; # tambah zebra
	$jadual2 = ' table-bordered';
	$jadual3 = ' table-hover';
	$jadual4 = ' table-condensed'; 
	$classJadual = 'table' . $jadual4 . $jadual3;
	$html->papar_jadual($row, $myTable, $pilih=1, $classJadual);
	echo "\r";?>
	</div>
<?php
	} // if ( count($row)==0 )
}
?>	
</div><!-- class="tab-content" -->
</div><!-- /tabbable -->
 
<?php //echo $this->halaman[''] ?>

<?php } // $this->carian=='' - tamat ?>