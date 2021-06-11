<?php

if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser']) AND $_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class Clark extends PoCore
{	
	public $podir;

	function __construct()
	{
		parent::__construct();
		$this->podir = new PoDirectory();
	}

	public function index()
	{
		if ($_SESSION['leveluser'] == '1') {
		?>
			<style type="text/css">
				.jumbotron { margin-top: 15px !important; padding-bottom: 150px !important; margin-bottom: 0px !important; }
				.heading-intro { font-size: 40px !important; color: #4d4d4d !important; }
				.desc-intro { font-size: 18px !important; }
				.desc-intro-copy { font-size: 14px !important; }
				.progress-box { margin: 30px auto !important; }
			</style>
			<div class="block-content">
				<div class="jumbotron text-center">
					<h1 class="heading-intro"><?=$GLOBALS['_']['clark_intro'];?></h1>
					<p class="desc-intro"><?=$GLOBALS['_']['clark_desc_intro'];?></p>
					<p class="desc-intro-copy">~ &copy; 2013 - <?=date('Y');?>. PopojiCMS ~</p>
					<p>&nbsp;</p>
					<div class="progress progress-box">
						<div class="progress-bar progress-bar-success" style="width: 35%"><span class="sr-only">35% Complete (success)</span></div>
						<div class="progress-bar progress-bar-warning" style="width: 30%"><span class="sr-only">30% Complete (warning)</span></div>
						<div class="progress-bar progress-bar-danger" style="width: 35%"><span class="sr-only">35% Complete (danger)</span></div>
					</div>
					<p>&nbsp;</p>
					<div class="col-md-12">
						<a href="admin.php?mod=clark&act=theme" class="btn btn-success btn-md"><i class="fa fa-cubes"></i> <?=$GLOBALS['_']['clark_btn_theme'];?></a>&nbsp;&nbsp;
						<a href="admin.php?mod=clark&act=component" class="btn btn-warning btn-md"><i class="fa fa-flask"></i> <?=$GLOBALS['_']['clark_btn_compo'];?></a>&nbsp;&nbsp;
						<a href="javascript:void(0)" class="btn btn-danger btn-md require-modal"><i class="fa fa-life-ring"></i> <?=$GLOBALS['_']['clark_btn_require'];?></a>
					</div>
				</div>
			</div>
			<div id="require-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 id="modal-title"><i class="fa fa-life-ring"></i> <?=$GLOBALS['_']['clark_btn_require'];?></h4>
						</div>
						<div class="modal-body">
							<p>Sebelum menggunakan Clark bacalah prasyarat sistem di bawah ini :</p>
							<ul>
								<li>Clark hanya bisa dijalankan pada database mysql saja.</li>
								<li>Clark akan membuat file otomatis ketika membuild baik elemen tema atau komponen.</li>
								<li>Clark akan membuat tabel otomatis pada database jika diperlukan.</li>
								<li>Clark menggunakan bootstrap sebagai design pada setiap elemen tema atau komponen yang dibuild.</li>
								<li>Jika Clark gagal membuat elemen tema atau komponen pastikan folder <i>po-content</i> mendapatkan hak akses untuk menulis.</li>
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$GLOBALS['_']['action_10'];?></button>
						</div>
					</div>
				</div>
			</div>
		<?php
		} else {
			echo $this->pohtml->error();
			exit;
		}
	}

	public function theme()
	{
		if ($_SESSION['leveluser'] == '1') {
			if (!empty($_POST)) {
		?>
			<title><?=$GLOBALS['_']['clark_generate_1'];?></title>
			<link rel="shortcut icon" href="../<?=DIR_INC;?>/images/favicon.png" />
			<link type="text/css" rel="stylesheet" href="../<?=DIR_INC;?>/css/bootstrap.min.css" />
			<link type="text/css" rel="stylesheet" href="../<?=DIR_INC;?>/css/font-awesome.min.css" />
			<div class="container" style="margin-top:50px;margin-bottom:50px;">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading text-center"><?=$GLOBALS['_']['clark_generate_1'];?></div>
								<div class="panel-body">
									<ul class="list-group">
									<?php
										$error = 0;
										$element = trim(strtolower($this->postring->valid($_POST['element'], 'xss')));
										$nelement = ucfirst($element);
										$targetdir = "../".DIR_CON."/component/".$element;
										$themetargetdir = "../".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss');
										if (file_exists($targetdir)) {
											if ($this->podir->deleteDir($targetdir)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_2'])." `".$element."`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_2'])." `".$element."`</li>";
											}
											if (mkdir($targetdir, 755)) {
												$createdorbidden = fopen($targetdir."/index.html", 'w');
												if ($createdorbidden) {
													if (copy("../".DIR_CON."/component/index.html", $targetdir."/index.html")) {
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
													} else {
														$error+=1;
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
													}
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
												}
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
											}
										} else {
											if (mkdir($targetdir, 755)) {
												$createdorbidden = fopen($targetdir."/index.html", 'w');
												if ($createdorbidden) {
													if (copy("../".DIR_CON."/component/index.html", $targetdir."/index.html")) {
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
													} else {
														$error+=1;
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
													}
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
												}
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$element."`</li>";
											}
										}
										$createelement = fopen($targetdir."/".$element.".php", 'w');
										if ($createelement) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/".$element.".php`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/".$element.".php`</li>";
										}
										$createtheme = fopen($themetargetdir."/".$element.".php", 'w');
										if ($createtheme) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
										}
										$metatitle = $this->postring->valid($_POST['metatitle'], 'xss');
										$metadesc = $this->postring->valid($_POST['metadesc'], 'xss');
										$metakey = $this->postring->valid($_POST['metakey'], 'xss');
										if ($this->postring->valid($_POST['type'], 'xss') == '1') {
											$dumpingpoint = <<<EOS
<?php
/*
 *
 * - PopojiCMS Front End File
 *
 * - File : {$element}.php
 * - Version : 1.0
 * - Author : Clark
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman {$element}.
 * This is a php file for handling front end process for {$element} page.
 *
*/

/**
 * Router untuk menampilkan request halaman {$element}.
 *
 * Router for display request in {$element} page.
 *
*/
\$router->match('GET|POST', '/{$element}', function() use (\$core, \$templates) {
	\$lang = \$core->setlang('home', WEB_LANG);
	\$info = array(
		'page_title' => '{$metatitle}',
		'page_desc' => '{$metadesc}',
		'page_key' => '{$metakey}',
		'social_mod' => '{$nelement}',
		'social_name' => \$core->posetting[0]['value'],
		'social_url' => \$core->posetting[1]['value'].'/{$element}',
		'social_title' => '{$metatitle}',
		'social_desc' => '{$metadesc}',
		'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
	);
	\$adddata = array_merge(\$info, \$lang);
	\$templates->addData(
		\$adddata
	);
	echo \$templates->render('{$element}', compact('lang'));
});
EOS;
											if (fwrite($createelement, $dumpingpoint)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$element.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$element.".php`</li>";
											}
											$codecontent = $_POST['codecontent'];
											if ($this->postring->valid($_POST['addindex'], 'xss') == 'Y') {
												$dumpingpoint2 = <<<EOS
<?=\$this->layout('index');?>

{$codecontent}
EOS;
											} else {
												$dumpingpoint2 = <<<EOS
{$codecontent}
EOS;
											}
											if (fwrite($createtheme, $dumpingpoint2)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
											}
										} else {
											$pages = $this->postring->valid($_POST['pages'], 'xss');
											$dumpingpoint = <<<EOS
<?php
\$router->match('GET|POST', '/{$element}', function() use (\$core, \$templates) {
	\$lang = \$core->setlang('home', WEB_LANG);
	\$pages = \$core->podb->from('pages')
		->select(array('pages_description.title', 'pages_description.content'))
		->leftJoin('pages_description ON pages_description.id_pages = pages.id_pages')
		->where('pages.id_pages', '{$pages}')
		->where('pages_description.id_language', WEB_LANG_ID)
		->where('pages.active', 'Y')
		->limit(1)
		->fetch();
	if (\$pages) {
		\$info = array(
			'page_title' => '{$metatitle}',
			'page_desc' => '{$metadesc}',
			'page_key' => '{$metakey}',
			'social_mod' => '{$nelement}',
			'social_name' => \$core->posetting[0]['value'],
			'social_url' => \$core->posetting[1]['value'].'/{$element}',
			'social_title' => '{$metatitle}',
			'social_desc' => '{$metadesc}',
			'social_img' => \$core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.\$pages['picture']
		);
		\$adddata = array_merge(\$info, \$lang);
		\$templates->addData(
			\$adddata
		);
		echo \$templates->render('{$element}', compact('pages','lang'));
	} else {
		\$info = array(
			'page_title' => \$lang['front_pages_not_found'],
			'page_desc' => \$core->posetting[2]['value'],
			'page_key' => \$core->posetting[3]['value'],
			'social_mod' => \$lang['front_pages_title'],
			'social_name' => \$core->posetting[0]['value'],
			'social_url' => \$core->posetting[1]['value'],
			'social_title' => \$lang['front_pages_not_found'],
			'social_desc' => \$core->posetting[2]['value'],
			'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
		);
		\$adddata = array_merge(\$info, \$lang);
		\$templates->addData(
			\$adddata
		);
		echo \$templates->render('404', compact('lang'));
	}
});
EOS;
											if (fwrite($createelement, $dumpingpoint)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$element.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$element.".php`</li>";
											}
											if (copy($themetargetdir."/pages.php", $themetargetdir."/".$element.".php")) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$element.".php`</li>";
											}
										}
										if ($error == 0) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_4'])." `".$element."` ".strtoupper($GLOBALS['_']['clark_generate_5'])."</li>";
										} else {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_11'])." `".$element."` ".strtoupper($GLOBALS['_']['clark_generate_5'])."</li>";
										}
									?>
									</ul>
								</div>
								<div class="panel-footer">
									<a class="btn btn-sm btn-success" href="<?=WEB_URL;?><?=$element;?>" target="_blank"><?=$GLOBALS['_']['clark_generate_6'];?> <?=$nelement;?> <?=$GLOBALS['_']['clark_generate_5'];?></a>
									<a class="btn btn-sm btn-primary pull-right" href="admin.php?mod=clark"><?=$GLOBALS['_']['clark_generate_7'];?> <?=$GLOBALS['_']['component_name'];?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			exit;
			}
		?>
		<style type="text/css">
			.CodeMirror { height: 400px; }
			.CodeMirror-matchingtag { background: #4d4d4d; }
			.breakpoints { width: .8em; }
			.breakpoint { color: #3498db; }
		</style>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['clark_btn_theme'], '
						<div class="btn-title pull-right label label-info" id="alert-exists" style="display:none;">'.$GLOBALS['_']['clark_alert_exists'].'</div>
					');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=clark&act=theme', 'autocomplete' => 'off'));?>
						<div class="row">
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_elm_name'], 'name' => 'element', 'id' => 'element', 'mandatory' => true, 'options' => 'required'));?>
							</div>
							<div class="col-md-3">
								<?php
									$item = array();
									$themes = $this->podb->from('theme')->orderBy('id_theme ASC')->fetchAll();
									foreach($themes as $theme){
										$item[] = array('value' => $theme['folder'], 'title' => $theme['title']);
									}
								?>
								<?=$this->pohtml->inputSelect(array('id' => 'theme', 'label' => $GLOBALS['_']['clark_select_theme'], 'name' => 'theme', 'mandatory' => true), $item);?>
							</div>
							<div class="col-md-3">
								<?php
									$item2 = array();
									$item2[] = array('value' => '1', 'title' => $GLOBALS['_']['clark_type_1']);
									$item2[] = array('value' => '2', 'title' => $GLOBALS['_']['clark_type_2']);
								?>
								<?=$this->pohtml->inputSelect(array('id' => 'type', 'label' => $GLOBALS['_']['clark_select_type'], 'name' => 'type', 'mandatory' => true), $item2);?>
							</div>
						</div>
						<div class="row" id="select-pages" style="display:none;">
							<div class="col-md-4 col-md-offset-4">
								<?php
									$item3 = array();
									$pages = $this->podb->from('pages')
										->select('pages_description.title')
										->leftJoin('pages_description ON pages_description.id_pages = pages.id_pages')
										->where('pages_description.id_language', '1')
										->orderBy('pages.id_pages ASC')
										->fetchAll();
									foreach($pages as $page){
										$item3[] = array('value' => $page['id_pages'], 'title' => $page['title']);
									}
								?>
								<?=$this->pohtml->inputSelect(array('id' => 'pages', 'label' => $GLOBALS['_']['clark_select_pages'], 'name' => 'pages', 'mandatory' => true), $item3);?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_title'], 'name' => 'metatitle', 'id' => 'metatitle', 'mandatory' => true, 'options' => 'required'));?>
							</div>
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_desc'], 'name' => 'metadesc', 'id' => 'metadesc', 'mandatory' => true, 'options' => 'required'));?>
							</div>
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_key'], 'name' => 'metakey', 'id' => 'metakey', 'mandatory' => true, 'options' => 'required'));?>
							</div>
						</div>
						<div id="write-code">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="message"><?=$GLOBALS['_']['clark_code_content'];?> <span class="text-danger">*</span></label>
										<textarea name="codecontent" id="pocodemirror" style="width:100%; height:400px;"></textarea>
									</div>
								</div>
							</div>
							<?php
								$radioitem = array(
									array('name' => 'addindex', 'id' => 'addindex', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
									array('name' => 'addindex', 'id' => 'addindex', 'value' => 'N', 'options' => '', 'title' => 'N')
								);
								echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['clark_add_index'], 'mandatory' => true), $radioitem, $inline = true);
							?>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->formAction();?>
							</div>
						</div>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
		} else {
			echo $this->pohtml->error();
			exit;
		}
	}

	public function component()
	{
		if ($_SESSION['leveluser'] == '1') {
			if (!empty($_POST)) {
		?>
			<title><?=$GLOBALS['_']['clark_generate_1'];?></title>
			<link rel="shortcut icon" href="../<?=DIR_INC;?>/images/favicon.png" />
			<link type="text/css" rel="stylesheet" href="../<?=DIR_INC;?>/css/bootstrap.min.css" />
			<link type="text/css" rel="stylesheet" href="../<?=DIR_INC;?>/css/font-awesome.min.css" />
			<div class="container" style="margin-top:50px;margin-bottom:50px;">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading text-center"><?=$GLOBALS['_']['clark_generate_1'];?></div>
								<div class="panel-body">
									<ul class="list-group">
									<?php
										$error = 0;
										$compo = trim(strtolower($this->postring->valid($_POST['compo'], 'xss')));
										$ncompo = ucfirst($compo);
										$targetdir = "../".DIR_CON."/component/".$compo;
										if (file_exists($targetdir)) {
											if ($this->podir->deleteDir($targetdir)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_2'])." `".$compo."`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_2'])." `".$compo."`</li>";
											}
											if (mkdir($targetdir, 755)) {
												$createdorbidden = fopen($targetdir."/index.html", 'w');
												if ($createdorbidden) {
													if (copy("../".DIR_CON."/component/index.html", $targetdir."/index.html")) {
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
													} else {
														$error+=1;
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
													}
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
												}
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
											}
										} else {
											if (mkdir($targetdir, 755)) {
												$createdorbidden = fopen($targetdir."/index.html", 'w');
												if ($createdorbidden) {
													if (copy("../".DIR_CON."/component/index.html", $targetdir."/index.html")) {
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
													} else {
														$error+=1;
														echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
													}
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
												}
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_3'])." `".$compo."`</li>";
											}
										}

										$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
										$compotable = trim(strtolower($this->postring->valid($_POST['table'], 'xss')));
										$droptable = "DROP TABLE IF EXISTS `".$compotable."`";
										$resultdrp = $conn->query($droptable);
										echo "<li class='list-group-item'>- ".$droptable."</li>";

										$createtbl = "CREATE TABLE IF NOT EXISTS `".$compotable."` (
											`".trim(strtolower($this->postring->valid($_POST['fieldname'][0], 'xss')))."` ".trim(strtolower($this->postring->valid($_POST['fieldtype'][0], 'xss')))."(".trim(strtolower($this->postring->valid($_POST['fieldlength'][0], 'xss'))).") NOT NULL AUTO_INCREMENT,
											PRIMARY KEY (`".trim(strtolower($this->postring->valid($_POST['fieldname'][0], 'xss')))."`)
										) ENGINE=InnoDB  DEFAULT CHARSET=utf8";
										$resultcrt = $conn->query($createtbl);

										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												$tblfieldtype = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
												if ($tblfieldtype == "int" || $tblfieldtype == "date" || $tblfieldtype == "time" || $tblfieldtype == "datetime") {
													$charset = "";
												} else {
													$charset = "CHARACTER SET utf8 COLLATE utf8_general_ci";
												}
												if (empty(trim(strtolower($this->postring->valid($_POST['fieldlength'][$key], 'xss'))))) {
													$typefield = $tblfieldtype;
													$defaultvalue = "";
												} else {
													$typefield = $tblfieldtype."(".trim($_POST['fieldlength'][$key]).")";
													if ($tblfieldtype == "int" || $tblfieldtype == "text") {
														$defaultvalue = "";
													} else {
														$defaultvalue = "DEFAULT '".trim($this->postring->valid($_POST['fielddefault'][$key], 'xss'))."'";
													}
												}
												$createfield = "ALTER TABLE ".$compotable." ADD ".trim(strtolower($this->postring->valid($_POST['fieldname'][$key], 'xss')))." ".$typefield." ".$charset." NOT NULL ".$defaultvalue."";
												$resultcrtf = $conn->query($createfield);
												echo "<li class='list-group-item'>- ".$createfield."</li>";
											}
										}

										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												if ($_POST['onseotitle'][$key] == '1') {
													$createfieldurl = "ALTER TABLE ".$compotable." ADD seourl varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";
													$resultcrtfurl = $conn->query($createfieldurl);
													echo "<li class='list-group-item'>- ".$createfieldurl."</li>";
												}
											}
										}

										if (isset($_POST['ifjoin'])) {
											$compotablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$droptablejoin = "DROP TABLE IF EXISTS `".$compotablejoin."`";
											$resultdrpjoin = $conn->query($droptablejoin);
											echo "<li class='list-group-item'>- ".$droptablejoin."</li>";

											$createtbljoin = "CREATE TABLE IF NOT EXISTS `".$compotablejoin."` (
												`".trim(strtolower($this->postring->valid($_POST['fieldnamejoin'][0], 'xss')))."` ".trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][0], 'xss')))."(".trim(strtolower($this->postring->valid($_POST['fieldlengthjoin'][0], 'xss'))).") NOT NULL AUTO_INCREMENT,
												PRIMARY KEY (`".trim(strtolower($this->postring->valid($_POST['fieldnamejoin'][0], 'xss')))."`)
											) ENGINE=InnoDB  DEFAULT CHARSET=utf8";
											$resultcrtjoin = $conn->query($createtbljoin);

											foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
												if ($keyjoin != '0') {
													$tblfieldtypejoin = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$keyjoin], 'xss')));
													if ($tblfieldtypejoin == "int" || $tblfieldtypejoin == "date" || $tblfieldtypejoin == "time" || $tblfieldtypejoin == "datetime") {
														$charsetjoin = "";
													} else {
														$charsetjoin = "CHARACTER SET utf8 COLLATE utf8_general_ci";
													}
													if (empty(trim(strtolower($this->postring->valid($_POST['fieldlengthjoin'][$keyjoin], 'xss'))))) {
														$typefieldjoin = $tblfieldtypejoin;
														$defaultvaluejoin = "";
													} else {
														$typefieldjoin = $tblfieldtypejoin."(".trim($_POST['fieldlengthjoin'][$keyjoin]).")";
														if ($tblfieldtypejoin == "int" || $tblfieldtypejoin == "text") {
															$defaultvaluejoin = "";
														} else {
															$defaultvaluejoin = "DEFAULT '".trim($this->postring->valid($_POST['fielddefaultjoin'][$keyjoin], 'xss'))."'";
														}
													}
													$createfieldjoin = "ALTER TABLE ".$compotablejoin." ADD ".trim(strtolower($this->postring->valid($_POST['fieldnamejoin'][$keyjoin], 'xss')))." ".$typefieldjoin." ".$charsetjoin." NOT NULL ".$defaultvaluejoin."";
													$resultcrtfjoin = $conn->query($createfieldjoin);
													echo "<li class='list-group-item'>- ".$createfieldjoin."</li>";
												}
											}

											foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
												if ($keyjoin != '0') {
													if ($_POST['onseotitlejoin'][$keyjoin] == '1') {
														$createfieldurljoin = "ALTER TABLE ".$compotablejoin." ADD seourl varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";
														$resultcrtfurljoin = $conn->query($createfieldurljoin);
														echo "<li class='list-group-item'>- ".$createfieldurljoin."</li>";
													}
												}
											}
										}

										$createcompophp = fopen($targetdir."/admin_".$compo.".php", 'w');
										if ($createcompophp) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/admin_".$compo.".php`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/admin_".$compo.".php`</li>";
										}

										$dumpingpointphp = <<<EOS
