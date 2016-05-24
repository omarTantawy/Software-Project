<div class="container">
    <div class="row">

        <?php if ($total) { ?>
            <div class="col-lg-12">

                <table class="table table-bordered">
                    <tr class="text-center bg-primary">
                        <td> Patient Name</td>
                        <td> Patient Mobile</td>
                        <td> Reservation Date</td>
                        <td> Reservation Time</td>
                        <td> Prescription</td>
                        <td>Edit Prescription</td>
                    </tr>


                    <?php foreach ($reservations as $reservation) { ?>
                        <tr>

                            <td><?php echo $reservation['name'] ?></td>
                            <td><?php echo $reservation['mobile'] ?></td>
                            <td><?php echo $reservation['reservationDate'] ?></td>
                            <td><?php echo $reservation['reservationTime'] ?></td>
                            <td><?php echo $reservation['prescription'] ?></td>
                            <td>
                                <a href="index.php?p=presEdit&i=<?php echo $reservation['reservationId'] ?>"><span
                                        class="glyphicon air-icon-edit"></span></a></td>


                    <?php } ?>


                </table>
            </div>


        <?php } else { ?>


        <?php } ?>

    </div>
</div>
