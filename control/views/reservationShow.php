<div class="container">
    <div class="row">

        <?php if ($total) { ?>
        <div class="col-lg-12">

            <table class="table table-bordered">
                <tr class="text-center bg-primary">
                    <td> Reservation Date</td>
                    <td> Reservation Time</td>
                    <td> Prescription</td>
                    <td> Reservation made by:</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>


                <?php foreach ($reservations as $reservation) { ?>
                <tr>

                    <td><?php echo $reservation['reservationDate'] ?></td>
                    <td><?php echo $reservation['reservationTime'] ?></td>


                    <td><?php if ($reservation['prescription'] == "")
                        echo "Prescription hasn't been added yet";
                        else {
                            echo $reservation['prescription'];
                        }
                        ?>

                    </td>

                    <td><?php if ($reservation['dependentId'] == NULL)
                            echo "YOU";
                        else echo "Dependent : " . $reservation['name'];
                        ?></td>

                    <td>
                        <?php if ($reservation['dependentId'] != NULL){ ?>
                        <a href="index.php?p=reservationEdit&i=<?php echo $reservation['reservationId'] ?>"><span
                                class="glyphicon air-icon-edit"></span></a></td>
                    <?php } ?>
                    <td>
                        <a href="index.php?p=reservationDelete&i=<?php echo $reservation['reservationId'] ?>&returnTo=<?php echo $returnTo ?>">
                            <span class="glyphicon air-icon-close"></span></a></td>
                </tr>

            <?php } ?>


            </table>
        </div>


    <?php } else { ?>


    <?php } ?>

    </div>
</div>