<?php

if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

if (empty(\$_SESSION['namauser']) AND empty(\$_SESSION['passuser']) AND \$_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class {$ncompo} extends PoCore
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'read')) {
			echo \$this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('{$ncompo}', '
						<div class="btn-title pull-right">
							<a href="admin.php?mod={$compo}&act=addnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.\$GLOBALS['_']['addnew'].'</a>\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$ncompotablejoin = trim(ucfirst($this->postring->valid($_POST['tablejoin'], 'xss')));
											$dumpingpointphp .= <<<EOS
							<a href="admin.php?mod={$compo}&act={$compotablejoin}" class="btn btn-success btn-sm"><i class="fa fa-angle-right"></i> {$ncompotablejoin}</a>\n
EOS;
										}
										$dumpingpointphp .= <<<EOS
						</div>
					');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=multidelete', 'autocomplete' => 'off'));?>
						<?=\$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							\$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formtablejoin = trim(ucfirst($this->postring->valid($_POST['tablejoin'], 'xss')));
											$dumpingpointphp .= <<<EOS
								array('title' => '{$formtablejoin}', 'options' => ''),\n
EOS;
										}
										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												if ($_POST['ontable'][$key] == '1') {
													$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
													$dumpingpointphp .= <<<EOS
								array('title' => '{$formfieldnamestr}', 'options' => ''),\n
EOS;
												}
											}
										}
										$dumpingpointphp .= <<<EOS
								array('title' => 'Action', 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=\$this->pohtml->createTable(array('id' => 'table-{$compo}', 'class' => 'table table-striped table-bordered'), \$columns, \$tfoot = true);?>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=\$this->pohtml->dialogDelete('{$compo}');?>
		<?php
	}

	public function datatable()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'read')) {
			echo \$this->pohtml->error();
			exit;
		}
		\$table = '{$compo}';
		\$primarykey = '{$_POST['fieldname'][0]}';\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formtablejoin = trim($this->postring->valid($_POST['tablejoin'], 'xss'));
											$formfieldjoin = trim($this->postring->valid($_POST['fieldjoin'], 'xss'));
											$dumpingpointphp .= <<<EOS
		\$columns = array(
			array('db' => 'a.'.\$primarykey, 'dt' => '0', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<input type='checkbox' id='titleCheckdel' />
						<input type='hidden' class='deldata' name='item[".\$i."][deldata]' value='".\$d."' disabled />
					</div>";
				}
			),
			array('db' => 'a.'.\$primarykey, 'dt' => '1', 'field' => \$primarykey),\n
EOS;
											$dumpingpointphp .= <<<EOS
			array('db' => 'b.{$_POST['fieldnamejoin'][1]}', 'dt' => '2', 'field' => 'b{$_POST['fieldnamejoin'][1]}', 'as' => 'b{$_POST['fieldnamejoin'][1]}'),\n
EOS;
											$nodatatable = 3;
											foreach($_POST['fieldname'] as $key => $n) {
												if ($key != '0') {
													if ($_POST['ontable'][$key] == '1') {
														$formfieldnamestr = trim(strtolower(str_replace('_', ' ', $_POST['fieldname'][$key])));
														$dumpingpointphp .= <<<EOS
			array('db' => 'a.{$formfieldnamestr}', 'dt' => '{$nodatatable}', 'field' => '{$formfieldnamestr}'),\n
EOS;
														$nodatatable++;
													}
												}
											}
											$dumpingpointphp .= <<<EOS
			array('db' => 'a.'.\$primarykey, 'dt' => '{$nodatatable}', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<div class='btn-group btn-group-xs'>
							<a href='admin.php?mod={$compo}&act=edit&id=".\$d."' class='btn btn-xs btn-default' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>
					</div>";
				}
			),
		);
		\$joinquery = "FROM {$compo} AS a JOIN {$formtablejoin} AS b ON (b.{$formfieldjoin} = a.{$formfieldjoin})";
		echo json_encode(SSP::simple(\$_POST, \$this->poconnect, \$table, \$primarykey, \$columns, \$joinquery));
	}\n
