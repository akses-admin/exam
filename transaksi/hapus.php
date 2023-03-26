<?php

hapus_data('pembayaran', 'trxid=' . $_GET['trxid']);

set_flash('danger', 'Transaksi berhasil dihapus');
back();