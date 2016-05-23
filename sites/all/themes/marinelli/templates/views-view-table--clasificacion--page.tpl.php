<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
?>
<?php 
	
			$array = array();
			$equipos = array();
			for ($i=0;$i<20;$i++){
				$array[$i][0] = $rows[$i]['title'];
				$array[$i][1] = $i;
				for ($j=2;$j<23;$j++){
					$array[$i][$j] = 0;
				}
				array_push($equipos, explode('">',$array[$i][0])[1]);
			}

			for ($i=20;$i<count($rows);$i++){
				$key = explode('">', $rows[$i]['field_equipolocal']);
				$pos = array_search($key[1], $equipos);
				$array[$pos][2] = $array[$pos][2] + 1;
				$array[$pos][16] = $array[$pos][16] + 1;
				$array[$pos][6] = $array[$pos][6] + val($rows[$i]['field_goleslocal']);
				$array[$pos][7] = $array[$pos][7] + val($rows[$i]['field_golesvisitante']);
				$array[$pos][20] = $array[$pos][20] + val($rows[$i]['field_goleslocal']);
				$array[$pos][21] = $array[$pos][21] + val($rows[$i]['field_golesvisitante']);
				if (val($rows[$i]['field_goleslocal'])>val($rows[$i]['field_golesvisitante'])){
					$array[$pos][3] = $array[$pos][3] + 1;
					$array[$pos][17] = $array[$pos][17] + 1;
					$array[$pos][8] = $array[$pos][8] + 3;
					$array[$pos][22] = $array[$pos][22] + 3;
				}else{
					if (val($rows[$i]['field_goleslocal'])==val($rows[$i]['field_golesvisitante'])){
						$array[$pos][4] = $array[$pos][4] + 1;
						$array[$pos][18] = $array[$pos][18] + 1;
						$array[$pos][8] = $array[$pos][8] + 1;
						$array[$pos][22] = $array[$pos][22] + 1;
					}else{
						$array[$pos][5] = $array[$pos][5] + 1;
						$array[$pos][19] = $array[$pos][19] + 1;
					}
				}
				$key = explode('">', $rows[$i]['field_equipovisitante']);
				$pos = array_search($key[1], $equipos);
				$array[$pos][9] = $array[$pos][9] + 1;
				$array[$pos][16] = $array[$pos][16] + 1;
				$array[$pos][13] = $array[$pos][13] + val($rows[$i]['field_golesvisitante']);
				$array[$pos][20] = $array[$pos][20] + val($rows[$i]['field_golesvisitante']);
				$array[$pos][14] = $array[$pos][14] + val($rows[$i]['field_goleslocal']);
				$array[$pos][21] = $array[$pos][21] + val($rows[$i]['field_goleslocal']);
				if (val($rows[$i]['field_golesvisitante'])>val($rows[$i]['field_goleslocal'])){
					$array[$pos][10] = $array[$pos][10] + 1;
					$array[$pos][17] = $array[$pos][17] + 1;
					$array[$pos][15] = $array[$pos][15] + 3;
					$array[$pos][22] = $array[$pos][22] + 3;
				}else{
					if (val($rows[$i]['field_golesvisitante'])==val($rows[$i]['field_goleslocal'])){
						$array[$pos][11] = $array[$pos][11] + 1;
						$array[$pos][18] = $array[$pos][18] + 1;
						$array[$pos][15] = $array[$pos][15] + 1;
						$array[$pos][22] = $array[$pos][22] + 1;
					}else{
						$array[$pos][12] = $array[$pos][12] + 1;
						$array[$pos][19] = $array[$pos][19] + 1;
					}
				}
				
			}
			
			foreach ($array as $key => $row) {
				$puntos[$key]  = $row[22];
				$goles[$key] = $row[20];
			}

			// Sort the data with volume descending, edition ascending
								
			array_multisort($puntos, SORT_DESC, $goles, SORT_DESC, $array);

				
		?>