EOS;
										} else {
											$dumpingpointphp .= <<<EOS
		\$columns = array(
			array('db' => \$primarykey, 'dt' => '0', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<input type='checkbox' id='titleCheckdel' />
						<input type='hidden' class='deldata' name='item[".\$i."][deldata]' value='".\$d."' disabled />
					</div>";
				}
			),
			array('db' => \$primarykey, 'dt' => '1', 'field' => \$primarykey),\n
EOS;
											$nodatatable = 2;
											foreach($_POST['fieldname'] as $key => $n) {
												if ($key != '0') {
													if ($_POST['ontable'][$key] == '1') {
														$formfieldnamestr = trim(strtolower(str_replace('_', ' ', $_POST['fieldname'][$key])));
														$dumpingpointphp .= <<<EOS
			array('db' => '{$formfieldnamestr}', 'dt' => '{$nodatatable}', 'field' => '{$formfieldnamestr}'),\n
EOS;
														$nodatatable++;
													}
												}
											}
											$dumpingpointphp .= <<<EOS
			array('db' => \$primarykey, 'dt' => '{$nodatatable}', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<div class='btn-group btn-group-xs'>
							<a href='admin.php?mod={$compo}&act=edit&id=".\$d."' class='btn btn-xs btn-default' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>
					</div>";
				}
			),
		);
		echo json_encode(SSP::simple(\$_POST, \$this->poconnect, \$table, \$primarykey, \$columns));
	}
\n
EOS;
	}
	$dumpingpointphp .= <<<EOS

	public function addnew()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'create')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\${$compo} = array(\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formfieldjoin = trim($this->postring->valid($_POST['fieldjoin'], 'xss'));
											$dumpingpointphp .= <<<EOS
				'{$formfieldjoin}' => \$_POST['{$formfieldjoin}'],\n
EOS;
										}
										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												$procfieldname2 = strtolower($_POST['fieldname'][$key]);
												if ($_POST['onappform'][$key] == '1') {
													$tblfieldtype = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
													if ($tblfieldtype == "int" || $tblfieldtype == "date" || $tblfieldtype == "time" || $tblfieldtype == "datetime" || $tblfieldtype == "enum" || $_POST['onfile'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
													} elseif ($tblfieldtype == "text") {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => stripslashes(htmlspecialchars(\$_POST['{$procfieldname2}'],ENT_QUOTES)),\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss'),\n
EOS;
													}
												} else {
													if ($procfieldname2 == 'date') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
													} elseif ($procfieldname2 == 'time') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('H:i:s'),\n
EOS;
													} elseif ($procfieldname2 == 'datetime') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
													}
												}
												if ($_POST['onseotitle'][$key] == '1') {
													$dumpingpointphp .= <<<EOS
				'seourl' => \$this->postring->seo_title(\$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss')),\n
EOS;
												}
											}
										}
										$dumpingpointphp .= <<<EOS
			);
			\$query = \$this->podb->insertInto('{$compo}')->values(\${$compo});
			\$query->execute();
			\$this->poflash->success('{$ncompo} has been successfully added', 'admin.php?mod={$compo}');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('Add {$ncompo}');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=addnew', 'autocomplete' => 'off'));?>
						<div class="row">\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formfieldnamejoin = strtolower($_POST['fieldjoin']);
											$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['tablejoin']));
											$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?php
									\$item = array();
									\$joins = \$this->podb->from('{$formtablejoin}')->orderBy('{$formfieldnamejoin} ASC')->fetchAll();
									foreach(\$joins as \$join){
										\$item[] = array('value' => \$join['{$formfieldnamejoin}'], 'title' => \$join['{$_POST['fieldnamejoin'][1]}']);
									}
								?>
								<?=\$this->pohtml->inputSelect(array('id' => '{$formfieldnamestrjoin}', 'label' => '{$formfieldnamestrjoin}', 'name' => '{$formfieldnamejoin}', 'mandatory' => false), \$item);?>
							</div>\n
EOS;
										}
										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												if ($_POST['onappform'][$key] == '1') {
													$formfieldname = strtolower($_POST['fieldname'][$key]);
													$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
													$tblfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
													if ($tblfieldtypetheme == 'text') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<textarea name="{$formfieldname}" class="form-control" id="po-wysiwyg" placeholder="{$formfieldnamestr}" style="width:100%; height:300px;"><?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?></textarea>
								</div>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'enum') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<select name="{$formfieldname}" class="form-control" id="{$formfieldname}">\n
EOS;
														$enumchooses = explode(",",  str_replace('\'', '', $_POST['fieldlength'][$key]));
														foreach($enumchooses as $enumchoose){
															$enumchooseu = ucfirst($enumchoose);
															$dumpingpointphp .= <<<EOS
										<option value="{$enumchoose}">{$enumchooseu}</option>\n
EOS;
														}
														$dumpingpointphp .= <<<EOS
									</select>
								</div>
							</div>\n
EOS;
													} elseif ($_POST['onfile'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'picture', 'mandatory' => false, 'options' => '',), \$inputgroup = true, \$inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => \$GLOBALS['_']['action_7'].' {$formfieldnamestr}'));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'date') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'date', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'time') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'time', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'datetime') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'datetime', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<input type="text" name="{$formfieldname}" class="form-control" id="{$formfieldname}" value="<?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?>" placeholder="{$formfieldnamestr}" />
								</div>
							</div>\n
EOS;
													}
												}
											}
										}
										$dumpingpointphp .= <<<EOS
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=\$this->pohtml->formAction();?>
							</div>
						</div>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
	}

	public function edit()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'update')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\${$compo} = array(\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formfieldjoin = trim($this->postring->valid($_POST['fieldjoin'], 'xss'));
											$dumpingpointphp .= <<<EOS
				'{$formfieldjoin}' => \$_POST['{$formfieldjoin}'],\n
EOS;
										}
										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												$procfieldname2 = strtolower($_POST['fieldname'][$key]);
												if ($_POST['onappform'][$key] == '1') {
													$tblfieldtype = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
													if ($tblfieldtype == "int" || $tblfieldtype == "date" || $tblfieldtype == "time" || $tblfieldtype == "datetime" || $tblfieldtype == "enum" || $_POST['onfile'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
													} elseif ($tblfieldtype == "text") {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => stripslashes(htmlspecialchars(\$_POST['{$procfieldname2}'],ENT_QUOTES)),\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss'),\n
EOS;
													}
												} else {
													if ($procfieldname2 == 'date') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
													} elseif ($procfieldname2 == 'time') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('H:i:s'),\n
EOS;
													} elseif ($procfieldname2 == 'datetime') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
													}
												}
												if ($_POST['onseotitle'][$key] == '1') {
													$dumpingpointphp .= <<<EOS
				'seourl' => \$this->postring->seo_title(\$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss')),\n
EOS;
												}
											}
										}
										$dumpingpointphp .= <<<EOS
			);
			\$query = \$this->podb->update('{$compo}')
				->set(\${$compo})
				->where('{$_POST['fieldname'][0]}', \$this->postring->valid(\$_POST['id'], 'sql'));
			\$query->execute();
			\$this->poflash->success('{$ncompo} has been successfully updated', 'admin.php?mod={$compo}');
		}
		\$id = \$this->postring->valid(\$_GET['id'], 'sql');
		\$current_{$compo} = \$this->podb->from('{$compo}')\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$compotablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$compofieldjoin = trim(strtolower($this->postring->valid($_POST['fieldjoin'], 'xss')));
											$dumpingpointphp .= <<<EOS
			->select('{$compotablejoin}.{$_POST['fieldnamejoin'][1]} AS b{$_POST['fieldnamejoin'][1]}')
			->leftJoin('{$compotablejoin} ON {$compotablejoin}.{$compofieldjoin} = {$compo}.{$compofieldjoin}')
			->where('{$compo}.{$_POST['fieldname'][0]}', \$id)\n
EOS;
										} else {
											$dumpingpointphp .= <<<EOS
			->where('{$_POST['fieldname'][0]}', \$id)\n
EOS;
										}
										$dumpingpointphp .= <<<EOS
			->limit(1)
			->fetch();
		if (empty(\$current_{$compo})) {
			echo \$this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('Update {$ncompo}');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=edit', 'autocomplete' => 'off'));?>
						<?=\$this->pohtml->inputHidden(array('name' => 'id', 'value' => \$current_{$compo}['{$_POST['fieldname'][0]}']));?>
						<div class="row">\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$formfieldnamejoin = strtolower($_POST['fieldjoin']);
											$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['tablejoin']));
											$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="input-group">
									<?php
										\${$formtablejoin}s = \$this->podb->from('{$formtablejoin}')
											->orderBy('{$_POST['fieldnamejoin'][0]} DESC')
											->fetchAll();
										echo \$this->pohtml->inputSelectNoOpt(array('id' => '{$formfieldnamejoin}', 'label' => '{$formfieldnamestrjoin}', 'name' => '{$formfieldnamejoin}', 'mandatory' => true));
										echo '<option value="'.\$current_{$compo}['{$formfieldnamejoin}'].'">Selected - '.\$current_{$compo}['b{$_POST['fieldnamejoin'][1]}'].'</option>';
										foreach(\${$formtablejoin}s as \${$formtablejoin}){
											echo '<option value="'.\${$formtablejoin}['{$_POST['fieldnamejoin'][0]}'].'">'.\${$formtablejoin}['{$_POST['fieldnamejoin'][1]}'].'</option>';
										}
										echo \$this->pohtml->inputSelectNoOptEnd();
									?>
									<span class="input-group-btn" style="padding-top:25px !important;">
										<a href="admin.php?mod={$compo}&act=addnew{$formtablejoin}" class="btn btn-success">Add New</a>
									</span>
								</div>
							</div>\n
EOS;
										}
										foreach($_POST['fieldname'] as $key => $n) {
											if ($key != '0') {
												if ($_POST['onappform'][$key] == '1') {
													$formfieldname = strtolower($_POST['fieldname'][$key]);
													$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
													$tblfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
													if ($tblfieldtypetheme == 'text') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<textarea name="{$formfieldname}" class="form-control" id="po-wysiwyg" placeholder="{$formfieldnamestr}" style="width:100%; height:300px;"><?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : \$current_{$compo}['{$formfieldname}']);?></textarea>
								</div>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'enum') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<select name="{$formfieldname}" class="form-control" id="{$formfieldname}">
										<option value="<?=\$current_{$compo}['{$formfieldname}'];?>"><?=\$current_{$compo}['{$formfieldname}'];?></option>\n
EOS;
														$enumchooses = explode(",",  str_replace('\'', '', $_POST['fieldlength'][$key]));
														foreach($enumchooses as $enumchoose){
															$enumchooseu = ucfirst($enumchoose);
															$dumpingpointphp .= <<<EOS
										<option value="{$enumchoose}">{$enumchooseu}</option>\n
EOS;
														}
														$dumpingpointphp .= <<<EOS
									</select>
								</div>
							</div>\n
EOS;
													} elseif ($_POST['onfile'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'picture', 'value' => \$current_{$compo}['{$formfieldname}'], 'mandatory' => false, 'options' => '',), \$inputgroup = true, \$inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => \$GLOBALS['_']['action_7'].' {$formfieldnamestr}'));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'date') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'date', 'value' => \$current_{$compo}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'time') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'time', 'value' => \$current_{$compo}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'datetime') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'datetime', 'value' => \$current_{$compo}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<input type="text" name="{$formfieldname}" class="form-control" id="{$formfieldname}" value="<?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : \$current_{$compo}['{$formfieldname}']);?>" placeholder="{$formfieldnamestr}" />
								</div>
							</div>\n
