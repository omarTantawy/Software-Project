<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    function showEdit(editableObj, patientId) {
        if (confirm('Are you sure you want remove this patient from website')) {
            $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "patientDelete.php",
                type: "POST",
                data: 'patientId=' + patientId,

                    success: function (data) {
                    $(editableObj).css("background", "#FDFDFD");
                    alert(data);


                }

            });

            var patient = document.getElementById(patientId);
            patient.style.display = "none";

        } else {
            alert(data);
        }
    }

</script>

<h1>Patients</h1>

<div class="container">
    <div class="row">
        <div class="cleaner-h2"></div>
        <div class="col-lg-12">

            <?php if ($patients) {
                ?>
                <table class="table table-bordered">
                    <tr class="text-center bg-primary">
                        <td> Patient</td>
                        <td>Delete</td>

                    </tr>

                    <?php foreach ($patients as $patient) { ?>
                        <tr class="bg-primary2" id="<?php echo $patients['secretaryId']?>">
                            <td>
                            name: <?php echo ($patient['name'])  ?> <br>
                            mobile: 0<?php echo($patient['mobile']) ?><br>
                             username : <?php echo $patient['userName'] ?><br>
                            </td>
                             <td align="center">
                               <a href="index.php?p=patientDelete&i=<?php echo$patient['patientId'] ?>&returnTo=<?php echo $returnTo ?>">
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