<table <?php if ($classes) { print 'class="'. $classes . '" '; } ?><?php print $attributes; ?>>
   <?php if (!empty($title) || !empty($caption)) : ?>
     <caption><?php print $caption . $title; ?></caption>
  <?php endif; ?>
  <?php if (!empty($header)) : ?>
    <thead>
	  <tr>
		<th></th>
		<th colspan="7">En casa</th>
		<th colspan="7">Fuera</th>
		<th colspan="7">Total</th>
	  </tr>
      <tr>
         <th>Equipo</th>
		 <th>PJ</th>
		 <th>G</th>
		 <th>E</th>
		 <th>P</th>
		 <th>GF</th>
		 <th>GC</th>
		 <th>Pt</th>
		 <th>PJ</th>
		 <th>G</th>
		 <th>E</th>
		 <th>P</th>
		 <th>GF</th>
		 <th>GC</th>
		 <th>Pt</th>
		 <th>PJ</th>
		 <th>G</th>
		 <th>E</th>
		 <th>P</th>
		 <th>GF</th>
		 <th>GC</th>
		 <th>Pt</th>
        
      </tr>
    </thead>
  <?php endif; ?>
  <tbody>
    <?php 
		for ($i=0;$i<20;$i++){ ?>
			<tr <?php if ($row_classes[$i]) {print 'class="' .implode(' ', $row_classes[$i]) .'"'; } ?>>
			<th <?php if ($field_classes['title'][$i]) { print 'class="'. $field_classes['title'][$i] . '" '; } ?><?php print drupal_attributes($field_attributes['title'][$i]); ?>>
				<strong><?php print ($i + 1) ?></strong>
				<?php print $array[$i][0]; ?>
				<?php print $rows[$array[$i][1]]['field_image']; ?>
			</th>
			<td><?php print $array[$i][2] ?></td>
			<td><?php print $array[$i][3] ?></td>
			<td><?php print $array[$i][4] ?></td>
			<td><?php print $array[$i][5] ?></td>
			<td><?php print $array[$i][6] ?></td>
			<td><?php print $array[$i][7] ?></td>
			<th><?php print $array[$i][8] ?></th>
			<td><?php print $array[$i][9] ?></td>
			<td><?php print $array[$i][10] ?></td>
			<td><?php print $array[$i][11] ?></td>
			<td><?php print $array[$i][12] ?></td>
			<td><?php print $array[$i][13] ?></td>
			<td><?php print $array[$i][14] ?></td>
			<th><?php print $array[$i][15] ?></th>
			<td><?php print $array[$i][16] ?></td>
			<td><?php print $array[$i][17] ?></td>
			<td><?php print $array[$i][18] ?></td>
			<td><?php print $array[$i][19] ?></td>
			<td><?php print $array[$i][20] ?></td>
			<td><?php print $array[$i][21] ?></td>
			<th><?php print $array[$i][22] ?></th>
			</tr>
		<?php } ?>
  </tbody>
</table>
<style>
th:nth-child(1) {
	width: 255px;
}

a{
	color: black;
}

th,td{
	padding: 4px 3px 4px 4px;
	height: 25px;
	font-size: 11px;
	text-align: center;
	vertical-align: middle;
}

thead, tr {
	border: 1px solid grey;
}

th {
	width: 23px;
	border: 1px solid grey;
}

th strong:nth-child(1) {
	float: left;
	padding: 4px 1px 0 1px;
	vertical-align: middle;
}

tbody th a {
	vertical-align: sub;
	text-decoration: none;
	color: black;
	-webkit-transition: all 0.4s ease-in-out;
	   -moz-transition: all 0.4s ease-in-out;
	    -ms-transition: all 0.4s ease-in-out;
	     -o-transition: all 0.4s ease-in-out;
}

tbody th img {
	float: right;
}

tbody th a:hover {
	text-decoration: underline;
}

tbody tr:nth-child(-n + 7 ) th:nth-child(1) {
	background-color: #669E00;
}

tbody tr:nth-child(-n+4) th:nth-child(1) {
	background-color: #0C8197;
}

tbody tr:nth-last-child(-n+3) th:nth-child(1) {
	background-color: #AA0C00;
}

thead tr:nth-last-child(-n + 1) {
	background-color: #CFCFCF;
}


tbody tr th:nth-last-child(-n + 1) {
	background-color: #CFCFCF;
}
</style>