EOS;
													}
												}
											}
										}
										$dumpingpointphp .= <<<EOS
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=\$this->pohtml->formAction();?>
							</div>
						</div>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
	}

	public function delete()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'delete')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\$query = \$this->podb->deleteFrom('{$compo}')->where('{$_POST['fieldname'][0]}', \$this->postring->valid(\$_POST['id'], 'sql'));
			\$query->execute();
			\$this->poflash->success('{$ncompo} has been successfully deleted', 'admin.php?mod={$compo}');
		}
	}

	public function multidelete()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'delete')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\$totaldata = \$this->postring->valid(\$_POST['totaldata'], 'xss');
			if (\$totaldata != "0") {
				\$items = \$_POST['item'];
				foreach(\$items as \$item){
					\$query = \$this->podb->deleteFrom('{$compo}')->where('{$_POST['fieldname'][0]}', \$this->postring->valid(\$item['deldata'], 'sql'));
					\$query->execute();
				}
				\$this->poflash->success('{$ncompo} has been successfully deleted', 'admin.php?mod={$compo}');
			} else {
				\$this->poflash->error('Error deleted {$compo} data', 'admin.php?mod={$compo}');
			}
		}
	}\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$compotablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$ncompotablejoin = ucfirst($compotablejoin);
											$dumpingpointphp .= <<<EOS

	public function {$compotablejoin}()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'read')) {
			echo \$this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('{$ncompotablejoin}', '
						<div class="btn-title pull-right">
							<a href="admin.php?mod={$compo}&act=addnew{$compotablejoin}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.\$GLOBALS['_']['addnew'].'</a>
							<a href="admin.php?mod={$compo}" class="btn btn-success btn-sm"><i class="fa fa-angle-left"></i> Back</a>
						</div>
					');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=multidelete{$compotablejoin}', 'autocomplete' => 'off'));?>
						<?=\$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							\$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),\n
EOS;
											foreach($_POST['fieldnamejoin'] as $key => $n) {
												if ($key != '0') {
													if ($_POST['ontablejoin'][$key] == '1') {
														$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldnamejoin'][$key]));
														$dumpingpointphp .= <<<EOS
								array('title' => '{$formfieldnamestr}', 'options' => ''),\n
EOS;
													}
												}
											}
											$dumpingpointphp .= <<<EOS
								array('title' => 'Action', 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=\$this->pohtml->createTable(array('id' => 'table-{$compotablejoin}', 'class' => 'table table-striped table-bordered'), \$columns, \$tfoot = true);?>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=\$this->pohtml->dialogDelete('{$compo}', 'delete{$compotablejoin}');?>
		<?php
	}

	public function datatable2()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], 'gallery', 'read')) {
			echo \$this->pohtml->error();
			exit;
		}
		\$table = '{$compotablejoin}';
		\$primarykey = '{$_POST['fieldnamejoin'][0]}';
		\$columns = array(
			array('db' => \$primarykey, 'dt' => '0', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<input type='checkbox' id='titleCheckdel' />
						<input type='hidden' class='deldata' name='item[".\$i."][deldata]' value='".\$d."' disabled />
					</div>";
				}
			),
			array('db' => \$primarykey, 'dt' => '1', 'field' => \$primarykey),\n
EOS;
											$nodatatableifjoin = 2;
											foreach($_POST['fieldnamejoin'] as $key => $n) {
												if ($key != '0') {
													if ($_POST['ontablejoin'][$key] == '1') {
														$formfieldnamestr = trim(strtolower(str_replace('_', ' ', $_POST['fieldnamejoin'][$key])));
														$dumpingpointphp .= <<<EOS
			array('db' => '{$formfieldnamestr}', 'dt' => '{$nodatatableifjoin}', 'field' => '{$formfieldnamestr}'),\n
EOS;
														$nodatatableifjoin++;
													}
												}
											}
											$dumpingpointphp .= <<<EOS
			array('db' => \$primarykey, 'dt' => '{$nodatatableifjoin}', 'field' => \$primarykey,
				'formatter' => function(\$d, \$row, \$i){
					return "<div class='text-center'>
						<div class='btn-group btn-group-xs'>
							<a href='admin.php?mod={$compo}&act=edit{$compotablejoin}&id=".\$d."' class='btn btn-xs btn-default' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".\$d."' data-toggle='tooltip' title='{\$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>
					</div>";
				}
			)
		);
		echo json_encode(SSP::simple(\$_POST, \$this->poconnect, \$table, \$primarykey, \$columns));
	}

	public function addnew{$compotablejoin}()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'create')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\${$compotablejoin} = array(\n
EOS;
											foreach($_POST['fieldnamejoin'] as $key => $n) {
												if ($key != '0') {
													$procfieldname2 = strtolower($_POST['fieldnamejoin'][$key]);
													if ($_POST['onappformjoin'][$key] == '1') {
														$tblfieldtype = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$key], 'xss')));
														if ($tblfieldtype == "int" || $tblfieldtype == "date" || $tblfieldtype == "time" || $tblfieldtype == "datetime" || $tblfieldtype == "enum" || $_POST['onfilejoin'][$key] == '1') {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
														} elseif ($tblfieldtype == "text") {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => stripslashes(htmlspecialchars(\$_POST['{$procfieldname2}'],ENT_QUOTES)),\n
EOS;
														} else {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss'),\n
EOS;
														}
													} else {
														if ($procfieldname2 == 'date') {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
														} elseif ($procfieldname2 == 'time') {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('H:i:s'),\n
EOS;
														} elseif ($procfieldname2 == 'datetime') {
															$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
														}
													}
													if ($_POST['onseotitlejoin'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
				'seourl' => \$this->postring->seo_title(\$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss')),\n
EOS;
													}
												}
											}
											$dumpingpointphp .= <<<EOS
			);
			\$query = \$this->podb->insertInto('{$compotablejoin}')->values(\${$compotablejoin});
			\$query->execute();
			\$this->poflash->success('{$ncompotablejoin} has been successfully added', 'admin.php?mod={$compo}&act={$compotablejoin}');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('Add New {$ncompotablejoin}');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=addnew{$compotablejoin}', 'autocomplete' => 'off'));?>
						<div class="row">\n
EOS;
											foreach($_POST['fieldnamejoin'] as $key => $n) {
												if ($key != '0') {
													if ($_POST['onappformjoin'][$key] == '1') {
														$formfieldname = strtolower($_POST['fieldnamejoin'][$key]);
														$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldnamejoin'][$key]));
														$tblfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$key], 'xss')));
														if ($tblfieldtypetheme == 'text') {
															$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<textarea name="{$formfieldname}" class="form-control" id="po-wysiwyg" placeholder="{$formfieldnamestr}" style="width:100%; height:300px;"><?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?></textarea>
								</div>
							</div>\n
EOS;
														} elseif ($tblfieldtypetheme == 'enum') {
															$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<select name="{$formfieldname}" class="form-control" id="{$formfieldname}">\n
EOS;
															$enumchooses = explode(",",  str_replace('\'', '', $_POST['fieldlengthjoin'][$key]));
															foreach($enumchooses as $enumchoose){
																$enumchooseu = ucfirst($enumchoose);
																$dumpingpointphp .= <<<EOS
										<option value="{$enumchoose}">{$enumchooseu}</option>\n
EOS;
															}
															$dumpingpointphp .= <<<EOS
									</select>
								</div>
							</div>\n
EOS;
														} elseif ($_POST['onfilejoin'][$key] == '1') {
															$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'picture', 'mandatory' => false, 'options' => '',), \$inputgroup = true, \$inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => \$GLOBALS['_']['action_7'].' {$formfieldnamestr}'));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'date') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'date', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'time') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'time', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'datetime') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'datetime', 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} else {
															$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<input type="text" name="{$formfieldname}" class="form-control" id="{$formfieldname}" value="<?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?>" placeholder="{$formfieldnamestr}" />
								</div>
							</div>\n
EOS;
														}
													}
												}
											}
											$dumpingpointphp .= <<<EOS
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=\$this->pohtml->formAction();?>
							</div>
						</div>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
	}

	public function edit{$compotablejoin}()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'update')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\${$compotablejoin} = array(\n
EOS;
										foreach($_POST['fieldnamejoin'] as $key => $n) {
											if ($key != '0') {
												$procfieldname2 = strtolower($_POST['fieldnamejoin'][$key]);
												if ($_POST['onappformjoin'][$key] == '1') {
													$tblfieldtype = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$key], 'xss')));
													if ($tblfieldtype == "int" || $tblfieldtype == "date" || $tblfieldtype == "time" || $tblfieldtype == "datetime" || $tblfieldtype == "enum" || $_POST['onfilejoin'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
													} elseif ($tblfieldtype == "text") {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => stripslashes(htmlspecialchars(\$_POST['{$procfieldname2}'],ENT_QUOTES)),\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => \$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss'),\n
EOS;
													}
												} else {
													if ($procfieldname2 == 'date') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
													} elseif ($procfieldname2 == 'time') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('H:i:s'),\n
EOS;
													} elseif ($procfieldname2 == 'datetime') {
														$dumpingpointphp .= <<<EOS
				'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
													}
												}
												if ($_POST['onseotitlejoin'][$key] == '1') {
													$dumpingpointphp .= <<<EOS
				'seourl' => \$this->postring->seo_title(\$this->postring->valid(\$_POST['{$procfieldname2}'], 'xss')),\n
EOS;
												}
											}
										}
										$dumpingpointphp .= <<<EOS
			);
			\$query = \$this->podb->update('{$compotablejoin}')
				->set(\${$compotablejoin})
				->where('{$_POST['fieldnamejoin'][0]}', \$this->postring->valid(\$_POST['id'], 'sql'));
			\$query->execute();
			\$this->poflash->success('{$ncompotablejoin} has been successfully updated', 'admin.php?mod={$compo}&act={$compotablejoin}');
		}
		\$id = \$this->postring->valid(\$_GET['id'], 'sql');
		\$current_{$compotablejoin} = \$this->podb->from('{$compotablejoin}')
			->where('{$_POST['fieldnamejoin'][0]}', \$id)
			->limit(1)
			->fetch();
		if (empty(\$current_{$compotablejoin})) {
			echo \$this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->headTitle('Update {$ncompotablejoin}');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=\$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod={$compo}&act=edit{$compotablejoin}', 'autocomplete' => 'off'));?>
						<?=\$this->pohtml->inputHidden(array('name' => 'id', 'value' => \$current_{$compotablejoin}['{$_POST['fieldnamejoin'][0]}']));?>
						<div class="row">\n
EOS;
										foreach($_POST['fieldnamejoin'] as $key => $n) {
											if ($key != '0') {
												if ($_POST['onappformjoin'][$key] == '1') {
													$formfieldname = strtolower($_POST['fieldnamejoin'][$key]);
													$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldnamejoin'][$key]));
													$tblfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$key], 'xss')));
													if ($tblfieldtypetheme == 'text') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<textarea name="{$formfieldname}" class="form-control" id="po-wysiwyg" placeholder="{$formfieldnamestr}" style="width:100%; height:300px;"><?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : \$current_{$compotablejoin}['{$formfieldname}']);?></textarea>
								</div>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'enum') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<select name="{$formfieldname}" class="form-control" id="{$formfieldname}">
										<option value="<?=\$current_{$compotablejoin}['{$formfieldname}'];?>"><?=\$current_{$compotablejoin}['{$formfieldname}'];?></option>\n
EOS;
														$enumchooses = explode(",",  str_replace('\'', '', $_POST['fieldlengthjoin'][$key]));
														foreach($enumchooses as $enumchoose){
															$enumchooseu = ucfirst($enumchoose);
															$dumpingpointphp .= <<<EOS
										<option value="{$enumchoose}">{$enumchooseu}</option>\n
EOS;
														}
														$dumpingpointphp .= <<<EOS
									</select>
								</div>
							</div>\n
EOS;
													} elseif ($_POST['onfilejoin'][$key] == '1') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'picture', 'value' => \$current_{$compotablejoin}['{$formfieldname}'], 'mandatory' => false, 'options' => '',), \$inputgroup = true, \$inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => \$GLOBALS['_']['action_7'].' {$formfieldnamestr}'));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'date') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'date', 'value' => \$current_{$compotablejoin}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'time') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'time', 'value' => \$current_{$compotablejoin}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} elseif ($tblfieldtypetheme == 'datetime') {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<?=\$this->pohtml->inputText(array('type' => 'text', 'label' => '{$formfieldnamestr}', 'name' => '{$formfieldname}', 'id' => 'datetime', 'value' => \$current_{$compotablejoin}['{$formfieldname}'], 'mandatory' => false, 'options' => ''));?>
							</div>\n
EOS;
													} else {
														$dumpingpointphp .= <<<EOS
							<div class="col-md-12">
								<div class="form-group">
									<label for="{$formfieldname}">{$formfieldnamestr}</label>
									<input type="text" name="{$formfieldname}" class="form-control" id="{$formfieldname}" value="<?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : \$current_{$compotablejoin}['{$formfieldname}']);?>" placeholder="{$formfieldnamestr}" />
								</div>
							</div>\n
EOS;
													}
												}
											}
										}
										$dumpingpointphp .= <<<EOS
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=\$this->pohtml->formAction();?>
							</div>
						</div>
					<?=\$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
	}

	public function delete{$compotablejoin}()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'delete')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\$query = \$this->podb->deleteFrom('{$compotablejoin}')->where('{$_POST['fieldnamejoin'][0]}', \$this->postring->valid(\$_POST['id'], 'sql'));
			\$query->execute();
			\$this->poflash->success('{$ncompotablejoin} has been successfully deleted', 'admin.php?mod={$compo}&act={$compotablejoin}');
		}
	}

	public function multidelete{$compotablejoin}()
	{
		if (!\$this->auth(\$_SESSION['leveluser'], '{$compo}', 'delete')) {
			echo \$this->pohtml->error();
			exit;
		}
		if (!empty(\$_POST)) {
			\$totaldata = \$this->postring->valid(\$_POST['totaldata'], 'xss');
			if (\$totaldata != "0") {
				\$items = \$_POST['item'];
				foreach(\$items as \$item){
					\$query = \$this->podb->deleteFrom('{$compotablejoin}')->where('{$_POST['fieldnamejoin'][0]}', \$this->postring->valid(\$item['deldata'], 'sql'));
					\$query->execute();
				}
				\$this->poflash->success('{$ncompotablejoin} has been successfully deleted', 'admin.php?mod={$compo}&act={$compotablejoin}');
			} else {
				\$this->poflash->error('Error deleted {$compotablejoin} data', 'admin.php?mod={$compo}&act={$compotablejoin}');
			}
		}
	}\n
