<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    function showEdit(editableObj, category_name) {
        if (confirm('Are you sure you want remove this service from Categories')) {
            $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "DeleteCategory.php",
                type: "POST",
                data: 'category_name=' + category_name,
                success: function (data) {
                    $(editableObj).css("background", "#FDFDFD");
                }
            });
            var category = document.getElementById(category_name);
          //  var category1 = document.getElementById(category_name+"two");
            category.style.display = "none";
          //  category1.style.display = "none";
        } else {

        }
    }

</script>
<h1>Categories show</h1>

<div class="container">
    <div class="row">
        <div class="cleaner-h2"></div>
        <div class="col-lg-12">

            <?php if ($categories) {
                ?>
                <table class="table table-bordered">
                    <tr class="text-center bg-primary">
                        <td> Categories</td>
                        <td>Delete</td>

                    </tr>

                    <?php foreach ($categories as $category) { ?>
                        <tr class="bg-primary2" id="<?php echo $category['category_name']?>">
                            <td><?php echo($category['category_name']) ?><br>
                             Description : <?php echo $category['category_description'] ?><br>
                            </td>
                             <td align="center">
                                <a onClick="showEdit(this , '<?php echo $category['category_name'] ?>' );"
                                    class="btn default btn-xs black">
                                    <img src="img/cross-on-white.gif"/> </a>

                            </td>
                        </tr>

                        </tr>
                    <?php } ?>

                </table>
            <?php } ?>
        </div>
    </div>
</div>