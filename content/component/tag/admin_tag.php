<?php

if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

if (empty($_SESSION['namauser']) and empty($_SESSION['passuser']) and $_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class Tag extends PoCore
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'tag', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle($GLOBALS['_']['component_name']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=tag&act=multidelete', 'autocomplete' => 'off')); ?>
				<?= $this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"')); ?>
				<?php
				$columns = array(
					array('title' => 'Id', 'options' => 'style="width:30px;"'),
					array('title' => $GLOBALS['_']['tag_title'], 'options' => ''),
					array('title' => $GLOBALS['_']['tag_count'], 'options' => 'style="width:50px;"'),
					array('title' => $GLOBALS['_']['tag_action'], 'options' => 'class="no-sort" style="width:50px;"')
				);
				?>
				<?= $this->pohtml->createTable(array('id' => 'table-tag', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true); ?>
				<?= $this->pohtml->formEnd(); ?>
			</div>
		</div>
	</div>
	<?= $this->pohtml->dialogDelete('tag'); ?>
<?php
}

public function datatable()
{
	if (!$this->auth($_SESSION['leveluser'], 'tag', 'read')) {
		echo $this->pohtml->error();
		exit;
	}
	$table = 'tag';
	$primarykey = 'id_tag';
	$columns = array(
		array(
			'db' => $primarykey, 'dt' => '0', 'field' => $primarykey,
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[" . $i . "][deldata]' value='" . $d . "' disabled />\n
					</div>\n";
			}
		),
		array('db' => $primarykey, 'dt' => '1', 'field' => $primarykey),
		array('db' => 'title', 'dt' => '2', 'field' => 'title'),
		array(
			'db' => 'count', 'dt' => '3', 'field' => 'count',
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>" . $d . "</div>\n";
			}
		),
		array(
			'db' => $primarykey, 'dt' => '4', 'field' => $primarykey,
			'formatter' => function ($d, $row, $i) {
				return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a class='btn btn-xs btn-danger alertdel' id='" . $d . "' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
			}
		)
	);
	echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns));
}

public function addnew()
{
	if (!$this->auth($_SESSION['leveluser'], 'tag', 'create')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$tags = $this->postring->valid($_POST['tag'], 'xss');
		$expl = explode(",", $tags);
		$total = count($expl);
		for ($i = 0; $i < $total; $i++) {
			$data = array(
				'title' => $expl[$i],
				'tag_seo' => $this->postring->seo_title($expl[$i]),
				'count' => 0
			);
			$query_tag = $this->podb->insertInto('tag')->values($data);
			$query_tag->execute();
		}
		$this->poflash->success($GLOBALS['_']['tag_message_1'], 'admin.php?mod=tag');
	}
	?>
	<div class="block-content">
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->headTitle($GLOBALS['_']['tag_addnew']); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=tag&act=addnew', 'autocomplete' => 'off')); ?>
				<div class="row">
					<div class="col-md-12">
						<?= $this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['component_name'], 'name' => 'tag', 'id' => 'tag', 'mandatory' => true, 'options' => 'required', 'help' => $GLOBALS['_']['tag_help'])); ?>
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
	if (!$this->auth($_SESSION['leveluser'], 'tag', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$query = $this->podb->deleteFrom('tag')->where('id_tag', $this->postring->valid($_POST['id'], 'sql'));
		$query->execute();
		$this->poflash->success($GLOBALS['_']['tag_message_2'], 'admin.php?mod=tag');
	}
}

public function multidelete()
{
	if (!$this->auth($_SESSION['leveluser'], 'tag', 'delete')) {
		echo $this->pohtml->error();
		exit;
	}
	if (!empty($_POST)) {
		$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
		if ($totaldata != "0") {
			$items = $_POST['item'];
			foreach ($items as $item) {
				$query = $this->podb->deleteFrom('tag')->where('id_tag', $this->postring->valid($item['deldata'], 'sql'));
				$query->execute();
			}
			$this->poflash->success($GLOBALS['_']['tag_message_2'], 'admin.php?mod=tag');
		} else {
			$this->poflash->error($GLOBALS['_']['tag_message_4'], 'admin.php?mod=tag');
		}
	}
}
}
