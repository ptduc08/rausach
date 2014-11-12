<?php 
	//------------- nut Add Items - kieu link
	$linkAddNew = $this->baseUrl($this->currentController . '/add');
	$btnAddNew = $this->cmsButton('Add',$linkAddNew,
								  $this->imgUrl . '/toolbar/icon-32-new.png','link');
	//------------- nut Edit Items - kieu link
	if (isset($this->Item['id'])) {
		$linkEditItem = $this->baseUrl($this->currentController . '/edit/id/' . $this->Item['id']);
		$btnEditItem = $this->cmsButton('Edit',$linkEditItem,
										$this->imgUrl . '/toolbar/icon-32-edit.png','link');
	}	
	//------------- nut Delete Items - kieu submit
	$linkDeleteItems = $this->baseUrl($this->currentController . '/multi-delete');
	$btnDeleteItems = $this->cmsButton('Delete Items',$linkDeleteItems,
										$this->imgUrl . '/toolbar/icon-32-delete.png','submit');
	//------------- nut Sort Items - kieu submit
	$linkSortItems = $this->baseUrl($this->currentController . '/sort');
	$btnSortItems = $this->cmsButton('Sort Items',$linkSortItems,
									$this->imgUrl . '/toolbar/icon-32-sort.png','submit');
	//------------- nut Active Items - kieu submit
	$linkActiveItems = $this->baseUrl($this->currentController . '/change-status/type/active');
	$btnActiveItems = $this->cmsButton('Active Items',$linkActiveItems,
									   $this->imgUrl . '/toolbar/icon-32-active.png','submit');
	//------------- nut Inactive Items - kieu submit
	$linkInactiveItems = $this->baseUrl($this->currentController . '/change-status/type/inactive');
	$btnInactiveItems = $this->cmsButton('Inactive Items',$linkInactiveItems,
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
	$btnSaveItem = $this->cmsButton('Save',$linkSaveItem,
									$this->imgUrl . '/toolbar/icon-32-save.png','submit');
	//------------- nut Accept Delete Items - kieu submit
	if (isset($this->arrParam['id'])) {
		$linkAcceptDeleteItems = $this->baseUrl($this->currentController . '/delete/id/' 
												. $this->arrParam['id']);
		$btnAcceptDeleteItems = $this->cmsButton('Accept',$linkAcceptDeleteItems,
				$this->imgUrl . '/toolbar/icon-32-accept.png','submit');
	}
	//------------- nut Accept Multi Delete Items - kieu submit
	
		$linkAcceptDeleteMultiItems = $this->baseUrl($this->currentController . '/multi-delete');
		$btnAcceptDeleteMultiItems = $this->cmsButton('Accept',$linkAcceptDeleteMultiItems,
				$this->imgUrl . '/toolbar/icon-32-accept.png','submit');
	
	
	//------------- nut Cancel - kieu link
	$linkCancel = $this->baseUrl($this->currentController . '/index');
	$btnCancel = $this->cmsButton('Cancel',$linkCancel,
									$this->imgUrl . '/toolbar/icon-32-cancel.png','link');
	//------------- nut Back - kieu link
	$linkBack = $this->baseUrl($this->currentController . '/index');
	$btnBack = $this->cmsButton('Back',$linkBack,
			$this->imgUrl . '/toolbar/icon-32-back.png','link');
	
	switch ($this->arrParam['action']) {
		case 'index':
			$stnBtn = $btnAddNew . ' ' . $btnDeleteItems . ' ' . $btnSortItems . ' ' .
					$btnActiveItems . ' ' . $btnInactiveItems;
			break;
		case 'add':
			$stnBtn = $btnSaveItem . ' ' . $btnCancel;
			break;
		case 'edit':
			$stnBtn = $btnSaveItem . ' ' . $btnCancel;
			break;
		case 'delete':
			$stnBtn = $btnAcceptDeleteItems . ' ' . $btnCancel;
			break;
		case 'multi-delete':
			$stnBtn = $btnAcceptDeleteMultiItems . ' ' . $btnCancel;
			break;
		case 'info':
			$stnBtn = $btnEditItem . ' ' . $btnBack;
			break;
		default:
			$stnBtn = '';
	}
?>

<div id="toolbar-box">
	<div class="t">
		<div class="t">
			<div class="t"></div>
		</div>
	</div>
	
	<div class="m">
		<div id="toolbar" class="toolbar" >				
			<?php echo $stnBtn; ?>
			<div class="clr"></div>
		</div>
		<div class="header icon-48-install"><?php echo $this->Title; ?></div>
                                
		<div class="clr"></div>
	</div>
	<div class="b">
		<div class="b">
			<div class="b"></div>
		</div>
	</div>
</div>