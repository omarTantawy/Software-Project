<div class="container">
    <div class="row">


        <h1 align="center"><?php echo $reservationDate ?></h1>

        <div class="col-lg-12">

            <table class="table table-bordered">
                <tr class="text-center bg-primary">
                    <td> Reservation Time</td>
                    <td> Status</td>
                    <td> Reserve</td>

                </tr>


                <?php for ($i = 6;
                $i < 12;
                $i++) { ?>
                <tr>
                    <td>  <?php echo "" . $i . " pm" ?> </td>

                    <td>
                        <?php
                        $found = false;
                        foreach ($reserved as $res) {
                            if ($i == $res['reservationTime']) {
                                $found = true;
                                break;
                            }
                        }

                        if ($found == false) {
                            echo "Free";
                        } else {
                            echo "reserved";
                        }
                        ?>

                    </td>
                    <td>
                        <?php if ($found == false) { ?>
                        <div align="center">
                            <button type="submit" class="btn-success">reserve</button>
                    </td>
        </div>
        <?php } ?>
        </tr>
        <?php
        } ?>


        </table>


    </div>
</div>
</div>
