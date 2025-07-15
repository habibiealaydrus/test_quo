    <!-- Offcanvas to add new company -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCompany" aria-labelledby="offcanvasAddCompanyLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddCompanyLabel" class="offcanvas-title">Add Company</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="pt-0" id="addNewCompanyForm" onsubmit="return false"
                action="{{ route('companyStore') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="code">Company Code</label>
                    <input type="text" class="form-control" id="code" placeholder="Company Code"
                        name="code" aria-label="Company Code" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">Company Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Company Name"
                        name="name" aria-label="Company Name" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="area">Company Area</label>
                    <input type="text" class="form-control" id="area" placeholder="Company Area"
                        name="area" aria-label="Company Area" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="codeArea">Code Area</label>
                    <input type="text" class="form-control" id="codeArea" placeholder="Code Area"
                        name="codeArea" aria-label="Code Area" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" placeholder="Logo"
                        name="logo" aria-label="logo" />
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>
