<?php

namespace helpers;

defined('BASEPATH') or exit('No direct script access allowed');
class apriori
{
    function main($data_item)
    {
        $minSupport = 11;
        $minConvident = 10;
        $arr = [];
        for ($i = 0; $i < count($data_item); $i++) {
            $ar = [];
            $val = explode(",", $data_item[$i]["item"]);
            for ($j = 0; $j < count($val); $j++) {
                $ar[] = $val[$j];
            }
            array_push($arr, $ar);
        }
        $frekuensi_item = $this->frekuensiItem($arr);
        $dataEliminasi = $this->eliminasiItem($frekuensi_item, $minSupport);

        // print_r($dataEliminasi);

        do {
            $pasangan_item = $this->pasanganItem($dataEliminasi);
            $frekuensi_item = $this->FrekuensiPasanganItem($pasangan_item, $arr);
            $dataEliminasi = $this->eliminasiItem($frekuensi_item, $minSupport);
            foreach ($frekuensi_item as $key => $val) {

                $ex = explode("_", $key);
                $item = "";
                $vl = "";
                for ($k = 0; $k < count($ex); $k++) {
                    if ($k !== count($ex) - 1) {
                        $item .= "," . $ex[$k];
                    } else {
                        $vl = $ex[$k];
                    }
                }
                $aturan_asosiasi[] = array("item" => substr($item, 1), "val" => $vl, "sc" => $val);
            }
        } while ($dataEliminasi == $frekuensi_item);

        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
            $x = 0;
            $ex = explode(",", $aturan_asosiasi[$i]["item"]);
            for ($l = 0; $l < count($arr); $l++) {
                $jum = 0;
                for ($k = 0; $k < count($ex); $k++) {
                    for ($j = 0; $j < count($arr[$l]); $j++) {
                        if ($arr[$l][$j] == $ex[$k]) {
                            $jum += 1;
                        }
                    }
                }
                if (count($ex) == $jum) {
                    $x += 1;
                }
            }
            $convident = (floatval($aturan_asosiasi[$i]["sc"]) / floatval($x)) * 100;
            $aturan_asosiasi[$i]["c"] = number_format($convident, 2, ".", ",");
            // return $aturan_asosiasi;
            // var_dump($aturan_asosiasi);
            // die;
        }
        for ($i = 0; $i < count($aturan_asosiasi); $i++) {
            if ($aturan_asosiasi[$i]["c"] < $minConvident) {
                array_splice($aturan_asosiasi, $i--, 1);
            }
            // return $aturan_asosiasi;
        }
        return $aturan_asosiasi;
    }
    
    function frekuensiItem($data)
    {
        $arr = [];
        for ($i = 0; $i < count($data); $i++) {
            $jum = array_count_values($data[$i]);
            foreach ($jum as $key => $v) {
                if (array_key_exists($key, $arr)) {
                    $arr[$key] += 1;
                } else {
                    $arr[$key] = 1;
                }
            }
        }
        return $arr;
    }

    function eliminasiItem($data, $minSupport)
    {
        $arr = [];
        foreach ($data as $key => $v) {
            if ($v >= $minSupport) {
                $arr[$key] = $v;
            }
        }
        return $arr;
    }
    
    function pasanganItem($data_filter)
    {
        $n = 0;
        $arr = [];
        foreach ($data_filter as $key1 => $v1) {
            $m = 1;
            foreach ($data_filter as $key2 => $v2) {
                $str = explode("_", $key2);
                for ($i = 0; $i < count($str); $i++) {
                    if (!strstr($key1, $str[$i])) {
                        if ($m > $n + 1 && count($data_filter) > $n + 1) {
                            $arr[$key1 . "_" . $str[$i]] = 0;
                        }
                    }
                }
                $m++;
            }
            $n++;
        }
        return $arr;
    }

    function frekuensiPasanganItem($data_pasangan, $data)
    {
        $arr = $data_pasangan;
        $ky = "";
        $kali = 0;
        foreach ($data_pasangan as $key1 => $k) {
            for ($i = 0; $i < count($data); $i++) {
                $kk = explode("_", $key1);
                $jm = 0;
                for ($k = 0; $k < count($kk); $k++) {
                    for ($j = 0; $j < count($data[$i]); $j++) {
                        if ($data[$i][$j] == $kk[$k]) {
                            $jm += 1;
                            break;
                        }
                    }
                }
                if ($jm > count($kk) - 1) {
                    $arr[$key1] += 1;
                }
            }
        }
        return $arr;
    }
}
