<?php

namespace App\Helpers;



class ResponseCodeHelper {

    public static function response($code,$responseData='')
    {
        $codeStatus = [
            '00'=> ['Successfully',200],
            '01'=> ['Invalid Field',401],
            '02'=> ['Invalid Username or Password',401],
            '03'=> ['Input Jumlah Produk Melebihi Persediaan',401],
            '04'=> ['Jumlah tidak boleh kurang dari 0',401],
            '05'=> ['Pembayaran kurang dari total belanja',401],
            '06'=> ['ID Not Found',404],
            '07'=> ['Product Not Found',404],
            '08'=> ['Data Not Found',404],
            '09'=> ['Access Denied',403],
            '10'=> ['Expired token',403],
            '11'=> ['Tidak Dapat di Update',401],
            '12'=> ['Jumlah Melebihi Persediaan',401],
            '13'=> ['ID Sudah Melebihi batas Pengembalian',403],
            '14'=> ['Invalid QR',401],
            '15'=> ['Expaired QR',401],
            '16'=> ['Tidak dapat dihapus, promo diskon sudah digunakan',401],
            '17'=> ['PIN Salah',401],
            '404'=>['Page Not Found',404],
            '500'=>['Not Found',500],
            
        ];

        $res =  [
            "code"=>$code,
            "message"=>$codeStatus[$code][0]
        ];
    
        if(!empty($responseData)){
            $res["response"]=$responseData;
        } 
        //return $res;       
        return response($res,$codeStatus[$code][1]);
    }
   
}