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

               Patient name: <input type="text" class="form-control" name="name" required placeholder="Enter secretary name">
                <br>
                Age : <input type="number" size="2" class="form-control" name="age" required placeholder="Enter the age of patient" >
                <br>
               Email :  <input type="text" class="form-control" name="userName" required placeholder="Enter secretary email">
                <br>
              password:  <input type="password" id="pass1" class="form-control" name="password" required>
                <br>
                Retype Password: <input type="password" class="form-control"
                                        id="pass2" required >
                <br>
               mobile number: <input type="number" class="form-control" name="mobile" required>
                <br>
                <button type="submit" class="btn btn-info">Add account</button>
            </form>

        </div>
    </div>
</div>