<html>

<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Apriori Algorithm</h3>
        </div>
        <div class="container-fluid">
            <div class="card-body">



            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">


                <h2>Transaksi</h2>
                <table class="table" bordered="2">
                    <tr rowspan="2">
                        <td>Item Set</td>
                    </tr>
                    <?php $no = 1;
                    // $user = $this->db->query("SELECT * FROM user where fk_role = '2'");
                    foreach ($transaksi as $transs) : ?>
                        <tr style="text-align: center;">
                            <td><?= $no; ?></td>
                            <td><?= $transs['nama_produk'] ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">


                <?php
                // $con->close();

                $item1 = count($item) - 1;
                $item2 = count($item);
                $item3 = count($item);
                echo "<pre>";
                echo "\r\n<h3>Step 1: Combine 1 Item</h3>\r\n";
                echo "<table class=table border=\2\>";
                echo " <tr> <td>Name of goods</td><td> Support Count</td><td>Support</td></tr>";
                foreach ($transaksi as $value) {
                    $total_per_item[$value] = 0;
                    $support[$value] = 0;
                    foreach ($purchase as $item_purchase) {
                        if (strpos($item_purchase, $value) !== false) {
                            $total_per_item[$value]++;
                            $support[$value]++;
                        }
                    }
                    $spr[$value] = round($support[$value] / $z * 100, 2);
                    echo " <tr> <td>$value </td><td> " . $total_per_item[$value] . "</td><td> " . $spr[$value] . "%</td></tr>";
                }
                echo "</table>";
                ?>

            </div>
        </div>


        <div class="container-fluid">
            <div class="card-body">
                <?php

                echo "<pre>";
                echo "\r\n<h3>Step 2: Combine 2 Item</h3>\r\n";
                echo "<table class=table border=\2\>";
                echo "<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";

                for ($i = 0; $i < $item1; $i++) {
                    for ($j = $i + 1; $j < $item2; $j++) {
                        $item_pair = $item[$i] . '|' . $item[$j];
                        $item_array[$item_pair] = 0;
                        $sprt[$item_pair] = 0;
                        foreach ($purchase as $item_purchase) {
                            if ((strpos($item_purchase, $item[$i]) !== false) && (strpos($item_purchase, $item[$j]) !== false)) {
                                $item_array[$item_pair]++;
                                $sprt[$item_pair]++;
                            }
                            $spr[$item_pair] = round($sprt[$item_pair] / $z * 100, 2);
                        }
                        if ($item_array[$item_pair] > 0) {
                            echo " <tr> <td>$item_pair </td><td> " . $item_array[$item_pair] . "</td><td> " . $spr[$item_pair] . "%</td></tr>";
                        }
                    }
                }
                echo "</table>";
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">

                <?php

                echo "<pre>";
                echo "\r\n<h3>Step 3: Amount Combine 3 Item</h3>\r\n";
                echo "<table class=table border=\2\>";
                echo "<tr> <td>Item Set</td><td> Support Count</td><td>Support</td></tr>";
                for ($i = 0; $i < $item1; $i++) {
                    for ($j = $i + 1; $j < $item2; $j++) {
                        for ($k = $j + 1; $k < $item3; $k++) {
                            $item_pair33 = $item[$i] . '|' . $item[$j] . '|' . $item[$k];
                            $item_array33[$item_pair33] = 0;
                            $sprt33[$item_pair33] = 0;

                            foreach ($purchase as $item_purchase33) {
                                if ((strpos($item_purchase33, $item[$i]) !== false) && (strpos($item_purchase33, $item[$j]) !== false) && (strpos($item_purchase33, $item[$k]) !== false)) {
                                    $item_array33[$item_pair33]++;
                                    $sprt33[$item_pair33]++;
                                }

                                $spr33[$item_pair33] = round($sprt33[$item_pair33] / $z * 100, 2);
                            }

                            if ($item_array33[$item_pair33] > 0) {
                                echo " <tr> <td>$item_pair33 </td><td> " . $item_array33[$item_pair33] . "</td><td> " . $spr33[$item_pair33] . "%</td></tr>";
                            }
                        }
                    }
                }
                echo "</table>";
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">

                <?php
                echo "<pre>";
                echo "\r\n<h1 style=text-align:center>Step 4: Association Rule 2 Item</h1>\r\n";

                echo "<br>Results for Confidence > 50%";
                echo "<table class=table border=\2\>";
                echo "<tr><td>Item Set</td><td>Confidence</td><td>Lift Ratio</td></tr>";

                foreach ($item_array as $ia_key => $ia_value) {

                    $theitems = explode('|', $ia_key);

                    for ($x = 0; $x < count($theitems); $x++) {
                        $item_name = $theitems[$x];
                        $item_total = $total_per_item[$item_name];

                        if ($item_total > 0 && $ia_value > 0) {
                            $in_float = $ia_value / $item_total;
                            $in_percent = round($in_float * 100, 2);
                            $alt_item = $theitems[($x + 1) % count($theitems)];
                            $benc_marc = round(($total_per_item[$theitems[0]] + $total_per_item[$theitems[1]]) / $z * 100, 2);
                            $lift_ratio = round($in_percent / $spr[$theitems[0]], 2);
                            if ($lift_ratio < 5 && $in_percent > 50 && $in_percent != 100) {
                                echo "<tr><td>$ia_key($ia_value) --> $item_name($item_total)</td> <td> " . $in_percent . "%</td> <td>" . $lift_ratio . "</td></tr>";
                            }
                        }
                    }
                }
                echo "</table>";
                echo "</pre>";
                ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card-body">
                <?php
                echo "<pre>";
                echo "\r\n<h1 style=text-align:center>Step 5: Association Rule 3 Item</h1>\r\n";

                echo "<br>Results for Confidence > 50%";
                echo "<table class=table border=\2\>";
                echo "<tr><td>Item Set</td><td>Confidence</td><td>Lift Ratio</td></tr>";
                foreach ($item_array33 as $ia_key33 => $ia_value33) {
                    $theitems33 = explode('|', $ia_key33);
                    for ($x = 0; $x < count($theitems33); $x++) {
                        $item_name33 = $theitems33[$x];
                        $item_total33 = $total_per_item[$item_name33];

                        if ($item_total33 > 0 && $ia_value33 > 0) {
                            $in_float33 = $ia_value33 / $item_total33;
                            $in_percent33 = round($in_float33 * 100, 2);
                            $alt_item33 = $theitems33[($x + 1) % count($theitems33)];
                            $benc_marc33 = round(($total_per_item[$theitems33[0]] + $total_per_item[$theitems33[1]] + $total_per_item[$theitems33[2]]) / $z * 100, 2);

                            $lift_ratio33 = round($in_percent33 / $spr[$theitems33[0]], 2);
                            if ($lift_ratio33 < 5 && $in_percent33 > 50 && $in_percent33 != 100) {
                                echo "<tr><td>$ia_key33($ia_value33) --> $item_name33($item_total33)</td> <td> " . $in_percent33 . "%</td> <td>" . $lift_ratio33 . "</td></tr>";
                            }
                        }
                    }
                }
                echo "</table>";
                echo "</pre>";
                ?>


            </div>
        </div>


    </div>
</body>

</html>
Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
You have no unread notifications