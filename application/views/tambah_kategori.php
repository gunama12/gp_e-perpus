<?php $this->load->view('header'); ?>
<section>
    <div class="container">
		<?php echo form_open('kategori/tambah_simpan');?>


		<h3>Tambah Kategori Baru</h3>
		<table border="1">
			<tr><td>Nama Kategori</td><td><?= form_input('nama_kategori','', array('placeholder' => 'Nama Kategori'));?></td></tr>

		</table>
		<?php echo form_submit('submit','Simpan'); echo anchor('kategori', 'Kembali');?>
		<?php echo form_close();?>
	</div>
</section>
<?php $this->load->view('footer'); ?>
