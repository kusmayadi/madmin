<h1><?php echo __('Users'); ?></h1>

<table class="table table-bordered table-hover"> 
	
	<thead> 
		<tr> 
			<th class="header" width="1"><input type="checkbox" /></th> 
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
			<td width="140"><?php echo html::anchor('user/update/'.$usr->id, '<i class="icon-edit"></i> '.__('Edit'), array('class' => 'btn btn-mini')); echo ' &nbsp; '; echo html::anchor('user/delete/'.$usr->id, '<i class="icon-trash"></i> '.__('Remove'), array('class' => 'btn btn-mini')); ?></td> 
		</tr> 
		<?php endforeach; ?>
	</tbody> 
</table>

<button id="delete_btn" class="btn btn-danger"><?php echo __('Delete selected users'); ?></button>
<button id="add_new_btn" class="btn" rel="<?php echo url::site('user/create'); ?>"><?php echo __('Add new user'); ?></button>
<?php echo $pagination; ?>