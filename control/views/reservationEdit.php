<div class="container">
    <div class="row">

        <?php if ($total) { ?>

            <form method="post" action="">

                <input type="date" class="form-control" name="reservationDate"  value="<?php echo $reservation['reservationDate'] ?>" >
                <br>
                <input type="time" class="form-control" name="reservationTime" value="<?php echo $reservation['reservationTime'] ?>" >
                <br>

                <button type="submit" class="btn btn-info">Edit Reservation</button>
            </form>
        <?php } ?>

    </div>
</div>
