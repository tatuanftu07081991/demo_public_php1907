<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/infoUser.php';
	$provinceList = new addressCtrl();
	$ProvinceNameList = $provinceList->getList(null, 'provinceName');

	if(isset($_POST['btnSubmit'])) {
		$providerName = $_POST['providerName'];
        $providerCode = $_POST['providerCode'];
        $provinceName = $_POST['provinceName'];
        $districtName = isset($_POST['districtName']) ? $_POST['districtName'] : '';
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $faxNumber = $_POST['faxNumber'];
        $taxNumber = $_POST['taxNumber'];
        $bankName = $_POST['bankName'];
        $bankAcc = $_POST['bankAcc'];
        $delegate = $_POST['delegate'];
        $position = $_POST['position'];

        $athorized = $_POST['athorized'];
        $contactPerson = $_POST['contactPerson'];
        $contactEmail = $_POST['contactEmail'];
        $contactPhone = $_POST['contactPhone'];

        $companyInfo = new newCompanyCtrl($providerName, $providerCode, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone);

        $infor = $companyInfo->insertCompany($providerName, $providerCode, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone);
	}

?>

<div class="col-md-9 my-4">
	<div class="alert alert-<?php if(isset($infor)&&$infor=='USER EXIST'){ echo "danger";}else echo "success";?> text-center">
		<?php if(isset($infor)){ echo $infor;}else echo "Xin mời nhập thông tin công ty";?>
	</div>
	
	<form method="POST" id="formAdd" action="#">
		<div class="form-group">
			<label for="InputCompanyName">Provider Full Name:</label>
			<input type="text" class="form-control w-50" id="InputCompanyName" placeholder="Input your company name" name="providerName">
		</div>
		<div class="form-group">
			<label for="InputCompanyName1">Provider Code:</label>
			<input type="text" class="form-control w-50" id="InputCompanyName1" placeholder="Input provider Code" name="providerCode">
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="provinceName">Province/City</label>
				<?php echo $ProvinceNameList;?>
			</div>
			<div class="form-group col-md-3" id="districtName">
				<label for="districtName">District/Ward</label>
				<select id="districtName" class="form-control" name="districtName">
					
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="inputAddress">Address</label>
				<input type="text" class="form-control" id="inputAddress" name="address">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="InputPhone">Phone Number:</label>
				<input type="text" class="form-control" id="InputPhone" placeholder="Input your phone number" name="phoneNumber">
			</div>
			<div class="form-group col-md-4">
				<label for="InputPhone">Fax:</label>
				<input type="text" class="form-control" id="InputPhone" placeholder="Input your fax number" name="faxNumber">
			</div>
			<div class="form-group col-md-4">
				<label for="InputTaxId">Tax Identification Number:</label>
				<input type="text" class="form-control" id="InputTaxId" placeholder="Input your tax id" name="taxNumber">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="InputBankName">Bank's Name:</label>
				<input type="text" class="form-control" id="InputBankName" placeholder="Input Bank Name" name="bankName">
			</div>
			<div class="form-group col-md-6">
				<label for="InputBankAccount">Bank's Account:</label>
				<input type="text" class="form-control" id="InputBankAccount" placeholder="Input Bank Account" name="bankAcc">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="InputDelegate">Delegate:</label>
				<input type="text" class="form-control" id="InputDelegate" placeholder="Input Delegate" name="delegate">
			</div>
			<div class="form-group col-md-4">
				<label for="InputPosition">Position:</label>
				<input type="text" class="form-control" id="InputPosition" placeholder="Input Position" name="position">
			</div>
			<div class="form-group col-md-4">
				<label for="InputAthorized">Athorized:</label>
				<input type="text" class="form-control" id="InputAthorized" placeholder="Input Athorized" name="athorized">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="InputContactPerson">Contact Person:</label>
				<input type="text" class="form-control" id="InputContactPerson" placeholder="Input Contact Person" name="contactPerson">
			</div>
			<div class="form-group col-md-4">
				<label for="InputContactEmail">Contact Email:</label>
				<input type="email" class="form-control" id="InputContactEmail" placeholder="Input Contact Email" name="contactEmail">
			</div>
			<div class="form-group col-md-4">
				<label for="InputContactPhone">Contact Phone:</label>
				<input type="text" class="form-control" id="InputContactPhone" placeholder="Input Contact Phone" name="contactPhone">
			</div>
		</div>
		<button type="submit" class="btn btn-primary mb-3" name="btnSubmit">Submit</button>
	</form>
</div>