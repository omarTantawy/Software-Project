
<script>
    function myFunction() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        var ok = true;
        if (pass1 != pass2) {
            //alert("Passwords Do not match");
            document.getElementById("pass1").style.borderColor = "#E34234";
            document.getElementById("pass2").style.borderColor = "#E34234";
            ok = false;
        }
        else {
            alert("Passwords Match!!!");
        }
        return ok;
    }
</script>
<div class="container">
    <div class="row">
        <div class="login" align="center">

            <form method="post" action="" onsubmit="return myFunction()">

                Name: <input type="text" value="<?php echo $record['name'] ?>" class="form-control" name="name"
                             required>
                <br>
                Mobile: <input type="tel" value="<?php echo $record['mobile'] ?>" class="form-control" name="mobile"
                               required>
                <br>
                Username:<input type="text" value="<?php echo $record['userName'] ?>" class="form-control"
                                name="userName" required>
                <br>
                Password: <input type="password" value="<?php echo $record['password'] ?>" class="form-control"
                                 name="password" id="pass1" required >
                <br>
               Retype Password: <input type="password" value="<?php echo $record['password'] ?>" class="form-control"
                                 id="pass2"required >
                <br>
                <?php if ($_SESSION['user'] != "secretary") { ?>
                    Address :<input type="text" value="<?php echo $record['address'] ?>" class="form-control"
                                   name="address" required>
                    <br>
                <?php } ?>

                <button type="submit" class="btn btn-info">Done</button>
            </form>

        </div>
    </div>
</div>