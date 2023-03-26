<?php

hapus_data('spp', 'id_spp=' . $_GET['id_spp']);

set_flash('danger', 'SPP berhasil dihapus');
back();