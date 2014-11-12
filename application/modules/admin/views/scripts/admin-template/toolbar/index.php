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
	//------------- nut Publish Items - kieu submit
	$linkPublishItems = $this->baseUrl($this->currentController . '/publish/type/active');
	$btnPublishItems = $this->cmsButton($this->translate('button-publish'),$linkPublishItems,
									   $this->imgUrl . '/toolbar/icon-32-active.png','submit');
	//------------- nut UnPublish Items - kieu submit
	$linkUnPublishItems = $this->baseUrl($this->currentController . '/publish/type/inactive');
	$btnUnPublishItems = $this->cmsButton($this->translate('button-unpublish'),$linkUnPublishItems,
										$this->imgUrl . '/toolbar/icon-32-inactive.png','submit');
	//------------- nut Lock Items - kieu submit
	$linkLockItems = $this->baseUrl($this->currentController . '/change-lock-status/type/active');
	$btnLockItems = $this->cmsButton($this->translate('button-lock'),$linkLockItems,
			$this->imgUrl . '/toolbar/icon-32-lockpage.png','submit');
	//------------- nut Un Lock Items - kieu submit
	$linkUnLockItems = $this->baseUrl($this->currentController . '/change-lock-status/type/inactive');
	$btnUnLockItems = $this->cmsButton($this->translate('button-unlock'),$linkUnLockItems,
			$this->imgUrl . '/toolbar/icon-32-unlockpage.png','submit');
	//------------- nut Upload Banner Image - kieu submit
	$linkUploadBannerImage = $this->baseUrl($this->currentController . '/banner');
	$btnUploadBannerImage = $this->cmsButton($this->translate('button-upload'),$linkUploadBannerImage,
							$this->imgUrl . '/toolbar/icon-32-upload.png','submit');
	//------------- nut Upload Logo Image - kieu submit
	$linkUploadLogoImage = $this->baseUrl($this->currentController . '/logo');
	$btnUploadLogoImage = $this->cmsButton($this->translate('button-upload'),$linkUploadLogoImage,
							$this->imgUrl . '/toolbar/icon-32-upload.png','submit');
	//------------- nut Upload Map Image - kieu submit
	$linkUploadMapImage = $this->baseUrl($this->currentController . '/company-map');
	$btnUploadMapImage = $this->cmsButton($this->translate('button-upload'),$linkUploadMapImage,
							$this->imgUrl . '/toolbar/icon-32-upload.png','submit');
	//------------- nut Upload Advertise Image - kieu submit
	$linkUploadAdvertImage = $this->baseUrl($this->currentController . '/advertise');
	$btnUploadAdvertImage = $this->cmsButton($this->translate('button-upload'),$linkUploadAdvertImage,
			$this->imgUrl . '/toolbar/icon-32-upload.png','submit');
	//------------- nut Upload Document File - kieu submit
	$linkUploadDocument = $this->baseUrl($this->currentController . '/documents');
	$btnUploadDocument = $this->cmsButton($this->translate('button-upload'),$linkUploadDocument,
			$this->imgUrl . '/toolbar/icon-32-upload.png','submit');
	
	//------------- nut Save Items - kieu submit
	switch ($this->arrParam['action']) {
		case 'video':
			$linkSaveItem = $this->baseUrl($this->currentController . '/video');
			break;
		case 'advertise-edit':
			$linkSaveItem = $this->baseUrl($this->currentController . '/advertise-edit');
			break;
		case 'documents-edit':
			$linkSaveItem = $this->baseUrl($this->currentController .'/documents-edit');
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
			$stnBtn = $btnAddNew . ' ' . $btnDeleteItems . ' ' .
					$btnPublishItems . ' ' . $btnUnPublishItems . ' ' .
					$btnLockItems . ' ' . $btnUnLockItems;
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
		case 'banner':
			$stnBtn = $btnUploadBannerImage;
			break;
		case 'logo':
			$stnBtn = $btnUploadLogoImage;
			break;
		case 'company-map':
			$stnBtn = $btnUploadMapImage;
			break;
		case 'video':
			$stnBtn = $btnSaveItem;
			break;
		case 'advertise':
			$stnBtn = $btnUploadAdvertImage;
			break;
		case 'advertise-edit':
			$stnBtn = $btnSaveItem;
			break;
		case 'documents':
			$stnBtn = $btnUploadDocument;
			break;
		case 'documents-edit':
			$stnBtn = $btnSaveItem;
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