EOS;
										}
										$dumpingpointphp .= <<<EOS

}
EOS;

										if (fwrite($createcompophp, $dumpingpointphp)) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/admin_".$compo.".php`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/admin_".$compo.".php`</li>";
										}

										$createcompojs = fopen($targetdir."/admin_javascript.js", 'w');
										if ($createcompojs) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/admin_javascript.js`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/admin_javascript.js`</li>";
										}
										$dumpingpointjs = <<<EOS

$(document).ready(function() {
	$('#table-{$compo}').buildtable('route.php?mod={$compo}&act=datatable');
});
\n
EOS;
										if (isset($_POST['ifjoin'])) {
											$compotablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
											$dumpingpointjs .= <<<EOS
$(document).ready(function() {
	$('#table-{$compotablejoin}').buildtable('route.php?mod={$compo}&act=datatable2');
});
\n
EOS;
										}
										$dumpingpointjs .= <<<EOS
$(document).ready(function() {
	$('#date').datetimepicker({
		format: 'YYYY-MM-DD',
		showTodayButton: true,
		showClear: true
	});

	$('#time').datetimepicker({
		format: 'HH:mm:ss'
	});

	$('#datetime').datetimepicker({
		format: 'YYYY-MM-DD HH:mm:ss',
		showTodayButton: true,
		showClear: true
	});

	$("#date").mask("9999/99/99");
	$("#time").mask("99:99:99");
	$("#datetime").mask("9999/99/99 99:99:99");
});
EOS;
										if (fwrite($createcompojs, $dumpingpointjs)) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/admin_javascript.js`</li>";
										} else {
											$error+=1;
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/admin_javascript.js`</li>";
										}

										if (isset($_POST['iftheme'])) {
											$metatitle = $this->postring->valid($_POST['metatitle'], 'xss');
											$metadesc = $this->postring->valid($_POST['metadesc'], 'xss');
											$metakey = $this->postring->valid($_POST['metakey'], 'xss');
											$createelement = fopen($targetdir."/".$compo.".php", 'w');
											if ($createelement) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/".$compo.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/component/".$compo.".php`</li>";
											}
											$dumpingpointelement = <<<EOS
<?php
\n
EOS;
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compotableelementjoin}', function() use (\$core, \$templates) {
	\$lang = \$core->setlang('home', WEB_LANG);
	\$info = array(
		'page_title' => '{$metatitle}',
		'page_desc' => '{$metadesc}',
		'page_key' => '{$metakey}',
		'social_mod' => '{$ncompo}',
		'social_name' => \$core->posetting[0]['value'],
		'social_url' => \$core->posetting[1]['value'].'/{$compotableelementjoin}',
		'social_title' => '{$metatitle}',
		'social_desc' => '{$metadesc}',
		'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1'
	);
	\$adddata = array_merge(\$info, \$lang);
	\$templates->addData(
		\$adddata
	);
	echo \$templates->render('{$compotableelementjoin}', compact('lang'));
});

\$router->match('GET|POST', '/{$compotableelementjoin}/page/(\d+)', function(\$page) use (\$core, \$templates) {
	\$lang = \$core->setlang('home', WEB_LANG);
	\$info = array(
		'page_title' => '{$metatitle}',
		'page_desc' => '{$metadesc}',
		'page_key' => '{$metakey}',
		'social_mod' => '{$ncompo}',
		'social_name' => \$core->posetting[0]['value'],
		'social_url' => \$core->posetting[1]['value'].'/{$compotableelementjoin}',
		'social_title' => '{$metatitle}',
		'social_desc' => '{$metadesc}',
		'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => \$page
	);
	\$adddata = array_merge(\$info, \$lang);
	\$templates->addData(
		\$adddata
	);
	echo \$templates->render('{$compotableelementjoin}', compact('lang'));
});
\n
EOS;
												}
											}
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compo}/([a-z0-9_-]+)', function(\$seourl) use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
												} else {
													$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compo}', function() use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
												}
											} else {
												$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compo}', function() use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') == '1') {
												$dumpingpointelement .= <<<EOS
	if (!empty(\$_POST)) {
		if (!empty(\$_POST['{$_POST['fieldname'][1]}'])) {
			\$core->poval->filter_rules(array(\n
EOS;
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														$procfieldname = strtolower($_POST['fieldname'][$key]);
														$dumpingpointelement .= <<<EOS
				'{$procfieldname}' => 'trim|sanitize_string',\n
EOS;
													}
												}
												$dumpingpointelement .= <<<EOS
			));
			\$validated_data = \$core->poval->run(\$_POST);
			if (\$validated_data === false) {
				\$alertmsg = '<div id="contact-form-result">
					<div class="alert alert-warning" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Error! Please check again before submit.
					</div>
				</div>';
			} else {
				\$data = array(\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldjoin = trim($this->postring->valid($_POST['fieldjoin'], 'xss'));
													$dumpingpointelement .= <<<EOS
				'{$formfieldjoin}' => \$_POST['{$formfieldjoin}'],\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														$procfieldname2 = strtolower($_POST['fieldname'][$key]);
														if ($_POST['onappform'][$key] == '1') {
															$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
														} else {
															if ($procfieldname2 == 'date') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
															} elseif ($procfieldname2 == 'time') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('H:i:s'),\n
EOS;
															} elseif ($procfieldname2 == 'datetime') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
															}
														}
														if ($_POST['onseotitle'][$key] == '1') {
															$dumpingpointelement .= <<<EOS
					'seourl' => \$core->postring->seo_title(\$_POST['{$procfieldname2}']),\n
EOS;
														}
													}
												}

												$dumpingpointelement .= <<<EOS
				);
				\$query = \$core->podb->insertInto('{$compo}')->values(\$data);
				\$query->execute();
				unset(\$_POST);
				\$alertmsg = '<div id="contact-form-result">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Thank you, your data successfully submited.
					</div>
				</div>';
			}
		} else {
			\$alertmsg = '<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Error! '.ucfirst('{$_POST['fieldname'][1]}').' is required.
			</div>';
		}
	}\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS
	\${$compotableelementjoin} = \$core->podb->from('{$compotableelementjoin}')
		->where('seourl', \$core->postring->valid(\$seourl, 'xss'))
		->limit(1)
		->fetch();
	if (\${$compotableelementjoin}) {\n
EOS;
												}
											}
											$dumpingpointelement .= <<<EOS
	\$info = array(\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
		'page_title' => '{$metatitle} '.ucfirst(\$seourl),\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
		'page_title' => '{$metatitle}',\n
EOS;
											}
											$dumpingpointelement .= <<<EOS
		'page_desc' => '{$metadesc}',
		'page_key' => '{$metakey}',
		'social_mod' => '{$ncompo}',
		'social_name' => \$core->posetting[0]['value'],
		'social_url' => \$core->posetting[1]['value'].'/{$compo}',\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
		'social_title' => '{$metatitle} '.ucfirst(\$seourl),\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
		'social_title' => '{$metatitle}',\n
EOS;
											}
											$dumpingpointelement .= <<<EOS
		'social_desc' => '{$metadesc}',
		'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1',
		'alertmsg' => \$alertmsg
	);
	\$adddata = array_merge(\$info, \$lang);
	\$templates->addData(
		\$adddata
	);\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
	echo \$templates->render('{$compo}', compact('{$compotableelementjoin}', 'lang'));\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
	echo \$templates->render('{$compo}', compact('lang'));\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS
	} else {
		\$info = array(
			'page_title' => 'Request URL Is Not Found',
			'page_desc' => \$core->posetting[2]['value'],
			'page_key' => \$core->posetting[3]['value'],
			'social_mod' => '{$ncompo}',
			'social_name' => \$core->posetting[0]['value'],
			'social_url' => \$core->posetting[1]['value'],
			'social_title' => 'Request URL Is Not Found',
			'social_desc' => \$core->posetting[2]['value'],
			'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
		);
		\$adddata = array_merge(\$info, \$lang);
		\$templates->addData(
			\$adddata
		);
		echo \$templates->render('404', compact('lang'));
	}\n
EOS;
												}
											}
											$dumpingpointelement .= <<<EOS
});
\n
EOS;
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compo}/([a-z0-9_-]+)/page/(\d+)', function(\$seourl, \$page) use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
												} else {
													$dumpingpointelement .= <<<EOS
\$router->match('GET|POST', '/{$compo}/page/(\d+)', function(\$page) use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
												}
											} else {
												$dumpingpointelement .= <<<EOS

\$router->match('GET|POST', '/{$compo}/page/(\d+)', function(\$page) use (\$core, \$templates) {
	\$alertmsg = '';
	\$lang = \$core->setlang('home', WEB_LANG);\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') == '1') {
												$dumpingpointelement .= <<<EOS
	if (!empty(\$_POST)) {
		if (!empty(\$_POST['{$_POST['fieldname'][1]}'])) {
			\$core->poval->filter_rules(array(\n
EOS;
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														$procfieldname = strtolower($_POST['fieldname'][$key]);
														$dumpingpointelement .= <<<EOS
				'{$procfieldname}' => 'trim|sanitize_string',\n
EOS;
													}
												}
												$dumpingpointelement .= <<<EOS
			));
			\$validated_data = \$core->poval->run(\$_POST);
			if (\$validated_data === false) {
				\$alertmsg = '<div id="contact-form-result">
					<div class="alert alert-warning" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Error! Please check again before submit.
					</div>
				</div>';
			} else {
				\$data = array(\n
EOS;
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														$procfieldname2 = strtolower($_POST['fieldname'][$key]);
														if ($_POST['onappform'][$key] == '1') {
															$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => \$_POST['{$procfieldname2}'],\n
EOS;
														} else {
															if ($procfieldname2 == 'date') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('Y-m-d'),\n
EOS;
															} elseif ($procfieldname2 == 'time') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('H:i:s'),\n
EOS;
															} elseif ($procfieldname2 == 'datetime') {
																$dumpingpointelement .= <<<EOS
					'{$procfieldname2}' => date('Y-m-d H:i:s'),\n
EOS;
															}
														}
														if ($_POST['onseotitle'][$key] == '1') {
															$dumpingpointelement .= <<<EOS
					'seourl' => \$core->postring->seo_title(\$_POST['{$procfieldname2}']),\n
EOS;
														}
													}
												}

												$dumpingpointelement .= <<<EOS
				);
				\$query = \$core->podb->insertInto('{$compo}')->values(\$data);
				\$query->execute();
				unset(\$_POST);
				\$alertmsg = '<div id="contact-form-result">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						Thank you, your data successfully submited.
					</div>
				</div>';
			}
		} else {
			\$alertmsg = '<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Error! '.ucfirst('{$_POST['fieldname'][1]}').' is required.
			</div>';
		}
	}\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS
	\${$compotableelementjoin} = \$core->podb->from('{$compotableelementjoin}')
		->where('seourl', \$core->postring->valid(\$seourl, 'xss'))
		->limit(1)
		->fetch();
	if (\${$compotableelementjoin}) {\n
EOS;
												}
											}
											$dumpingpointelement .= <<<EOS
	\$info = array(\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
		'page_title' => '{$metatitle} '.ucfirst(\$seourl),\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
		'page_title' => '{$metatitle}',\n
EOS;
											}
											$dumpingpointelement .= <<<EOS
		'page_desc' => '{$metadesc}',
		'page_key' => '{$metakey}',
		'social_mod' => '{$ncompo}',
		'social_name' => \$core->posetting[0]['value'],
		'social_url' => \$core->posetting[1]['value'].'/{$compo}',\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
		'social_title' => '{$metatitle} '.ucfirst(\$seourl),\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
		'social_title' => '{$metatitle}',\n
