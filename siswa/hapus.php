<?php

hapus_data('siswa', 'id_siswa=' . $_GET['id_siswa']);

set_flash('danger', 'Siswa berhasil dihapus');
back();