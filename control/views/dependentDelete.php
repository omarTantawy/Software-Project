<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    function showEdit(editableObj, dependentId) {
        if (confirm('Are you sure you want remove this dependent from website')) {
            $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "dependentDelete.php",
                type: "POST",
                data: 'dependentId=' + dependentId,

                    success: function (data) {
                    $(editableObj).css("background", "#FDFDFD");
                    alert(data);


                }

            });

            var dependent = document.getElementById(dependentId);
            dependent.style.display = "none";

        } else {
            alert(data);
        }
    }

</script>

<h1>Dependents</h1>

<div class="container">
    <div class="row">
        <div class="cleaner-h2"></div>
        <div class="col-lg-12">

            <?php if ($dependents) {
                ?>
                <table class="table table-bordered">
                    <tr class="text-center bg-primary">
                        <td> Patient</td>
                        <td>Delete</td>

                    </tr>

                    <?php foreach ($dependents as $dependent) { ?>
                        <tr class="bg-primary2" id="<?php echo $patients['secretaryId']?>">
                            <td>
                            name: <?php echo ($dependent['name'])  ?> <br>
                            patientName : <?php echo (  $_SESSION[$dependent['patientId']])?> <br>
                            mobile: <?php echo($dependent['mobile']) ?><br>
                             username : <?php echo $dependent['userName'] ?><br>

                            </td>
                             <td align="center">
                               <a href="index.php?p=dependentDelete&i=<?php echo$dependent['dependentId'] ?>&returnTo=<?php echo $returnTo ?>">
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