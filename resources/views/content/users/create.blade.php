    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false"
                action="{{ route('userStore') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Full Name"
                        name="name" aria-label="Full Name" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Email's User"
                        aria-label="Email's User" name="email" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="text" id="password" class="form-control" placeholder="Password's User"
                        aria-label="Password's User" name="password" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="role">Roles / Position</label>
                    <select id="select2Icons" class="select2-icons form-select" name="role">
                    <optgroup label="Select Your Role">
                              <option value="7" data-icon="fa-solid fa-id-card">Sales Engineer</option>
                            </option>
                            <option value="6" data-icon="fa-solid fa-id-badge">Sales Assistant Manager</option>
                            <option value="5" data-icon="fa-solid fa-clipboard-user">Sales Manager</option>
                            <option value="4" data-icon="fa-solid fa-chalkboard-user">Admin Sales</option>
                            <option value="3" data-icon="fa-solid fa-universal-access">General Manager
                            </optgroup>
                  </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="company">Company</label>
                    <select id="company" class="select2 form-select" name="company">
                        <option value="1">PT. Maju Langgeng Mandiri</option>
                        <option value="2">PT. Andalan Dinamika Konstruksindo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="address_office">Address office</label>
                    <input type="text" id="address_office" class="form-control" placeholder="Address office's User"
                        aria-label="addres office's User" name="address_office" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone_office">Phone office</label>
                    <input type="text" id="phone_office" class="form-control" placeholder="phone office's User"
                        aria-label="phone office's User" name="phone_office" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="website_office">Website office</label>
                    <input type="text" id="website_office" class="form-control" placeholder="website office's User"
                        aria-label="website office's User" name="website_office" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email_office">Email office</label>
                    <input type="text" id="email_offices" class="form-control" placeholder="email office's User"
                        aria-label="email office's User" name="email_office" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kode">Kode User</label>
                    <input type="text" id="kode" class="form-control" placeholder="Kode User"
                        aria-label="Kode" name="kode" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone</label>
                    <input type="text" id="phone" class="form-control" placeholder="phone"
                        aria-label="phone" name="phone" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="cabang">Cabang</label>
                    <input type="text" id="cabang" class="form-control" placeholder="cabang"
                        aria-label="cabang" name="cabang" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama_wilayah">Nama Wilayah</label>
                    <input type="text" id="nama_wilayah" class="form-control" placeholder="Wilayah"
                        aria-label="nama_wilayah" name="nama_wilayah" />
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="id_direct_supervisor">Atasan</label>
                    <select id="id_direct_supervisor" class="select2 form-select" name="id_direct_supervisor">
                        @foreach ($data['atasan'] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>                                                   
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>
