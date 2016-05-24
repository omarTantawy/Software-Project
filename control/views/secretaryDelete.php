<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    function showEdit(editableObj, secretaryId) {
        if (confirm('Are you sure you want remove this secretary from website')) {
            $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "SecretaryDelete.php",
                type: "POST",
                data: 'secretaryId=' + secretaryId,

                    success: function (data) {
                    $(editableObj).css("background", "#FDFDFD");
                    alert(data);


                }

            });

            var secretary = document.getElementById(secretaryId);
            secretary.style.display = "none";

        } else {
            alert(data);
        }
    }

</script>

<h1>Secretaries</h1>

<div class="container">
    <div class="row">
        <div class="cleaner-h2"></div>
        <div class="col-lg-12">

            <?php if ($secretaries) {
                ?>
                <table class="table table-bordered">
                    <tr class="text-center bg-primary">
                        <td> Secretary</td>
                        <td>Delete</td>

                    </tr>

                    <?php foreach ($secretaries as $secretary) { ?>
                        <tr class="bg-primary2" id="<?php echo $secretary['secretaryId']?>">
                            <td>
                            name: <?php echo ($secretary['name'])  ?> <br>
                            mobile: 0<?php echo($secretary['mobile']) ?><br>
                             username : <?php echo $secretary['userName'] ?><br>
                            </td>
                             <td align="center">
                               <a href="index.php?p=secretaryDelete&i=<?php echo $secretary['secretaryId'] ?>&returnTo=<?php echo $returnTo ?>">
                                    <span class="glyphicon air-icon-close"></span></a>


                            </td>
                        </tr>

                        </tr>
                    <?php } ?>

                </table>
            <?php } ?>
        </div>
    </div>
</div>