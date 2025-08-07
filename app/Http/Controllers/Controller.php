<?php

namespace App\Http\Controllers;



use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function generateIdPembelian()
    // {
    //     do {
    //         $code = "TRM" . random_int(1000000, 9999999);
    //     } while (Pembelian::where("id_pembelian", "=", $code)->first());

    //     return $code;
    // }

    // public function generateIdPenjualan()
    // {
    //     do {
    //         $code = "TRK" . random_int(1000000, 9999999);
    //     } while (Penjualan::where("id_penjualan", "=", $code)->first());

    //     return $code;
    // }

    // public function insertKeuangan($akun, $id, $value1 = 0)
    // {
    //     $inputData = array(
    //         'akun' => $akun,
    //         'tanggal' => date('Y-m-d H:i:s'),
    //     );

    //     if ($akun == "PEMBELIAN") {
    //         //$total_pembelian = $this->db->query("SELECT sum(jumlah*harga_beli) as total_pembelian FROM tbl_detail_pembelian WHERE id_masuk='".$id."' ")->row()->total_pembelian;
    //         $keterangan = "Pembelian Dengan ID " . $id;
    //         $inputData['id_masuk'] = $id;
    //         $inputData['modal_keluar'] = $total_pembelian;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "PENJUALAN") { //(akun,id_transaksi)
    //         $keterangan = 'PENJUALAN ID TRX ' . $id;
    //         // $this->db->select("sum(harga_beli*jumlah) as total_modal, sum((harga_jual-harga_beli)*jumlah) as total_keuntungan");
    //         // $this->db->join('tbl_transaksi','tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi');
    //         // $this->db->where('tbl_detail_transaksi.id_transaksi',$id);
    //         // $data_trx = $this->db->get('tbl_detail_transaksi')->row();
    //         $inputData['id_transaksi'] = $id;
    //         $inputData['modal_masuk'] = $data_trx->total_modal;
    //         $inputData['keuntungan_masuk'] = $data_trx->total_keuntungan;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "RETUR_PENJUALAN") { //(akun,id_transaksi)
    //         $keterangan = 'RETUR PENJUALAN ID TRX' . $id;
    //         // $this->db->select("sum(harga_beli*jumlah) as total_modal, sum((harga_jual-harga_beli)*jumlah) as total_keuntungan");
    //         // $this->db->join('tbl_pembelian','tbl_pembelian.id_masuk=tbl_detail_pembelian.id_masuk');
    //         // $this->db->where('id_return_transaksi',$id);
    //         // $this->db->where('status',0);
    //         $data_return = $this->db->get('tbl_detail_pembelian')->row();
    //         $inputData['id_transaksi'] = $id;
    //         $inputData['modal_keluar'] = $data_return->total_modal;
    //         $inputData['keuntungan_keluar'] = $data_return->total_keuntungan;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "RETUR_PEMBELIAN") { //(akun,id_transaksi)
    //         // $this->db->select("sum(harga_beli*jumlah) as total_modal, sum((harga_jual-harga_beli)*jumlah) as total_keuntungan");
    //         // $this->db->join('tbl_transaksi','tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi');
    //         // $this->db->where('tbl_detail_transaksi.id_transaksi',$id);
    //         // $data_trx = $this->db->get('tbl_detail_transaksi')->row();
    //         $keterangan = "Barang Retur Uang";
    //         $inputData['id_transaksi'] = $id;
    //         $inputData['modal_masuk'] = $data_trx->total_modal;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "RUSAK_NO_RETUR") { //(akun,id_transaksi)
    //         // $this->db->select("sum(harga_beli*jumlah) as total_modal, sum((harga_jual-harga_beli)*jumlah) as total_keuntungan");
    //         // $this->db->join('tbl_transaksi','tbl_transaksi.id_transaksi=tbl_detail_transaksi.id_transaksi');
    //         // $this->db->where('tbl_detail_transaksi.id_transaksi',$id);
    //         $data_trx = $this->db->get('tbl_detail_transaksi')->row();
    //         $keterangan = "Barang Rusak/cacat";
    //         $inputData['id_transaksi'] = $id;
    //         $inputData['keuntungan_keluar'] = $data_trx->total_modal;
    //         $inputData['modal_masuk'] = $data_trx->total_modal;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "BONGKAR_BARANG") { //(akun,id,upah_bongkar)
    //         $keterangan = "Fee Bongkar " . $id;
    //         $inputData['id_masuk'] = $id;
    //         $inputData['keuntungan_keluar'] = $value1;
    //         $inputData['keterangan'] = $keterangan;
    //     } else if ($akun == "ANGKUT_BARANG") { //(akun,id,upah_angkut)
    //         $keterangan = "Fee Angkut " . $id;
    //         $inputData['id_transaksi'] = $id;
    //         $inputData['keuntungan_keluar'] = $value1;
    //         $inputData['keterangan'] = $keterangan;
    //     } else {
    //         return;
    //     }
    //     //return $this->db->insert('tbl_keuangan',$inputData);
    // }

    public function sendPush($to, $title, $body, $icon = '', $url = '')
    {
        $notification = [
            'title' => $title,
            'body' => $body,
            // 'icon' => "https://arthajaya.web.id/arj-sukra/assets/dist/img/icon.png",
            // 'click_action' => $url
        ];
        Http::acceptJson()->withToken(env("FCM_AUTH_KEY"))->post(
            'https://fcm.googleapis.com/fcm/send',
            [
                'to' => $to,
                'notification' => $notification,
            ]
        );
    }

    public function decrypt($encryptedText)
    {
        $key = env("AES_KEY"); // Harus sama dengan yang digunakan di JavaScript
        $iv = env("AES_IV");  // Harus sama dengan yang digunakan di JavaScript
        $cipher = "AES-256-CBC";  // Harus sesuai dengan yang digunakan di JavaScript
        $options = 0;
        //$encryptedText = base64_decode($encryptedText); // Karena CryptoJS output dalam base64
    
        $decryptedText = openssl_decrypt($encryptedText, $cipher, $key, $options, $iv);
        return $decryptedText;
    }

}
