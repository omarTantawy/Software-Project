<div class="container">
    <div class="row">

        <?php if ($total) { ?>

            <form method="post" action="">

                <input type="text" class="form-control" name="prescription"  value="<?php echo $reservation['prescription'] ?>" >
                <br>

                <button type="submit" class="btn btn-info">Edit prescription</button>
            </form>
        <?php } ?>

    </div>
</div>
