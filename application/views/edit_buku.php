<?php $this->load->view('header'); ?>
	<section>
	    <div class="container">
			<?php echo form_open('buku/edit_simpan');?>
			<?php echo form_hidden('id', $buku['id_buku']);?>

			<h3>Tambah Buku Baru</h3>
			<table border="1">
				<tr><td>Judul Buku</td><td><?= form_input('judul_buku',$buku['judul_buku'])?></td></tr>
				<tr><td>Pengarang</td><td><?= form_input('pengarang', $buku['pengarang']);?></td></tr>
				<tr><td>Penerbit</td><td><?= form_input('penerbit', $buku['penerbit']);?></td></tr>
				<tr><td>Tahun Terbit</td><td><?= form_input('tahun', $buku['tahun']);?></td></tr>
				<tr><td>Kategori</td>
				<td>
					<select name="kategori">
								<option value="--Pilih Kategori--">--Pilih Kategori--</option>
							<?php foreach ($kategori as $k) { ?>
								<option value="<?=$k->nama_kategori;?>" <?php if($buku['kategori'] == $k->nama_kategori){?> selected="selected" <?php }?>><?=$k->nama_kategori;?></option>
							<?php	} ?>
					</select>
				</td>
				</tr>
			</table>
			<?php echo form_submit('submit','Ubah'); echo anchor('buku', 'Kembali');?>
			<?php echo form_close();?>
		</div>
	</section>
<?php $this->load->view('footer'); ?>
