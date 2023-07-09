<div class="row">
    <div class="col-sm-6" style="border-right:1px solid #dfdada">
        <div class="mb-2 row">
            <div class="col-sm-12"><h6 class="titleheadst">Supplier Info</h6></div>
            <div class="col-sm-6">
                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Name
                    <stong class="text-danger">*</stong>
                </label>
                <div class="col-sm-12">
                    <input type="hidden" name="supplier_id" value="{{$supplierInfo->id}}">
                    <input type="text" id="inputname" class="form-control"
                           name="supplier_name"
                           value="{{$supplierInfo->supplier_name}}"
                           placeholder="Supplier Name" required>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Phone
                    <stong class="text-danger">*</stong>
                </label>
                <div class="col-sm-12">
                    <input type="text" id="inputname" class="form-control"
                           name="supplier_phone_one"
                           value="{{$supplierInfo->supplier_phone_one}}"
                           placeholder="Supplier Phone" required>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Phone
                    Two
                </label>
                <div class="col-sm-12">
                    <input type="text" id="inputname" class="form-control"
                           name="supplier_phone_two"
                           value="{{$supplierInfo->supplier_phone_two}}"
                           placeholder="Supplier Phone Two">
                </div>
            </div>
            <div class="col-sm-6">
                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Email
                </label>
                <div class="col-sm-12">
                    <input type="text" id="inputname" class="form-control"
                           name="supplier_email"
                           value="{{$supplierInfo->supplier_email}}"
                           placeholder="Supplier Email">
                </div>
            </div>
            <div class="col-sm-12">
                <label for="supplier_address" class="col-sm-12  pr-0 col-form-label">Supplier
                    Address
                </label>
                <div class="col-sm-12">
                                                <textarea name="supplier_address" class="form-control"
                                                          id="supplier_address" cols="10" rows="3"
                                                          placeholder="Supplier Address">{{$supplierInfo->supplier_address}}</textarea>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-6" style="border-right:1px solid #dfdada">
        <div class="col-sm-12 "><h6 class="titleheadst">Company Info</h6></div>
        <div class="mb-2 row">
            <div class="col-sm-6">
                <label for="company_name" class="col-sm-12  pr-0 col-form-label">Company
                    Name
                    <stong class="text-danger">*</stong>
                </label>
                <div class="col-sm-12">
                    <input type="text" id="company_name" class="form-control"
                           name="company_name"
                           value="{{$supplierInfo->company_name}}"
                           placeholder="Company Name" required>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="company_phone" class="col-sm-12  pr-0 col-form-label">Company
                    Phone
                    <stong class="text-danger">*</stong>
                </label>
                <div class="col-sm-12">
                    <input type="text" id="company_phone" class="form-control"
                           name="company_phone"
                           value="{{$supplierInfo->company_phone}}"

                           placeholder="Company Phone" required>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="com_email" class="col-sm-12  pr-0 col-form-label">Company Email
                </label>
                <div class="col-sm-12">
                    <input type="text" id="com_email" class="form-control"
                           name="company_email"
                           value="{{$supplierInfo->company_email}}"
                           placeholder="Company Email">
                </div>
            </div>
            <div class="col-sm-6">
                <label for="due" class="col-sm-12  pr-0 col-form-label">Previous Due Balance
                </label>
                <div class="col-sm-12">
                    <input type="number" id="due" class="form-control" name="previous_due"
                           value="{{$supplierInfo->previous_due}}"
                           placeholder="Due Balance" step="any" min="0">
                </div>
            </div>
            <div class="col-sm-12">
                <label for="company_address" class="col-sm-12  pr-0 col-form-label">Company
                    Address
                </label>
                <div class="col-sm-12">
                                                <textarea name="company_address"
                                                          class="form-control"
                                                          id="company_address" cols="10" rows="3"
                                                          placeholder="Company Address">
                                                    {{$supplierInfo->company_address}}
                                                </textarea>
                </div>
            </div>

        </div>
    </div>
</div>
