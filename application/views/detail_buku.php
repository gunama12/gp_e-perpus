<?php $this->load->view('header'); ?>
<section>
    <div class="container">
      <h3>Detail Buku : <?=$buku['judul_buku'];?></h3>
      <p><?=$this->session->flashdata('pesan');?></p>

      <img src="<?=base_url('foto_buku/'.$buku['foto_buku']);?>" width="250px" height="350px"alt="" />

        <p>Pengarang :  <?=$buku['pengarang'];?></p>
        <p>penerbit :  <?=$buku['penerbit'];?></p>
        <p>Tahun :  <?=$buku['tahun'];?></p>
        <p>Kategori :  <?=$buku['kategori'];?></p>
        <h2>Daftar Stok :</h2>
        <table>
          <tr><td>Kode Buku</td><td>Status</td><?php if($this->ion_auth->is_admin()){ ?><td>Hapus</td> <?php } ?></tr>
          <?php foreach ($bukus as $bukus): ?>
            <tr>
              <td>
                <?= $bukus->kode_buku;?>
              </td>
              <td>
                <?php if($bukus->status == 0 ){
                  echo "Dipinjam";
                }else{
                  echo "Tersedia";
                }
                ?>
              </td>
              <?php if($this->ion_auth->is_admin()) { ?>
              <td>
                <?= anchor('buku/hapus_bukus/'.$bukus->id_bukus.'/'.$bukus->id_buku, 'Hapus');?>
              </td>
              <?php } ?>
            </tr>
          <?php endforeach; ?>
        </table>
    </div>
</section>
<?php $this->load->view('footer'); ?>
