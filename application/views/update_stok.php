<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<h3>Tambah Stok Buku</h3>
			<p>Judul Buku : <?= $buku['judul_buku'];?></p>
			<p>Kode Stok Terakhir : <?= $buku['kode_buku'];?></p>
			<p>Total Stok : <?=$stok?></p>
			<?php echo form_open('buku/simpan_update_stok');
			      echo form_hidden('kode_baru',$buku['kode_baru']);
			      echo form_hidden('id_buku',$buku['id_buku']);
			?>
			<p>Jika Anda Menambah Stok maka kode stok akan dimulai dari <?=$buku['kode_baru'];?></p>
			<table border="1px">
			  <tr><td>Tambah Stok :</td><td><?=form_input(array('name' => 'stok', 'value'=>'1' ,'type' => 'number',  'min' => '1'))?></td></tr>
			  <tr><td></td><td><?= form_submit('submit', 'Tambah Stok');?></td></tr>
			</table>
			<?php echo form_close(); echo anchor('buku', 'Kembali');?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>

