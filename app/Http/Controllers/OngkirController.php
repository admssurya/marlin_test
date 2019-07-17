<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use rizalafani\rajaongkirlaravel\RajaOngkir;

class OngkirController extends Controller
{
    public  function index() {
        $provinsi = $this->getProvinsi();

        $data = [
            'provinsi'  => $provinsi
        ];

        return view('ongkir/index',$data);
    }

    public function getKota($id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: e7034417116925e41dde817f97e87292"
            ),
        ));

        $dataKota = json_decode(curl_exec($curl));
        $err = curl_error($curl);

        foreach ($dataKota->rajaongkir->results as $val) {
            if ($val->province_id == $id) {
                $hasil[] = $val;
            }
        }

        return $hasil;
    }

    function getProvinsi() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: e7034417116925e41dde817f97e87292"
            ),
        ));

        $response = json_decode(curl_exec($curl));
        $err = curl_error($curl);

        return $response->rajaongkir->results;
    }

    public function proses(Request $request) {
        $asal = '501';
        $id_kabupaten = $request->kota;
        $kurir = $request->kurir;
        $berat = $request->berat;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: e7034417116925e41dde817f97e87292"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {	  echo "cURL Error #:" . $err;
        } else {
//            echo $response;
        }

        $hasil = json_decode($response)->rajaongkir->results[0]->costs;

        $data = [
            'hasil' => $hasil
        ];

        return view('ongkir/proses',$data);
    }
}
