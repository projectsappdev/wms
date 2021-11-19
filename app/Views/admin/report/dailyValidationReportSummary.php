<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #888;
        text-align: center;

    }

    #boldB {
        font-weight: bold;
    }
</style>

<body>


    <div class="table-responsive">
        <table class="table-bordered table">
            <tr id="bold-font">
                <th>Date</th>
                <th>Number of Elf Trucks Entering RCA</th>
                <th>Volume</th>


            </tr>

            <?php
            $counter = 0;
            $counterE = 0;
            $divCounter = 0;
            $totaldivCounter = 0;
            foreach ($report as $key => $value) { ?>
                <tr>

                    <td><?= date("d", strtotime($value['date_c'])); ?></td>
                    <td><?php $divCounter = ($counterE + $value['sumVol']) / 2;
                        /*  $num = .2039302; // from input
                        $precision = 5;
                        $pnum = round($num, $precision);
                        $denominator = pow(10, $precision);
                        $numerator = $pnum * $denominator; */

                        // echo $numerator . "/" . $denominator;

                        echo $divCounter;
                        ?></td>
                    <?php $totaldivCounter = $totaldivCounter + $divCounter;  ?>
                    <td><?= $value['sumVol'];
                        $counter = $counter + $value['sumVol'];
                        ?></td>

                </tr>
            <?php
            }
            ?>
            <tr>
                <th>Total</th>
                <th><?php echo $totaldivCounter; ?></th>
                <th><?php echo $counter; ?></th>
            </tr>
        </table>
    </div>
</body>


</html>