<div id="container">
	<h1>CV. BINTANG ATRA SARANA KOMPUTER</h1>
	<h2>Jl. Krasak No 48, Kotabaru, Yogyakarta</h2>

	<div id="body">
		<?php
			echo $bio;
			echo $menu;
		?>
		<div class="cleaner_h10"></div>
		<p style="background-color:#FF3366; padding:5px; margin:0px; color:#FFFFFF;">Peringatan, melakukan restore database akan menghapus data yang 
		ada di server pusat...!!!</p>
		<div class="cleaner_h10"></div>
		<?php echo form_open_multipart('restore/upload'); ?>
			<input type="file" name="userfile" class="input-read-only" />
			<input type="submit" value="Restore Data" class="btn-kirim-login" />
		<?php echo form_close(); ?>
	</div>
