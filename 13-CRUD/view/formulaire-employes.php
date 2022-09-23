<?php
 echo '<pre>';
 print_r($fields);
 echo '</pre>';

 echo '<pre>';
 print_r($values);
 echo '</pre>';
?>

<form method="POST" action="">
			<?php foreach($fields as $field):  ?>
            <label for="name"><?= $field['Field'] ?>:</label><br/>
            <input type="text" name="<?= $field['Field'] ?>" value="<?= (($op == 'update') && (!empty($values))) ? $values[$field['Field']] : ''; ?>">
            <br>			
			<?php endforeach; ?>
            <!-- <input type="hidden" name="form-submitted" value="1" /> -->
            <input type="submit">
        </form>