EOS;
											}
											$dumpingpointelement .= <<<EOS
		'social_desc' => '{$metadesc}',
		'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => \$page,
		'alertmsg' => \$alertmsg
	);
	\$adddata = array_merge(\$info, \$lang);
	\$templates->addData(
		\$adddata
	);\n
EOS;
											if (isset($_POST['ifjoin'])) {
												$dumpingpointelement .= <<<EOS
	echo \$templates->render('{$compo}', compact('{$compotableelementjoin}', 'lang'));\n
EOS;
											} else {
												$dumpingpointelement .= <<<EOS
	echo \$templates->render('{$compo}', compact('lang'));\n
EOS;
											}
											if ($this->postring->valid($_POST['type'], 'xss') != '1') {
												if (isset($_POST['ifjoin'])) {
													$ncompotableelementjoin = ucfirst(trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss'))));
													$compotableelementjoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointelement .= <<<EOS
	} else {
		\$info = array(
			'page_title' => 'Request URL Is Not Found',
			'page_desc' => \$core->posetting[2]['value'],
			'page_key' => \$core->posetting[3]['value'],
			'social_mod' => '{$ncompo}',
			'social_name' => \$core->posetting[0]['value'],
			'social_url' => \$core->posetting[1]['value'],
			'social_title' => 'Request URL Is Not Found',
			'social_desc' => \$core->posetting[2]['value'],
			'social_img' => \$core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
		);
		\$adddata = array_merge(\$info, \$lang);
		\$templates->addData(
			\$adddata
		);
		echo \$templates->render('404', compact('lang'));
	}\n
EOS;
												}
											}
											$dumpingpointelement .= <<<EOS
});
\n
EOS;

											if (fwrite($createelement, $dumpingpointelement)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$compo.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/component/".$compo.".php`</li>";
											}

											$themetargetdir = "../".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss');
											$createtheme = fopen($themetargetdir."/".$compo.".php", 'w');
											if ($createtheme) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compo.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compo.".php`</li>";
											}
											$dumpingpointtheme = <<<EOS
<?=\$this->layout('index');?>
\n
EOS;
											$themetype = $this->postring->valid($_POST['type'], 'xss');
											if ($themetype == '1') {
												$dumpingpointtheme .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?=htmlspecialchars_decode(\$this->e(\$alertmsg));?>
			<form name="form-{$compo}" action="<?=BASE_URL;?>/{$compo}" method="post">\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['tablejoin']));
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
				<div class="form-group">
					<?php
						\$item = array();
						\$joins = \$this->pocore()->call->podb->from('{$formtablejoin}')->orderBy('{$formfieldnamejoin} ASC')->fetchAll();
						foreach(\$joins as \$join){
							\$item[] = array('value' => \$join['{$formfieldnamejoin}'], 'title' => \$join['{$_POST['fieldnamejoin'][1]}']);
						}
					?>
					<?=\$this->pocore()->call->pohtml->inputSelect(array('id' => '{$formfieldnamestrjoin}', 'label' => '{$formfieldnamestrjoin}', 'name' => '{$formfieldnamejoin}', 'mandatory' => false), \$item);?>
				</div>\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['onappform'][$key] == '1') {
															$formfieldname = strtolower($_POST['fieldname'][$key]);
															$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
															$tblfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
															if ($tblfieldtypetheme == 'text') {
																$dumpingpointtheme .= <<<EOS
				<div class="form-group">
					<label for="{$formfieldname}">{$formfieldnamestr}</label>
					<textarea name="{$formfieldname}" class="form-control" id="{$formfieldname}" rows="3" placeholder="{$formfieldnamestr}"><?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?></textarea>
				</div>\n
EOS;
															} elseif ($tblfieldtypetheme == 'enum') {
																$dumpingpointtheme .= <<<EOS
				<div class="form-group">
					<label for="{$formfieldname}">{$formfieldnamestr}</label>
					<select name="{$formfieldname}" class="form-control" id="{$formfieldname}">\n
EOS;
																$enumchooses = explode(",",  str_replace('\'', '', $_POST['fieldlength'][$key]));
																foreach($enumchooses as $enumchoose){
																	$enumchooseu = ucfirst($enumchoose);
																	$dumpingpointtheme .= <<<EOS
						<option value="{$enumchoose}">{$enumchooseu}</option>\n
EOS;
																}
																$dumpingpointtheme .= <<<EOS
					</select>
				</div>\n
EOS;
															} else {
																$dumpingpointtheme .= <<<EOS
				<div class="form-group">
					<label for="{$formfieldname}">{$formfieldnamestr}</label>
					<input type="text" name="{$formfieldname}" class="form-control" id="{$formfieldname}" value="<?=(isset(\$_POST['{$formfieldname}']) ? \$_POST['{$formfieldname}'] : '');?>" placeholder="{$formfieldnamestr}" />
				</div>\n
EOS;
															}
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
				<button type="submit" class="btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>
EOS;
											} elseif ($themetype == '2') {
												$dumpingpointtheme .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td class="text-center">No</td>\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formtablejoin = trim(ucfirst($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
							<td class="text-center">{$formtablejoin}</td>\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['ontable'][$key] == '1') {
															$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
															$dumpingpointtheme .= <<<EOS
							<td class="text-center">{$formfieldnamestr}</td>\n
EOS;
														}
													}
												}
												$limitperpage = trim($this->postring->valid($_POST['limitperpage'], 'xss'));
												$dumpingpointtheme .= <<<EOS
						</tr>
					</thead>
					<tbody>
						<?php
							\$limit = '{$limitperpage}';
							\$offset = \$this->pocore()->call->popaging->searchPosition(\$limit, \$this->e(\$page));\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
							\$querys = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
							\$querys = \$this->pocore()->call->podb->from('{$compo}')->orderBy('{$_POST['fieldname'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
							\$notab = \$offset+1;
							foreach(\$querys as \$query) {
						?>
							<tr>
								<td class="text-center"><?=\$notab;?></td>\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['fieldjoin']));
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
								<?php \$join = \$this->pocore()->call->podb->from('{$formtablejoin}')->where('{$formfieldnamejoin}', \$query['{$formfieldnamejoin}'])->limit(1)->fetch(); ?>
								<td class="text-center"><?=\$join['{$_POST['fieldnamejoin'][1]}'];?></td>\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['ontable'][$key] == '1') {
															$formfieldname = strtolower($_POST['fieldname'][$key]);
															$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
															if ($formfieldtypetheme == 'text') {
																$dumpingpointtheme .= <<<EOS
								<td class="text-center"><?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?></td>\n
EOS;
															} else {
																$dumpingpointtheme .= <<<EOS
								<td class="text-center"><?=\$query['{$formfieldname}'];?></td>\n
EOS;
															}
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
							</tr>
						<?php
							\$notab++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->count();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->count();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compo}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
											} elseif ($themetype == '3') {
												$dumpingpointtheme .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td class="text-center">No</td>\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formtablejoin = trim(ucfirst($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
							<td class="text-center">{$formtablejoin}</td>\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['ontable'][$key] == '1') {
															$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldname'][$key]));
															$dumpingpointtheme .= <<<EOS
							<td class="text-center">{$formfieldnamestr}</td>\n
EOS;
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
						</tr>
					</thead>
					<tbody>
						<?php\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
							\$querys = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->orderBy('{$_POST['fieldnamejoin'][0]} ASC')->fetchAll();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
							\$querys = \$this->pocore()->call->podb->from('{$compo}')->orderBy('{$_POST['fieldname'][0]} ASC')->fetchAll();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
							\$notab = \$offset+1;
							foreach(\$querys as \$query) {
						?>
							<tr>
								<td class="text-center"><?=\$notab;?></td>\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['fieldjoin']));
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
								<?php \$join = \$this->pocore()->call->podb->from('{$formtablejoin}')->where('{$formfieldnamejoin}', \$query['{$formfieldnamejoin}'])->limit(1)->fetch(); ?>
								<td class="text-center"><?=\$join['{$_POST['fieldnamejoin'][1]}'];?></td>\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['ontable'][$key] == '1') {
															$formfieldname = strtolower($_POST['fieldname'][$key]);
															$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
															if ($formfieldtypetheme == 'text') {
																$dumpingpointtheme .= <<<EOS
								<td class="text-center"><?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?></td>\n
EOS;
															} else {
																$dumpingpointtheme .= <<<EOS
								<td class="text-center"><?=\$query['{$formfieldname}'];?></td>\n
EOS;
															}
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
							</tr>
						<?php
							\$notab++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
EOS;
											} elseif ($themetype == '4') {
												$limitperpage = trim($this->postring->valid($_POST['limitperpage'], 'xss'));
												$dumpingpointtheme .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				\$limit = '{$limitperpage}';
				\$offset = \$this->pocore()->call->popaging->searchPosition(\$limit, \$this->e(\$page));\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
				\$querys = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
				\$querys = \$this->pocore()->call->podb->from('{$compo}')->orderBy('{$_POST['fieldname'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
				\$notab = \$offset+1;
				foreach(\$querys as \$query) {
			?>
			<div class="panel">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['fieldjoin']));
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
					<?php \$join = \$this->pocore()->call->podb->from('{$formtablejoin}')->where('{$formfieldnamejoin}', \$query['{$formfieldnamejoin}'])->limit(1)->fetch(); ?>
					<?=\$join['{$_POST['fieldnamejoin'][1]}'];?><br />\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['onlistdata'][$key] == '1') {
															$formfieldname = strtolower($_POST['fieldname'][$key]);
															$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
															if ($formfieldtypetheme == 'text') {
																$dumpingpointtheme .= <<<EOS
					<?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?><br />\n
EOS;
															} else {
																$dumpingpointtheme .= <<<EOS
					<?=\$query['{$formfieldname}'];?><br />\n
EOS;
															}
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
				</div>
				<div class="panel-footer">&nbsp;</div>
			</div>
			<?php
				\$notab++;
				}
			?>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->count();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->count();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compo}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
											} elseif ($themetype == '5') {
												$dumpingpointtheme .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
				\$querys = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->fetchAll();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
				\$querys = \$this->pocore()->call->podb->from('{$compo}')->orderBy('{$_POST['fieldname'][0]} DESC')->fetchAll();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
				\$notab = \$offset+1;
				foreach(\$querys as \$query) {
			?>
			<div class="panel">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formfieldnamestrjoin = ucfirst(str_replace('_', ' ', $_POST['fieldjoin']));
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
					<?php \$join = \$this->pocore()->call->podb->from('{$formtablejoin}')->where('{$formfieldnamejoin}', \$query['{$formfieldnamejoin}'])->limit(1)->fetch(); ?>
					<?=\$join['{$_POST['fieldnamejoin'][1]}'];?><br />\n
EOS;
												}
												foreach($_POST['fieldname'] as $key => $n) {
													if ($key != '0') {
														if ($_POST['onlistdata'][$key] == '1') {
															$formfieldname = strtolower($_POST['fieldname'][$key]);
															$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtype'][$key], 'xss')));
															if ($formfieldtypetheme == 'text') {
																$dumpingpointtheme .= <<<EOS
					<?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?><br />\n
EOS;
															} else {
																$dumpingpointtheme .= <<<EOS
					<?=\$query['{$formfieldname}'];?><br />\n
EOS;
															}
														}
													}
												}
												$dumpingpointtheme .= <<<EOS
				</div>
				<div class="panel-footer">&nbsp;</div>
			</div>
			<?php
				\$notab++;
				}
			?>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php\n
