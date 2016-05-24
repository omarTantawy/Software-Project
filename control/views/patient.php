<?php
foreach ($records as $record) {
    echo $record['name'];
    echo "<br>";
}
?>

<div ng-app="">
<ul ng-init="list = <?php echo htmlspecialchars(json_encode($records)); ?>">
    <li ng-repeat="item in list">
        {{item.name}}
    </li>

</ul>
</div>