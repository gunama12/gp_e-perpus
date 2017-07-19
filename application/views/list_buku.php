<?php $this->load->view('header'); ?>
    <section>
        <div class="container">
            <h1>Daftar Buku</h1>
            <?php if($this->session->flashdata('pesan')){ ?>
                <div class="alert alert-info">
                    <h4><?= $this->session->flashdata('pesan'); ?></h4>
                </div>        
            <?php } ?>
            <?php 
                if($this->ion_auth->is_admin()){
                    echo anchor('Buku/tambah_buku','Tambah Judul Buku' , array('class' => 'btn btn-info'));
                }

            ?>

            <table border="1">
             <tr><td>Judul Buku</td><td>Pengarang</td><td>Penerbit</td><td>Tahun</td><td>Kategori</td><td>Stok Tersedia</td><td>Total Stok</td><td>Aksi</td></tr>

             <?php foreach ($list_buku as $buku) { ?>

              <tr>
                <td><?= anchor('buku/detail_buku/'.$buku->id_buku,$buku->judul_buku);?></td>
                <td><?= $buku->pengarang;?></td>
                <td><?= $buku->penerbit;?></td>
                <td><?= $buku->tahun;?></td>
                <td><?= $buku->kategori;?></td>
                <td><?= $buku->stok;?></td>
                <td><?= $buku->jumlah_stok;?></td>
                <td><?php
                        if($this->ion_auth->is_admin()){
                            echo anchor('buku/edit_buku/'.$buku->id_buku, 'Ubah ').anchor('buku/update_stok/'.$buku->id_buku, 'Tambah Stok ').anchor('buku/hapus_buku/'.$buku->id_buku, 'Hapus ');
                        }else{
                            echo anchor('pemesanan/pre_pemesanan/'.$buku->id_buku, 'Pesan Buku');        
                        }
                    ?>

                </td>
              </tr>

             <?php } ?>
            </table>        
        </div>
    </section>
<?php $this->load->view('footer'); ?>