EOS;
												if (isset($_POST['ifjoin'])) {
													$formfieldnamejoin = strtolower($_POST['fieldjoin']);
													$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->where('{$formfieldnamejoin}', \${$formtablejoin}['{$formfieldnamejoin}'])->count();\n
EOS;
												} else {
													$dumpingpointtheme .= <<<EOS
					\$totaldata = \$this->pocore()->call->podb->from('{$compo}')->count();\n
EOS;
												}
												$dumpingpointtheme .= <<<EOS
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compo}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
											}

											if (fwrite($createtheme, $dumpingpointtheme)) {
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compo.".php`</li>";
											} else {
												$error+=1;
												echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compo.".php`</li>";
											}

											if (isset($_POST['ifjoin'])) {
												$compojoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
												$createthemejoin = fopen($themetargetdir."/".$compojoin.".php", 'w');
												if ($createthemejoin) {
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compojoin.".php`</li>";
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_8'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compojoin.".php`</li>";
												}
												$dumpingpointthemejoin = <<<EOS
<?=\$this->layout('index');?>
\n
EOS;
												$themetype = $this->postring->valid($_POST['type'], 'xss');
												if ($themetype == '1') {
												} elseif ($themetype == '2') {
													$dumpingpointthemejoin .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td class="text-center">No</td>\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($keyjoin != '0') {
															if ($_POST['ontablejoin'][$keyjoin] == '1') {
																$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldnamejoin'][$keyjoin]));
																$dumpingpointthemejoin .= <<<EOS
							<td class="text-center">{$formfieldnamestr}</td>\n
EOS;
															}
														}
													}
													if (isset($_POST['ifjoin'])) {
														$dumpingpointthemejoin .= <<<EOS
							<td class="text-center">Action</td>\n
EOS;
													}
													$limitperpage = trim($this->postring->valid($_POST['limitperpage'], 'xss'));
													$dumpingpointthemejoin .= <<<EOS
						</tr>
					</thead>
					<tbody>
						<?php
							\$limit = '{$limitperpage}';
							\$offset = \$this->pocore()->call->popaging->searchPosition(\$limit, \$this->e(\$page));
							\$querys = \$this->pocore()->call->podb->from('{$compojoin}')->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();
							\$notab = \$offset+1;
							foreach(\$querys as \$query) {
						?>
							<tr>
								<td class="text-center"><?=\$notab;?></td>\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($keyjoin != '0') {
															if ($_POST['ontablejoin'][$keyjoin] == '1') {
																$formfieldname = strtolower($_POST['fieldnamejoin'][$keyjoin]);
																$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$keyjoin], 'xss')));
																if ($formfieldtypetheme == 'text') {
																	$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?></td>\n
EOS;
																} else {
																	$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><?=\$query['{$formfieldname}'];?></td>\n
EOS;
																}
															}
														}
													}
													if (isset($_POST['ifjoin'])) {
														$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
														$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><a href="<?=BASE_URL.'/{$compo}/'.\$this->e(\$query['seourl']);?>" class="btn btn-sm btn-success">Detail</a></td>\n
EOS;
													}
													$dumpingpointthemejoin .= <<<EOS
							</tr>
						<?php
							\$notab++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php
					\$totaldata = \$this->pocore()->call->podb->from('{$compojoin}')->count();
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compojoin}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
												} elseif ($themetype == '3') {
													$dumpingpointthemejoin .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<td class="text-center">No</td>\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($keyjoin != '0') {
															if ($_POST['ontablejoin'][$keyjoin] == '1') {
																$formfieldnamestr = ucfirst(str_replace('_', ' ', $_POST['fieldnamejoin'][$keyjoin]));
																$dumpingpointthemejoin .= <<<EOS
							<td class="text-center">{$formfieldnamestr}</td>\n
EOS;
															}
														}
													}
													if (isset($_POST['ifjoin'])) {
														$dumpingpointthemejoin .= <<<EOS
							<td class="text-center">Action</td>\n
EOS;
													}
													$dumpingpointthemejoin .= <<<EOS
						</tr>
					</thead>
					<tbody>
						<?php
							\$querys = \$this->pocore()->call->podb->from('{$compojoin}')->orderBy('{$_POST['fieldnamejoin'][0]} ASC')->fetchAll();
							\$notab = \$offset+1;
							foreach(\$querys as \$query) {
						?>
							<tr>
								<td class="text-center"><?=\$notab;?></td>\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($key != '0') {
															if ($_POST['ontablejoin'][$keyjoin] == '1') {
																$formfieldname = strtolower($_POST['fieldnamejoin'][$keyjoin]);
																$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$keyjoin], 'xss')));
																if ($formfieldtypetheme == 'text') {
																	$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?></td>\n
EOS;
																} else {
																	$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><?=\$query['{$formfieldname}'];?></td>\n
EOS;
																}
															}
														}
													}
													if (isset($_POST['ifjoin'])) {
														$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
														$dumpingpointthemejoin .= <<<EOS
								<td class="text-center"><a href="<?=BASE_URL.'/{$compo}/'.\$this->e(\$query['seourl']);?>" class="btn btn-sm btn-success">Detail</a></td>\n
EOS;
													}
													$dumpingpointthemejoin .= <<<EOS
							</tr>
						<?php
							\$notab++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
EOS;
												} elseif ($themetype == '4') {
													$limitperpage = trim($this->postring->valid($_POST['limitperpage'], 'xss'));
													$dumpingpointthemejoin .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				\$limit = '{$limitperpage}';
				\$offset = \$this->pocore()->call->popaging->searchPosition(\$limit, \$this->e(\$page));
				\$querys = \$this->pocore()->call->podb->from('{$compojoin}')->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->limit(\$offset.','.\$limit)->fetchAll();
				\$notab = \$offset+1;
				foreach(\$querys as \$query) {
			?>
			<div class="panel">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($keyjoin != '0') {
															if ($_POST['onlistdatajoin'][$keyjoin] == '1') {
																$formfieldname = strtolower($_POST['fieldnamejoin'][$keyjoin]);
																$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$keyjoin], 'xss')));
																if ($formfieldtypetheme == 'text') {
																	$dumpingpointthemejoin .= <<<EOS
					<?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?><br />\n
EOS;
																} else {
																	$dumpingpointthemejoin .= <<<EOS
					<?=\$query['{$formfieldname}'];?><br />\n
EOS;
																}
															}
														}
													}
													$dumpingpointthemejoin .= <<<EOS
				</div>
				<div class="panel-footer">\n
