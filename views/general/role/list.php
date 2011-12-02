<table class="tablesorter" cellspacing="0"> 
		<thead> 
			<tr> 
   				<th class="header"></th> 
    			<th class="header"><?php echo __('Role'); ?></th>
    			<th class="header"><?php echo __('Description'); ?></th>
				<th class="header"><?php echo __('Actions'); ?></th> 
			</tr> 
		</thead> 
		
		<tbody> 
			<?php foreach($roles as $role): ?>
			<tr> 
				<td><input type="checkbox"></td> 
				<td><?php echo html::anchor('role/update/'.$role->id, ucwords($role->name)); ?></td> 
				<td><?php echo $role->description; ?></td> 
				<td><?php echo html::anchor('role/update/'.$role->id, html::image('images/icn_edit.png', array('border' => 0, 'title' => 'Edit'))); echo ' &nbsp; '; echo html::anchor('role/delete/'.$role->id, html::image('images/icn_trash.png', array('border' => 0, 'title' => 'Trash'))) ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
	
	<footer>
		<div class="submit_link_left">
			<input type="submit" id="delete_btn" value="<?php echo __('Delete selected roles'); ?>" />
			<input type="submit" id="add_new_btn" value="<?php echo __('Add new role'); ?>" rel="<?php echo url::site('role/create'); ?>" />
		</div>
		
		<div class="submit_link">
			<?php echo $pagination->render(); ?>
		</div>
	</footer>