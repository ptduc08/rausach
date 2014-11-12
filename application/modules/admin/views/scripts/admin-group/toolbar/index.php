<?php 
	//------------- nut Add Items - kieu link
	$linkAddNew = $this->baseUrl($this->currentController . '/add');
	$btnAddNew = $this->cmsButton($this->translate('button-add'),$linkAddNew,
								  $this->imgUrl . '/toolbar/icon-32-new.png','link');
	//------------- nut Edit Items - kieu link
	$btnEditItem = $this->cmsButton($this->translate('button-edit'),'',
						$this->imgUrl . '/toolbar/icon-32-edit.png','');
	if (isset($this->Item['id'])) {
		$linkEditItem = $this->baseUrl($this->currentController . '/edit/id/' . $this->Item['id']);
		$btnEditItem = $this->cmsButton($this->translate('button-edit'),$linkEditItem,
										$this->imgUrl . '/toolbar/icon-32-edit.png','link');
	}	
	//------------- nut Delete Items - kieu submit
	$linkDeleteItems = $this->baseUrl($this->currentController . '/multi-delete');
	$btnDeleteItems = $this->cmsButton($this->translate('button-delete'),$linkDeleteItems,
										$this->imgUrl . '/toolbar/icon-32-delete.png','submit');
	//------------- nut Sort Items - kieu submit
	$linkSortItems = $this->baseUrl($this->currentController . '/sort');
	$btnSortItems = $this->cmsButton($this->translate('button-sort'),$linkSortItems,
									$this->imgUrl . '/toolbar/icon-32-sort.png','submit');
	//------------- nut Active Items - kieu submit
	$linkActiveItems = $this->baseUrl($this->currentController . '/change-status/type/active');
	$btnActiveItems = $this->cmsButton($this->translate('button-active'),$linkActiveItems,
									   $this->imgUrl . '/toolbar/icon-32-active.png','submit');
	//------------- nut Inactive Items - kieu submit
	$linkInactiveItems = $this->baseUrl($this->currentController . '/change-status/type/inactive');
	$btnInactiveItems = $this->cmsButton($this->translate('button-inactive'),$linkInactiveItems,
										$this->imgUrl . '/toolbar/icon-32-inactive.png','submit');
	//------------- nut Save Items - kieu submit
	switch ($this->arrParam['action']) {
		case 'add':
			$linkSaveItem = $this->baseUrl($this->currentController . '/add');
			break;
		case 'edit':
			$linkSaveItem = $this->baseUrl($this->currentController . '/edit/id/' . $this->arrParam['id']);
			break;
		default:
			$linkSaveItem = '';
	}
	$btnSaveItem = $this->cmsButton($this->translate('button-save'),$linkSaveItem,
									$this->imgUrl . '/toolbar/icon-32-save.png','submit');
	//------------- nut Accept Delete Items - kieu submit
	if (isset($this->arrParam['id'])) {
		$linkAcceptDeleteItems = $this->baseUrl($this->currentController . '/delete/id/' 
												. $this->arrParam['id']);
		$btnAcceptDeleteItems = $this->cmsButton($this->translate('button-accept'),$linkAcceptDeleteItems,
				$this->imgUrl . '/toolbar/icon-32-accept.png','submit');
	}
	//------------- nut Accept Multi Delete Items - kieu submit
	
		$linkAcceptDeleteMultiItems = $this->baseUrl($this->currentController . '/multi-delete');
		$btnAcceptDeleteMultiItems = $this->cmsButton($this->translate('button-accept'),$linkAcceptDeleteMultiItems,
				$this->imgUrl . '/toolbar/icon-32-accept.png','submit');
	
	
	//------------- nut Cancel - kieu link
	$linkCancel = $this->baseUrl($this->currentController . '/index');
	$btnCancel = $this->cmsButton($this->translate('button-cancel'),$linkCancel,
									$this->imgUrl . '/toolbar/icon-32-cancel.png','link');
	//------------- nut Back - kieu link
	$linkBack = $this->baseUrl($this->currentController . '/index');
	$btnBack = $this->cmsButton($this->translate('button-back'),$linkBack,
			$this->imgUrl . '/toolbar/icon-32-back.png','link');
	
	switch ($this->arrParam['action']) {
		case 'index':
			$strBtn = $btnAddNew . ' ' . $btnDeleteItems . ' ' . $btnSortItems . ' ' .
					$btnActiveItems . ' ' . $btnInactiveItems;
			break;
		case 'add':
			$strBtn = $btnSaveItem . ' ' . $btnCancel;
			break;
		case 'edit':
			$strBtn = $btnSaveItem . ' ' . $btnCancel;
			break;
		case 'delete':
			$strBtn = $btnAcceptDeleteItems . ' ' . $btnCancel;
			break;
		case 'multi-delete':
			$strBtn = $btnAcceptDeleteMultiItems . ' ' . $btnCancel;
			break;
		case 'info':
			$strBtn = $btnEditItem . ' ' . $btnBack;
			break;
		default:
			$strBtn = '';
	}
?>

<div class="row">
	<div class="col-lg-12">
		<div id="toolbar-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			
			<div class="m">
				<div id="toolbar" class="toolbar" >
								
					<?php echo $strBtn; ?>
					<div class="clr"></div>                 
					
				</div>
				<h3 class="page-header"><?php echo $this->Title; ?></h3>
		                                
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>
	</div>
</div>