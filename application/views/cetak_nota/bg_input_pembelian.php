<link href="<?php echo base_url(); ?>asset/css/chosen.css" rel="stylesheet" type="text/css">
<div id="container">
	<h1>CV. BINTANG ATRA SARANA KOMPUTER</h1>
	<h2>Jl. Krasak No 48, Kotabaru, Yogyakarta</h2>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
	<h6><?php echo $jdl; ?> Data - Pembelian</h6>
		<div id="body">
		<h3> Data Pelanggan</h3>
			<table width="100%" cellpadding="3" cellspacing="0">
				<tr><td width="130">Kode Pesanan</td><td width="20">:</td><td><input type="text" value="<?php echo $kode_pesanan; ?>" class="input-read-only" readonly="true" 
				 style="width:350px;" name="kode_pesanan" /></td></tr>
				<tr><td width="180">Nama Pelanggan</td><td>:</td><td>
				<select data-placeholder="Cari nama pelanggan..." class="chzn-select" style="width:500px;" tabindex="2" name="kode_pelanggan" id="kode_pelanggan">
          		<option value=""></option> 
					<?php
						foreach($dt_pelanggan->result_array() as $dp)
						{
						$pilih='';
						if($dp['kode_pelanggan']==$this->session->userdata("kd_pemesan"))
						{
						$pilih='selected="selected"';
					?>
						<option value="<?php echo $dp['kode_pelanggan']; ?>" <?php echo $pilih; ?>><?php echo $dp['nama_pelanggan']; ?></option>
					<?php
					}
					else
					{
					?>
						<option value="<?php echo $dp['kode_pelanggan']; ?>"><?php echo $dp['nama_pelanggan']; ?></option>
					<?php
					}
						}
					?>
				</select>
				</td></tr>
				<tr><td colspan="4"><div id="data_pelanggan"></div></td></tr>
			</table>
			
		<h3>Data Pembelian</h3>
			<?php echo form_open('cetak_nota/update_pesanan'); ?>
			<table border="1" cellpadding="3" cellspacing="0" width="100%" style=" border-collapse: collapse;" class="record">
			<tr style="background-color:#333; color:#FFFFFF;" align="center">
				<td>No.</td>
				<td>Kode Barang</td>
				<td>Nama Barang</td>
				<td>Jumlah Pesanan</td>
				<td>Harga</td>
				<td>Sub Total</td>
				<td width="130"><a href="<?php echo base_url(); ?>cetak_nota/daftar_barang" class="cblsbarang"><div class="btn-add">Tambah Pembelian</div></a></td>
			</tr>
			<?php $i = 1; $no=1;?>
			<?php foreach($this->cart->contents() as $items): ?>
			
			<?php echo form_hidden('rowid[]', $items['rowid']); ?>
			<tr class="content">
				
				<td class="td-keranjang"><?php echo $no; ?></td>
				<td class="td-keranjang"><?php echo $items['id']; ?></td>
				<td class="td-keranjang"><?php echo $items['name']; ?></td>
				<td class="td-keranjang">
				<input type="hidden" name="qty_terkirim[]" value="0" />
				<select name="qty[]" class="input-read-only" style="width:100px;">
					<?php 
					for($i=0;$i<=$this->app_model->getSisaStok($items['id']);$i++)
					{
					if($i==$items['qty'])
					{
						echo "<option selected>".$items['qty']."</option>";
					}
					else
					{
						echo "<option>".$i."</option>";
					}
					}	
					?>
				</select>
				</td>
				
				<td class="td-keranjang">Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
				<td class="td-keranjang">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
				<td class="td-keranjang" align="center">
				<a href="#" class="delbutton" id="<?php echo 'tambah/'.$items['rowid'].'/'.$kode_pesanan.'/'.$items['id'].'/'.$this->app_model->getSisaStok($items['id']).'/'.$items['qty']; ?>">
				<div class="btn-delete">Hapus Pesanan</div></a></td>
			</tr>
	  	
	  	<?php $i++; $no++;?>
		<?php endforeach; ?>
			<tr>
				<td colspan="5">Total</td>
				<td>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td>
				<td><input type="submit" class="btn-add" value="Save"></td>
			</tr>
			</table>
			<?php echo form_close(); ?>
			<div class="cleaner_h10"></div>
			
		<?php $atr = array('name' => 'frm', 'id' => 'frm'); echo form_open('cetak_nota/simpan_pesanan',$atr); ?>
				<input type="hidden" name="stts_order" value="Ok" />
			<div class="cleaner_h10"></div>
			<input type="submit" class="btn-kirim-login" value="Simpan Data Pembelian" name="add" id="add">
			<script src="<?php echo base_url(); ?>asset/js/chosen.jquery.js" type="text/javascript"></script>
			<script type="text/javascript"> $(".chzn-select").chosen().change(function(){ 
						var kode_pelanggan = $("#kode_pelanggan").val(); 
						$.ajax({ 
						url: "<?php echo base_url(); ?>pemesanan/ambil_data_pelanggan_ajax", 
						data: "kode_pelanggan="+kode_pelanggan, 
						cache: false, 
						success: function(msg){ 
						$("#data_pelanggan").html(msg); 
					} 
				})
				});
				$('#data_pelanggan').load('<?php echo base_url(); ?>pemesanan/ambil_data_pelanggan_session');
				
				$(document).ready(function() {
					$(".delbutton").click(function(){
					 var element = $(this);
					 var del_id = element.attr("id");
					 var info = del_id;
					 if(confirm("Anda yakin akan menghapus?"))
					 {
							 $.ajax({
							 url: "<?php echo base_url(); ?>pemesanan/hapus_pesanan", 
							 data: "kode="+info, 
							 cache: false, 
							 success: function(){
							 }
						 });	
					 	$(this).parents(".content").animate({ opacity: "hide" }, "slow");
						}
					 return false;
					 });
				})
				function enableButton()
				{
					document.frm.add.disabled=false;
				}
			</script>
		<?php echo form_close(); ?>
		</div>
	</div>