<h2>Flatten data</h2>
<table border>
    <tr>
    	<th>ID</th>
    	<th>parent ID</th>
    	<th>property</th>
    	<th>value</th>
    	<th>type</th>
    </tr>
    <?php foreach ($flatList as $aRow):?>
    <tr><td><?php echo $aRow["id"]?></td>
    	<td><?php echo $aRow["parentId"]?></td>
    	<td><?php echo $aRow["property"]?></td>
    	<td><?php echo $aRow["value"]?></td>
    	<td><?php echo $aRow["type"]?></td>
    </tr>
    <?php endforeach;?>
</table>
<h2>Flatten json</h2>
<?php echo $flattenJson?>
<h2>Infalte (recovered) data</h2>

<?php echo($inflateResult); ?>
