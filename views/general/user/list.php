	<table class="tablesorter" cellspacing="0"> 
	
		<thead> 
			<tr> 
   				<th class="header"><input type="checkbox" /></th> 
    			<th class="header">Username</th> 
				<th class="header"><?php echo __('Name'); ?></th> 
				<th class="header">Email</th> 
				<th class="header"><?php echo __('Actions'); ?></th> 
			</tr> 
		</thead> 
		
		<tbody> 
			<?php foreach($users as $usr): ?>
			<tr> 
				<td><input type="checkbox" name="id" value="<?php echo $usr->id; ?>"></td> 
				<td><?php echo html::anchor('user/update/'.$usr->id, $usr->username); ?></td> 
				<td><?php echo $usr->name; ?></td> 
				<td><?php echo $usr->email; ?></td> 
				<td><?php echo html::anchor('user/update/'.$usr->id, html::image('images/icn_edit.png', array('border' => 0, 'title' => 'Edit'))); echo ' &nbsp; '; echo html::anchor('user/delete/'.$usr->id, html::image('images/icn_trash.png', array('border' => 0, 'title' => 'Trash'))) ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
	
	<footer>
		<div class="submit_link_left">
			<input type="submit" id="delete_btn" value="Delete selected users" />
			<input type="submit" id="add_new_btn" value="Add new user" rel="<?php echo url::site('user/create'); ?>" />
		</div>
		
		<div class="submit_link">
			<?php echo $pagination->render(); ?>
		</div>
	</footer>