EOS;
													if (isset($_POST['ifjoin'])) {
														$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
														$dumpingpointthemejoin .= <<<EOS
					<a href="<?=BASE_URL.'/{$compo}/'.\$this->e(\$query['seourl']);?>" class="btn btn-sm btn-success">Detail</a>\n
EOS;
													}
													$dumpingpointthemejoin .= <<<EOS
				</div>
			</div>
			<?php
				\$notab++;
				}
			?>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php
					\$totaldata = \$this->pocore()->call->podb->from('{$compojoin}')->count();
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compojoin}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
												} elseif ($themetype == '5') {
													$dumpingpointthemejoin .= <<<EOS
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				\$querys = \$this->pocore()->call->podb->from('{$compojoin}')->orderBy('{$_POST['fieldnamejoin'][0]} DESC')->fetchAll();
				\$notab = \$offset+1;
				foreach(\$querys as \$query) {
			?>
			<div class="panel">
				<div class="panel-heading">&nbsp;</div>
				<div class="panel-body">\n
EOS;
													foreach($_POST['fieldnamejoin'] as $keyjoin => $njoin) {
														if ($keyjoin != '0') {
															if ($_POST['onlistdatajoin'][$keyjoin] == '1') {
																$formfieldname = strtolower($_POST['fieldnamejoin'][$keyjoin]);
																$formfieldtypetheme = trim(strtolower($this->postring->valid($_POST['fieldtypejoin'][$keyjoin], 'xss')));
																if ($formfieldtypetheme == 'text') {
																	$dumpingpointthemejoin .= <<<EOS
					<?=htmlspecialchars_decode(html_entity_decode(\$query['{$formfieldname}']));?><br />\n
EOS;
																} else {
																	$dumpingpointthemejoin .= <<<EOS
					<?=\$query['{$formfieldname}'];?><br />\n
EOS;
																}
															}
														}
													}
													$dumpingpointthemejoin .= <<<EOS
				</div>
				<div class="panel-footer">\n
EOS;
													if (isset($_POST['ifjoin'])) {
														$formtablejoin = trim(strtolower($this->postring->valid($_POST['tablejoin'], 'xss')));
														$dumpingpointthemejoin .= <<<EOS
					<a href="<?=BASE_URL.'/{$compo}/'.\$this->e(\$query['seourl']);?>" class="btn btn-sm btn-success">Detail</a>\n
EOS;
													}
													$dumpingpointthemejoin .= <<<EOS
				</div>
			</div>
			<?php
				\$notab++;
				}
			?>
		</div>
		<div class="col-md-12 text-center" style="margin-top:30px;">
			<ul class="pagination">
				<?php
					\$totaldata = \$this->pocore()->call->podb->from('{$compojoin}')->count();
					\$totalpage = \$this->pocore()->call->popaging->totalPage(\$totaldata, \$limit);
					echo \$this->pocore()->call->popaging->navPage(\$this->e(\$page), \$totalpage, BASE_URL, '{$compojoin}', 'page', '1', \$this->e(\$front_paging_prev), \$this->e(\$front_paging_next));
				?>
			</ul>
		</div>
	</div>
</div>
EOS;
												}
												if (fwrite($createthemejoin, $dumpingpointthemejoin)) {
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compojoin.".php`</li>";
												} else {
													$error+=1;
													echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_10'])." ".strtoupper($GLOBALS['_']['clark_generate_9'])." `".DIR_CON."/themes/".$this->postring->valid($_POST['theme'], 'xss')."/".$compojoin.".php`</li>";
												}
											}
										}
										if ($error == 0) {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_4'])." `".$compo."` ".strtoupper($GLOBALS['_']['clark_generate_12'])."</li>";
										} else {
											echo "<li class='list-group-item'>- ".strtoupper($GLOBALS['_']['clark_generate_11'])." `".$compo."` ".strtoupper($GLOBALS['_']['clark_generate_12'])."</li>";
										}
									?>
									</ul>
									<div class="alert alert-warning">
										<p><?=$GLOBALS['_']['clark_compo_info_auth'];?> : <a href="admin.php?mod=user&act=userlevel" class="btn btn-xs btn-default">User Level</a></p>
									</div>
								</div>
								<div class="panel-footer">
									<a class="btn btn-sm btn-success" href="admin.php?mod=<?=$compo;?>"><?=$GLOBALS['_']['clark_generate_6'];?> <?=$ncompo;?> <?=$GLOBALS['_']['clark_generate_12'];?></a>
									<a class="btn btn-sm btn-primary pull-right" href="admin.php?mod=clark"><?=$GLOBALS['_']['clark_generate_7'];?> <?=$GLOBALS['_']['component_name'];?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
			exit;
			}
		?>
		<style type="text/css">
			.CodeMirror { height: 400px; }
			.CodeMirror-matchingtag { background: #4d4d4d; }
			.breakpoints { width: .8em; }
			.breakpoint { color: #3498db; }
			.radioopt { position: absolute; right: 20px; margin-top: -20px; }
		</style>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['clark_btn_compo'], '
						<div class="btn-title pull-right label label-info" id="alert-exists" style="display:none;">'.$GLOBALS['_']['clark_alert_exists_compo'].'</div>
						<div id="alert-exists-table" style="display:none;"><br /><div class="btn-title pull-right label label-info">'.$GLOBALS['_']['clark_alert_exists_table'].'</div></div>
					');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=clark&act=component', 'autocomplete' => 'off'));?>
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab"><span class="text-success"><?=$GLOBALS['_']['clark_compo_main'];?></span></a></li>
							<li role="presentation"><a href="#join" aria-controls="join" role="tab" data-toggle="tab"><span class="text-danger"><?=$GLOBALS['_']['clark_compo_join'];?></span></a></li>
							<li role="presentation"><a href="#theme" aria-controls="theme" role="tab" data-toggle="tab"><span class="text-info"><?=$GLOBALS['_']['clark_compo_theme'];?></span></a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="main">
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-6">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_compo_name'], 'name' => 'compo', 'id' => 'element', 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<div class="col-md-6">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_table_name'], 'name' => 'table', 'id' => 'table', 'class' => 'tablename', 'mandatory' => true, 'options' => 'required'));?>
									</div>
								</div>
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive" style="overflow-x: visible !important;">
											<table class="table table-bordered table-striped">
												<tr>
													<th colspan="6" class="text-center"><?=$GLOBALS['_']['clark_compo_field'];?></th>
												</tr>
												<tr>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_1'];?></th>
													<th class="text-center" style="width:150px;"><?=$GLOBALS['_']['clark_compo_field_2'];?></th>
													<th class="text-center" style="width:120px;"><?=$GLOBALS['_']['clark_compo_field_3'];?></th>
													<th class="text-center" style="width:150px;"><?=$GLOBALS['_']['clark_compo_field_4'];?></th>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_5'];?></th>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_6'];?></th>
												</tr>
												<tr>
													<td><input type="text" name="fieldname[]" class="form-control input-sm" required /></td>
													<td>
														<select name="fieldtype[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlength[]" class="form-control number input-sm" /></td>
													<td><input type="text" name="fielddefault[]" class="form-control input-sm" /></td>
													<td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-sm">PrimaryKey</a></td>
													<td class="text-center"><i class="fa fa-ban"></i></td>
												</tr>
												<tr>
													<td><input type="text" name="fieldname[]" class="form-control input-sm" required /></td>
													<td>
														<select name="fieldtype[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlength[]" class="form-control input-sm" /></td>
													<td><input type="text" name="fielddefault[]" class="form-control input-sm" /></td>
													<td class="text-center">
														<div class="btn-group dropup">
															<button type="button" class="btn btn-default btn-sm"><?=$GLOBALS['_']['clark_compo_field_5'];?></button>
															<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
															<ul class="dropdown-menu" role="menu" style="font-size: 12px !important; width:250px;">
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_1'];?> ? <div class="radioopt"><input type="radio" id="radio" name="ontable[1]" value="1" checked /> Y <input type="radio" id="radio" name="ontable[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_2'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onappform[1]" value="1" checked /> Y <input type="radio" id="radio" name="onappform[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_3'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onlistdata[1]" value="1" checked /> Y <input type="radio" id="radio" name="onlistdata[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_4'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onfile[1]" value="1" /> Y <input type="radio" id="radio" name="onfile[1]" value="0" checked /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_5'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onseotitle[1]" value="1" /> Y <input type="radio" id="radio" name="onseotitle[1]" value="0" checked /> N</div></label></a></li>
															</ul>
														</div>
													</td>
													<td class="text-center"><i class="fa fa-ban"></i></td>
												</tr>
												<tr class="tr_clone">
													<td><input type="text" name="fieldname[]" class="form-control input-sm" required /></td>
													<td>
														<select name="fieldtype[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlength[]" class="form-control input-sm" /></td>
													<td><input type="text" name="fielddefault[]" class="form-control input-sm" /></td>
													<td class="text-center">
														<div class="btn-group dropup">
															<button type="button" class="btn btn-default btn-sm"><?=$GLOBALS['_']['clark_compo_field_5'];?></button>
															<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
															<ul class="dropdown-menu" role="menu" style="font-size: 12px !important; width:250px;">
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_1'];?> ? <div class="radioopt"><input type="radio" id="radio" name="ontable[2]" value="1" checked /> Y <input type="radio" id="radio" name="ontable[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_2'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onappform[2]" value="1" checked /> Y <input type="radio" id="radio" name="onappform[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_3'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onlistdata[2]" value="1" checked /> Y <input type="radio" id="radio" name="onlistdata[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_4'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onfile[2]" value="1" /> Y <input type="radio" id="radio" name="onfile[2]" value="0" checked /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_5'];?> ? <div class="radioopt"><input type="radio" id="radio" name="onseotitle[2]" value="1" /> Y <input type="radio" id="radio" name="onseotitle[2]" value="0" checked /> N</div></label></a></li>
															</ul>
														</div>
													</td>
													<td class="text-center" id="fieldaction"><i class="fa fa-ban"></i></td>
												</tr>
												<tr>
													<td colspan="6" class="text-center">
														<a href="javascript:void(0)" class="btn btn-success btn-sm addfield"><i class="fa fa-plus"></i> <?=$GLOBALS['_']['clark_compo_add_field'];?></a>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="join">
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-4 col-md-offset-4">
										<div class="input-group">
											<span class="input-group-addon"><input type="checkbox" name="ifjoin" value="1" /></span>
											<span class="input-group-btn"><button type="button" class="btn btn-default" disabled><?=$GLOBALS['_']['clark_compo_ifjoin'];?></button></span>
										</div>
									</div>
								</div>
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-6">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_table_name'], 'name' => 'tablejoin', 'id' => 'tablejoin', 'class' => 'tablename', 'mandatory' => false, 'options' => ''));?>
									</div>
									<div class="col-md-6">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_field_join'], 'name' => 'fieldjoin', 'id' => 'fieldjoin', 'mandatory' => false, 'options' => ''));?>
									</div>
								</div>
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive" style="overflow-x: visible !important;">
											<table class="table table-bordered table-striped">
												<tr>
													<th colspan="6" class="text-center"><?=$GLOBALS['_']['clark_compo_field'];?></th>
												</tr>
												<tr>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_1'];?></th>
													<th class="text-center" style="width:150px;"><?=$GLOBALS['_']['clark_compo_field_2'];?></th>
													<th class="text-center" style="width:120px;"><?=$GLOBALS['_']['clark_compo_field_3'];?></th>
													<th class="text-center" style="width:150px;"><?=$GLOBALS['_']['clark_compo_field_4'];?></th>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_5'];?></th>
													<th class="text-center"><?=$GLOBALS['_']['clark_compo_field_6'];?></th>
												</tr>
												<tr>
													<td><input type="text" name="fieldnamejoin[]" class="form-control input-sm" /></td>
													<td>
														<select name="fieldtypejoin[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlengthjoin[]" class="form-control number input-sm" /></td>
													<td><input type="text" name="fielddefaultjoin[]" class="form-control input-sm" /></td>
													<td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-sm">PrimaryKey</a></td>
													<td class="text-center"><i class="fa fa-ban"></i></td>
												</tr>
												<tr>
													<td><input type="text" name="fieldnamejoin[]" class="form-control input-sm" /></td>
													<td>
														<select name="fieldtypejoin[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlengthjoin[]" class="form-control input-sm" /></td>
													<td><input type="text" name="fielddefaultjoin[]" class="form-control input-sm" /></td>
													<td class="text-center">
														<div class="btn-group dropup">
															<button type="button" class="btn btn-default btn-sm"><?=$GLOBALS['_']['clark_compo_field_5'];?></button>
															<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
															<ul class="dropdown-menu" role="menu" style="font-size: 12px !important; width:250px;">
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_1'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="ontablejoin[1]" value="1" checked /> Y <input type="radio" id="radiojoin" name="ontablejoin[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_2'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onappformjoin[1]" value="1" checked /> Y <input type="radio" id="radiojoin" name="onappformjoin[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_3'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onlistdatajoin[1]" value="1" checked /> Y <input type="radio" id="radiojoin" name="onlistdatajoin[1]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_4'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onfilejoin[1]" value="1" /> Y <input type="radio" id="radiojoin" name="onfilejoin[1]" value="0" checked /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_5'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onseotitlejoin[1]" value="1" /> Y <input type="radio" id="radiojoin" name="onseotitlejoin[1]" value="0" checked /> N</div></label></a></li>
															</ul>
														</div>
													</td>
													<td class="text-center"><i class="fa fa-ban"></i></td>
												</tr>
												<tr class="tr_clone_join">
													<td><input type="text" name="fieldnamejoin[]" class="form-control input-sm" /></td>
													<td>
														<select name="fieldtypejoin[]" class="form-control input-sm">
															<option value="int">INTEGER</option>
															<option value="varchar">VARCHAR</option>
															<option value="text">TEXT</option>
															<option value="date">DATE</option>
															<option value="time">TIME</option>
															<option value="datetime">DATETIME</option>
															<option value="enum">ENUM</option>
														</select>
													</td>
													<td><input type="text" name="fieldlengthjoin[]" class="form-control input-sm" /></td>
													<td><input type="text" name="fielddefaultjoin[]" class="form-control input-sm" /></td>
													<td class="text-center">
														<div class="btn-group dropup">
															<button type="button" class="btn btn-default btn-sm"><?=$GLOBALS['_']['clark_compo_field_5'];?></button>
															<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
															<ul class="dropdown-menu" role="menu" style="font-size: 12px !important; width:250px;">
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_1'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="ontablejoin[2]" value="1" checked /> Y <input type="radio" id="radiojoin" name="ontablejoin[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_2'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onappformjoin[2]" value="1" checked /> Y <input type="radio" id="radiojoin" name="onappformjoin[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_3'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onlistdatajoin[2]" value="1" checked /> Y <input type="radio" id="radiojoin" name="onlistdatajoin[2]" value="0" /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_4'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onfilejoin[2]" value="1" /> Y <input type="radio" id="radiojoin" name="onfilejoin[2]" value="0" checked /> N</div></label></a></li>
																<li><a href="javascript:void(0)"><label><?=$GLOBALS['_']['clark_compo_field_opt_5'];?> ? <div class="radioopt"><input type="radio" id="radiojoin" name="onseotitlejoin[2]" value="1" /> Y <input type="radio" id="radiojoin" name="onseotitlejoin[2]" value="0" checked /> N</div></label></a></li>
															</ul>
														</div>
													</td>
													<td class="text-center" id="fieldactionjoin"><i class="fa fa-ban"></i></td>
												</tr>
												<tr>
													<td colspan="6" class="text-center">
														<a href="javascript:void(0)" class="btn btn-success btn-sm addfieldjoin"><i class="fa fa-plus"></i> <?=$GLOBALS['_']['clark_compo_add_field'];?></a>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="theme">
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-4 col-md-offset-4">
										<div class="input-group">
											<span class="input-group-addon"><input type="checkbox" name="iftheme" value="1" /></span>
											<span class="input-group-btn"><button type="button" class="btn btn-default" disabled><?=$GLOBALS['_']['clark_compo_iftheme'];?></button></span>
										</div>
									</div>
								</div>
								<p>&nbsp;</p>
								<div class="row">
									<div class="col-md-3">
										<?php
											$item = array();
											$themes = $this->podb->from('theme')->orderBy('id_theme ASC')->fetchAll();
											foreach($themes as $theme){
												$item[] = array('value' => $theme['folder'], 'title' => $theme['title']);
											}
										?>
										<?=$this->pohtml->inputSelect(array('id' => 'theme', 'label' => $GLOBALS['_']['clark_select_theme'], 'name' => 'theme', 'mandatory' => false), $item);?>
									</div>
									<div class="col-md-6">
										<?php
											$item2 = array();
											$item2[] = array('value' => '1', 'title' => $GLOBALS['_']['clark_compo_theme_act_1']);
											$item2[] = array('value' => '2', 'title' => $GLOBALS['_']['clark_compo_theme_act_2']);
											$item2[] = array('value' => '3', 'title' => $GLOBALS['_']['clark_compo_theme_act_3']);
											$item2[] = array('value' => '4', 'title' => $GLOBALS['_']['clark_compo_theme_act_4']);
											$item2[] = array('value' => '5', 'title' => $GLOBALS['_']['clark_compo_theme_act_5']);
										?>
										<?=$this->pohtml->inputSelect(array('id' => 'type', 'label' => $GLOBALS['_']['clark_compo_theme_act'], 'name' => 'type', 'mandatory' => false), $item2);?>
									</div>
									<div class="col-md-3">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_compo_theme_limit'], 'name' => 'limitperpage', 'id' => 'limitperpage', 'class' => 'number', 'value' => '0', 'mandatory' => false, 'options' => ''));?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_title'], 'name' => 'metatitle', 'id' => 'metatitle', 'mandatory' => false, 'options' => ''));?>
									</div>
									<div class="col-md-4">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_desc'], 'name' => 'metadesc', 'id' => 'metadesc', 'mandatory' => false, 'options' => ''));?>
									</div>
									<div class="col-md-4">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['clark_meta_key'], 'name' => 'metakey', 'id' => 'metakey', 'mandatory' => false, 'options' => ''));?>
									</div>
								</div>
							</div>
						</div>
						<p>&nbsp;</p>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->formAction();?>
							</div>
						</div>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
		} else {
			echo $this->pohtml->error();
			exit;
		}
	}

	public function checkexists()
	{
		if ($_SESSION['leveluser'] == '1') {
			if (!empty($_POST)) {
				$folder = $this->postring->valid($_POST['folder'], 'xss');
				if (file_exists('../'.DIR_CON.'/component/'.$folder)) {
					echo "1";
				} else {
					echo "0";
				}
			}
		} else {
			echo $this->pohtml->error();
			exit;
		}
	}

	public function checktableexists()
	{
		if ($_SESSION['leveluser'] == '1') {
			if (!empty($_POST)) {
				$table = $this->postring->valid($_POST['table'], 'xss');
				$checktable = $this->podb->from($table)->select('1')->count();
				if ($checktable > 1) {
					echo "1";
				} else {
					echo "0";
				}
			}
		} else {
			echo $this->pohtml->error();
			exit;
		}
	}
}