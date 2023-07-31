<h1><?php echo lang('Auth.index_heading'); ?></h1>
<?php breadcrumb() ?>
<div class="row">
	<div class="col">
		<?php echo lang('Auth.index_subheading'); ?>
	</div>
	<div class="col text-end">
		<a href="auth/create_user" class="btn btn-sm btn-outline-secondary rounded-0"><?= icon('person-add') . ' ' . lang('Auth.index_create_user_link'); ?></a>
		<!-- <a href="auth/create_group" class="btn btn-sm btn-outline-secondary rounded-0"><?= icon('people') . ' ' . lang('Auth.index_create_group_link'); ?></a> -->
	</div>
</div>

<div class="table-responsive mt-2 ">
	<table id="tabel-user" class="table table-hover align-middle mb-0">
		<thead>
			<tr>
				<th></th>
				<th><?php echo lang('Auth.index_fname_th'); ?></th>
				<th><?php echo lang('Auth.index_lname_th'); ?></th>
				<th><?php echo lang('Auth.index_email_th'); ?></th>
				<th><?php echo lang('Auth.index_groups_th'); ?></th>
				<th><?php echo lang('Auth.index_status_th'); ?></th>
				<th><?php echo lang('Auth.index_action_th'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user) : ?>

				<tr>
					<td class="text-center" style="width:1px; white-space:nowrap;">
						<img id="thumbnail" src="/image/sm/<?= $user->small; ?>" class="img-fluid img-thumbnail" alt="...">
					</td>
					<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
					<td>
						<div class="row row-cols-auto">
							<?php foreach ($user->groups as $group) : ?>
								<!-- <span class="bg-primary"><?php echo anchor('auth/edit_group/' . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?></span> | -->
								<div class="col px-1">
									<span id="groupUser" class="badge rounded-0"><small class="text-capitalize"><?= $group->name; ?></small></span>
								</div>
							<?php endforeach ?>
						</div>
					</td>

					<td id="active<?= $user->user_id; ?>"><?= ($user->active) ? '<button class="btn btn-sm btn-outline-success border-0 rounded-0" onclick=modal("' . base_url('auth/deactivate/' . $user->user_id) . '")>' . icon('unlock-fill') . '</button>' : '<button class="btn btn-sm btn-outline-danger border-0 rounded-0" onclick=activateUser(' . $user->user_id . ')>' . icon('lock-fill') . '</button>'; ?></td>
					<!-- <td><?php echo ($user->active) ? anchor('auth/deactivate/' . $user->user_id, lang('Auth.index_active_link')) : anchor("auth/activate/" . $user->user_id, lang('Auth.index_inactive_link')); ?></td> -->
					<!-- <td><?php echo anchor('auth/edit_user/' . $user->user_id, lang('Auth.index_edit_link')); ?> <a href=""> <?= icon('pencil-square') ?></a> </td> -->
					<td>
						<div class="btn-group">
							<button class="btn btn-sm btn-outline-primary border-0 rounded-0" onclick="modal('<?= base_url('auth/edit_user/' . $user->user_id); ?>')"> <?= icon('pencil-square') ?></button>
							<button class="btn btn-sm btn-outline-danger border-0 rounded-0" modal="delete-alert" target-url="<?= base_url('auth/delete_user/' . $user->user_id); ?>" data="<?= $user->username; ?>"> <?= icon('trash3-fill') ?></button>

						</div>
					</td>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
</div>


<script>
	$(document).ready(function() {
		$("#tabel-user").DataTable();
	});

	function deactiveUser(id, url) {
		// alert(url);
		hideModal();
		$.ajax({
			url: url,
			data: {
				confirm: 'yes',
				id: id
			},
			type: 'POST',
			beforeSend: function(data) {

				$('#loader').show();
			},
			success: function(data) {
				location.reload(true);
			}
		})
	}

	function activateUser(id) {
		urldeactive = "<?= base_url('auth/deactivate') ?>/" + id;
		deactiveBtn = `<button class="btn btn-sm btn-outline-success border-0 rounded-0" onclick=modal("` + urldeactive + `")> <?= icon('unlock-fill'); ?> </button>`;
		$.ajax({
			url: "<?= base_url('auth/activate'); ?>/" + id,
			type: 'GET',
			beforeSend: function(data) {
				$('#loader').show();
			},
			success: function(data) {
				data = JSON.parse(data);
				// alert(data.status);
				if (data.status == 200) {
					$("#active" + id).html(deactiveBtn);
					iziToast.show({
						title: data.message,
						// message: 'What would you like to add?',
						balloon: false,
						position: 'topCenter',
						theme: "light",
						color: 'blue'
					});
				} else {
					iziToast.show({
						title: data.message,
						// message: 'What would you like to add?',
						balloon: false,
						position: 'topCenter',
						theme: "light",
						color: 'red'
					});
				}
				$('#loader').fadeOut('slow');
			}
		})
	}
</script>