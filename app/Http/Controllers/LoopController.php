<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoopController extends Controller
{
    public  function  index() {
        return view('loop/index',[]);
    }

    public function proses(Request $request) {
        $jumlah = $request->jumlah_perulangan;
        $start = 1;
        $count = 0;

        for($i = $start; $i <= $jumlah; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $count = $count + 1;
                $hasil[] = "Angka " . $i . " adalah Marlin Booking";
                if ($count == 5) {
                    $hasil[] = "Aplikasi dihentikan";
                    break;
                }
            }
            else if ($i % 3 == 0 ) {
                $hasil[] = "Angka ".$i. " adalah Marlin";
            } else if ($i % 5 == 0) {
                $hasil[] = "Angka " . $i . " adalah Booking";
            }
        }

        $data = [
            'hasil'     => $hasil,
            'jumlah'    => $jumlah
        ];

        return view('loop/proses', $data);
    }
}
