<?php

if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

if (empty($_SESSION['namauser']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class Infografis extends PoCore
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'infografis', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Infografis', '
						<div class="btn-title pull-right">
							<a href="admin.php?mod=infografis&act=addnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> ' . $GLOBALS['_']['addnew'] . '</a>
						</div>
					'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=infografis&act=multidelete', 'autocomplete' => 'off')); ?>
				<?= $this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"')); ?>
				<?php
				$columns = array(
					array('title' => 'Id', 'options' => 'style="width:30px;"'),
					array('title' => 'Gambar', 'options' => ''),
					array('title' => 'Keterangan', 'options' => ''),
					array('title' => 'Action', 'options' => 'class="no-sort" style="width:50px;"')
				);
				?>
				<?= $this->pohtml->createTable(array('id' => 'table-infografis', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true); ?>
				<?= $this->pohtml->formEnd(); ?>
			</div>
		</div>
	</div>
	<?= $this->pohtml->dialogDelete('infografis'); ?>
<?php
}

public function datatable()
{
	if (!$this->auth($_SESSION['leveluser'], 'infografis', 'read')) {
		echo $this->pohtml->error();
		exit;
	}
	$table = 'infografis';
	$primarykey = 'id';
	$columns = array(
		array(
			'db' => $primarykey, 'dt' => '0', 'field' => $primarykey,
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>
						<input type='checkbox' id='titleCheckdel' />
						<input type='hidden' class='deldata' name='item[" . $i . "][deldata]' value='" . $d . "' disabled />
					</div>";
			}
		),
		array('db' => $primarykey, 'dt' => '1', 'field' => $primarykey),
		array('db' => 'gambar', 'dt' => '2', 'field' => 'gambar'),
		array('db' => 'keterangan', 'dt' => '3', 'field' => 'keterangan'),
		array(
			'db' => $primarykey, 'dt' => '4', 'field' => $primarykey,
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>
						<div class='btn-group btn-group-xs'>
							<a href='admin.php?mod=infografis&act=edit&id=" . $d . "' class='btn btn-xs btn-default' id='" . $d . "' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='" . $d . "' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>
					</div>";
			}
		),
	);
	echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns));
}

public function addnew()
{
	if (!$this->auth($_SESSION['leveluser'], 'infografis', 'create')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$infografis = array(
			'gambar' => $_POST['gambar'],
			'keterangan' => $this->postring->valid($_POST['keterangan'], 'xss'),
		);
		$query = $this->podb->insertInto('infografis')->values($infografis);
		$query->execute();
		$this->poflash->success('Infografis has been successfully added', 'admin.php?mod=infografis');
	}
	?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Add Infografis'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=infografis&act=addnew', 'autocomplete' => 'off')); ?>
				<div class="row">
					<div class="col-md-12">
						<?= $this->pohtml->inputText(array('type' => 'text', 'label' => 'Gambar', 'name' => 'gambar', 'id' => 'picture', 'mandatory' => false, 'options' => '',), $inputgroup = true, $inputgroupopt = array('href' => '../' . DIR_INC . '/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => $GLOBALS['_']['action_7'] . ' Gambar')); ?>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= (isset($_POST['keterangan']) ? $_POST['keterangan'] : ''); ?>" placeholder="Keterangan" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?= $this->pohtml->formAction(); ?>
					</div>
				</div>
				<?= $this->pohtml->formEnd(); ?>
			</div>
		</div>
	</div>
<?php
}

public function edit()
{
	if (!$this->auth($_SESSION['leveluser'], 'infografis', 'update')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$infografis = array(
			'gambar' => $_POST['gambar'],
			'keterangan' => $this->postring->valid($_POST['keterangan'], 'xss'),
		);
		$query = $this->podb->update('infografis')
			->set($infografis)
			->where('id', $this->postring->valid($_POST['id'], 'sql'));
		$query->execute();
		$this->poflash->success('Infografis has been successfully updated', 'admin.php?mod=infografis');
	}
	$id = $this->postring->valid($_GET['id'], 'sql');
	$current_infografis = $this->podb->from('infografis')
		->where('id', $id)
		->limit(1)
		->fetch();
	if (empty($current_infografis)) {
		echo $this->pohtml->error();
		exit;
	}
	?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Update Infografis'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=infografis&act=edit', 'autocomplete' => 'off')); ?>
				<?= $this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_infografis['id'])); ?>
				<div class="row">
					<div class="col-md-12">
						<?= $this->pohtml->inputText(array('type' => 'text', 'label' => 'Gambar', 'name' => 'gambar', 'id' => 'picture', 'value' => $current_infografis['gambar'], 'mandatory' => false, 'options' => '',), $inputgroup = true, $inputgroupopt = array('href' => '../' . DIR_INC . '/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => $GLOBALS['_']['action_7'] . ' Gambar')); ?>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= (isset($_POST['keterangan']) ? $_POST['keterangan'] : $current_infografis['keterangan']); ?>" placeholder="Keterangan" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?= $this->pohtml->formAction(); ?>
					</div>
				</div>
				<?= $this->pohtml->formEnd(); ?>
			</div>
		</div>
	</div>
<?php
}

public function delete()
{
	if (!$this->auth($_SESSION['leveluser'], 'infografis', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$query = $this->podb->deleteFrom('infografis')->where('id', $this->postring->valid($_POST['id'], 'sql'));
		$query->execute();
		$this->poflash->success('Infografis has been successfully deleted', 'admin.php?mod=infografis');
	}
}

public function multidelete()
{
	if (!$this->auth($_SESSION['leveluser'], 'infografis', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
		if ($totaldata != "0") {
			$items = $_POST['item'];
			foreach ($items as $item) {
				$query = $this->podb->deleteFrom('infografis')->where('id', $this->postring->valid($item['deldata'], 'sql'));
				$query->execute();
			}
			$this->poflash->success('Infografis has been successfully deleted', 'admin.php?mod=infografis');
		} else {
			$this->poflash->error('Error deleted infografis data', 'admin.php?mod=infografis');
		}
	}
}
}
