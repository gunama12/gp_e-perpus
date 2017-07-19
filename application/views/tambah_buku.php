<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
	    <?php echo form_open_multipart('buku/tambah_simpan');?>
		<h3>Tambah Judul Buku Baru</h3>
		<?php if($this->session->flashdata('pesan')){ ?>
		<div class="alert alert-info">
			<h4><?= $this->session->flashdata('pesan'); ?></h4>
		</div>
		<?php } ?>
		<table border="1"  width="40%">
			<tr><td>Judul Buku</td><td><?= form_input('judul_buku','', array('placeholder' => 'Judul Buku', 'required' => ''));?></td></tr>
			<tr><td>Pengarang</td><td><?= form_input('pengarang','', array('placeholder' => 'Pengarang'));?></td></tr>
			<tr><td>Penerbit</td><td><?= form_input('penerbit','', array('placeholder' => 'Penerbit'));?></td></tr>
			<tr><td>Tahun Terbit</td><td><?= form_input('tahun','', array('placeholder' => 'Tahun'));?></td></tr>
			<tr><td>Kategori</td>
				<td>
					<select class="" name="kategori">
							<option value="--Pilih Kategori--">--Pilih Kategori--</option>
							<?php foreach ($kategori as $k) { ?>
								<option value="<?=$k->nama_kategori;?>"><?=$k->nama_kategori;?></option>
							<?php	} ?>
					</select>
				</td>
			</tr>
			<tr><td>Jumlah Stok</td><td><?= form_input(array('name' => 'jumlah_stok','value' => '0','type' => 'number', 'min' => '0'));?></td></tr>
			<tr><td>3 Kode Awal Buku</td><td><?= form_input('kode','', array('maxlength'     => '3', 'minlength'     => '3','required'     => '','placeholder' => 'Contoh : KDB, Hasil=KDB01 - KDB[jumlah_stok]', 'style'         => 'width:100%'));?></td></tr>
			<tr><td>Foto Buku</td><td><input type="file" name="userfile" size="20" required="" /></td></tr>
		</table>
		<?php echo form_submit('submit','Simpan ');  echo anchor('buku', 'Kembali');?>
		<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>
