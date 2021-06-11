<?php
if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

if (empty($_SESSION['namauser']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class Runningtext extends PoCore
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Runningtext', '
						
					'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=runningtext&act=multidelete', 'autocomplete' => 'off')); ?>
				<?= $this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"')); ?>
				<?php
				$columns = array(
					array('title' => 'Id', 'options' => 'style="width:30px;"'),
					array('title' => 'No', 'options' => ''),
					array('title' => 'Isitext', 'options' => ''),
					array('title' => 'Action', 'options' => 'class="no-sort" style="width:50px;"')
				);
				?>
				<?= $this->pohtml->createTable(array('id' => 'table-runningtext', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true); ?>
				<?= $this->pohtml->formEnd(); ?>
			</div>
		</div>
	</div>
	<?= $this->pohtml->dialogDelete('runningtext'); ?>
<?php
}

public function datatable()
{
	if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'read')) {
		echo $this->pohtml->error();
		exit;
	}
	$table = 'runningtext';
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
		array('db' => 'no', 'dt' => '2', 'field' => 'no'),
		array('db' => 'isitext', 'dt' => '3', 'field' => 'isitext'),
		array(
			'db' => $primarykey, 'dt' => '4', 'field' => $primarykey,
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>
						<div class='btn-group btn-group-xs'>
							<a href='admin.php?mod=runningtext&act=edit&id=" . $d . "' class='btn btn-xs btn-default' id='" . $d . "' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
						</div>
					</div>";
			}
		),
	);
	echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns));
}

public function addnew()
{
	if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'create')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$runningtext = array(
			'no' => $_POST['no'],
			'isitext' => $this->postring->valid($_POST['isitext'], 'xss'),
		);
		$query = $this->podb->insertInto('runningtext')->values($runningtext);
		$query->execute();
		$this->poflash->success('Runningtext has been successfully added', 'admin.php?mod=runningtext');
	}
	?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Add Runningtext'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=runningtext&act=addnew', 'autocomplete' => 'off')); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="no">No</label>
							<input type="text" name="no" class="form-control" id="no" value="<?= (isset($_POST['no']) ? $_POST['no'] : ''); ?>" placeholder="No" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="isitext">Isitext</label>
							<input type="text" name="isitext" class="form-control" id="isitext" value="<?= (isset($_POST['isitext']) ? $_POST['isitext'] : ''); ?>" placeholder="Isitext" />
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
	if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'update')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$runningtext = array(
			'no' => $_POST['no'],
			'isitext' => $this->postring->valid($_POST['isitext'], 'xss'),
		);
		$query = $this->podb->update('runningtext')
			->set($runningtext)
			->where('id', $this->postring->valid($_POST['id'], 'sql'));
		$query->execute();
		$this->poflash->success('Runningtext has been successfully updated', 'admin.php?mod=runningtext');
	}
	$id = $this->postring->valid($_GET['id'], 'sql');
	$current_runningtext = $this->podb->from('runningtext')
		->where('id', $id)
		->limit(1)
		->fetch();
	if (empty($current_runningtext)) {
		echo $this->pohtml->error();
		exit;
	}
	?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle('Update Runningtext'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=runningtext&act=edit', 'autocomplete' => 'off')); ?>
				<?= $this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_runningtext['id'])); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="no">Id Tidak perlu dirubah</label>
							<input type="text" name="no" class="form-control" disabled id="no" value="<?= (isset($_POST['no']) ? $_POST['no'] : $current_runningtext['no']); ?>" placeholder="No" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="isitext">Isi Running Text</label>
							<input type="text" name="isitext" class="form-control" id="isitext" value="<?= (isset($_POST['isitext']) ? $_POST['isitext'] : $current_runningtext['isitext']); ?>" placeholder="Isitext" />
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
	if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$query = $this->podb->deleteFrom('runningtext')->where('id', $this->postring->valid($_POST['id'], 'sql'));
		$query->execute();
		$this->poflash->success('Runningtext has been successfully deleted', 'admin.php?mod=runningtext');
	}
}

public function multidelete()
{
	if (!$this->auth($_SESSION['leveluser'], 'runningtext', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
		if ($totaldata != "0") {
			$items = $_POST['item'];
			foreach ($items as $item) {
				$query = $this->podb->deleteFrom('runningtext')->where('id', $this->postring->valid($item['deldata'], 'sql'));
				$query->execute();
			}
			$this->poflash->success('Runningtext has been successfully deleted', 'admin.php?mod=runningtext');
		} else {
			$this->poflash->error('Error deleted runningtext data', 'admin.php?mod=runningtext');
		}
	}
}
}
