<div class="container">
    <div class="row">


        <form method="post" action="">


            <?php echo $reservationDate ?>


            <select name="reservationTime" required>

                <?php for ($i = 6;
                           $i < 12;
                           $i++) {
                    $found = false;
                    foreach ($reserved as $res) {
                        if ($i == $res['reservationTime']) {
                            $found = true;
                        }
                    }

                    if ($found == false) {
                        ?>
                        <option value="<?php echo $i ?>"><?php echo "" . $i . " pm" ?></option>
                        <?php
                    }

                } ?>
            </select>

            <button type="submit" class="btn btn-info">reserve</button>

        </form>
    </div>
</div>
</div>
