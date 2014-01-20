<h1><?php echo __('Roles'); ?></h1>

<table class="table table-bordered table-hover">
  <thead>
    <tr>
        <th class="header" width="1"></th>
        <th class="header"><?php echo __('Role'); ?></th>
        <th class="header"><?php echo __('Description'); ?></th>
      <th class="header"><?php echo __('Actions'); ?></th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($pagination->result() as $role): ?>
    <tr>
      <td><input type="checkbox" class="chkId"<?php echo ($role->removable)? '' : 'disabled="disabled"'; ?> value="<?php echo $role->id; ?>"></td>
      <td><?php echo HTML::anchor('role/update/'.$role->id, ucwords($role->name)); ?></td>
      <td><?php echo $role->description; ?></td>
      <td width="140">
        <?php echo HTML::anchor('role/update/'.$role->id, '<i class="icon-edit"></i> '.__('Edit'), array('class' => 'btn btn-mini')); echo ' &nbsp; '; ?>
        <?php echo ($role->removable) ? HTML::anchor('role/delete?ids='.$role->id, '<i class="icon-trash"></i> '.__('Remove'), array('class' => 'btn btn-mini delete_link')) : ''; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<button id="delete_btn" class="btn btn-danger" rel="<?php echo URL::site('role/delete'); ?>"><?php echo __('Delete selected roles'); ?></button>
<button id="add_new_btn" class="btn" rel="<?php echo URL::site('role/create'); ?>"><?php echo __('Add new role'); ?></button>

<?php echo $pagination->render(); ?>
