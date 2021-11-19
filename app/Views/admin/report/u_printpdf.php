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
                <th rowspan="2" id="boldB">Barangay</th>
                <th colspan="7" align="center" id="boldD">Date</th>

                <th rowspan="2" id="boldT">Total</th>
            </tr>
            <tr>


                <?php
                $start = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
                $finish = (date('D') != 'Sun') ? date('Y-m-d', strtotime('next Sunday')) : date('Y-m-d');
                $format =  strtotime($start);
                $formatF = strtotime($finish);
                for ($i = $format; $i <= $formatF; $i = $i + 86400) {
                    $thisDate = date('Y-m-d', $i); // 2010-05-01, 2010-05-02, etc
                    $days =  date("d", strtotime($thisDate));
                ?>
                    <td><?php echo $days; ?></td>
                <?php
                }
                ?>


                <?php
                $counter_1 = 0;
                $counter_2 = 0;
                $counter_3 = 0;
                $counter_4 = 0;
                $counter_5 = 0;
                $counter_6 = 0;
                $counter_7 = 0;
                $sumTotal = 0;
                $total = 0;
                ?>

            </tr>
            <?php
            foreach ($report as $key => $value) { ?>
                <tr>

                    <td><?= $value['brgy_name']; ?></td>

                    <td><?= $value['monday'];
                        $counter_1 = $counter_1 + $value['monday']; ?></td>
                    <td><?= $value['tuesday'];
                        $counter_2 = $counter_2 + $value['tuesday']; ?></td>

                    <td><?= $value['wednesday'];
                        $counter_3 = $counter_3 + $value['wednesday']; ?></td>

                    <td><?= $value['thursday'];
                        $counter_4 = $counter_4 + $value['thursday']; ?></td>

                    <td><?= $value['friday'];
                        $counter_5 = $counter_5 + $value['friday']; ?></td>

                    <td><?= $value['saturday'];
                        $counter_6 = $counter_6 + $value['saturday']; ?></td>
                    <td><?= $value['sunday'];
                        $counter_7 = $counter_7 + $value['sunday']; ?></td>

                    <td><?php
                        $total = $value['sunday'] + $value['monday'] + $value['tuesday'] + $value['wednesday'] + $value['thursday'] + $value['friday'] + $value['saturday'];
                        $sumTotal = $sumTotal + $total;
                        echo $total;
                        ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th></th>
                <th><?php echo $counter_1; ?></th>
                <th><?php echo $counter_2; ?></th>
                <th><?php echo $counter_3; ?></th>
                <th><?php echo $counter_4; ?></th>
                <th><?php echo $counter_5; ?></th>
                <th><?php echo $counter_6; ?></th>
                <th><?php echo $counter_7; ?></th>

                <th><?php echo $sumTotal; ?></th>
            </tr>
        </table>
    </div>
</body>



</html>