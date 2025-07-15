@extends('app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="bg-primary text-white mb-3 p-3 rounded">
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center">
                <div class="flex-shrink-0 mx-sm-0 mx-auto">
                    @if (Auth::user()->compId == 1)
                    <img src="/assets/img/front-pages/branding/logo_mlm.png" height="140" alt="logo_mlm" />
                    @elseif (Auth::user()->compId == 2)
                    <img src="/assets/img/front-pages/branding/logo_adk.png" height="140" alt="logo_adk" />
                    @elseif (Auth::user()->compId == 0)
                    <img src="/assets/img/illustrations/card-advance-sale.png" height="140" alt="all_company" />
                    @endif
                </div>
                <div class="flex-grow-1 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h2 class=" text-white text-3xl">{{$data['profile']->name}}</h2>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-settings"></i> {{$data['profile']->rolesName ?? '-' }}
                                </li>
                            </ul>
                        </div>
                        @if($data['profile']->userStatus == "Active")
                        <span class="badge rounded-pill bg-label-success">
                            <i class="ti ti-check me-1"></i> Active
                        </span>
                        @else ($data['profile']->userStatus == "Inactive")
                        <span class="badge bg-label-danger">
                            <i class="ti ti-x me-1"></i> Inactive
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card shadow-none bg-transparent border border-info mb-3">
            <div class="card-body">
                <div class="text-center text-uppercase card-text">
                    <span class="badge rounded-pill bg-label-info  ">
                        <i class="ti ti-user-circle me-1"></i> About
                    </span>
                </div>
                <hr>
                <ul class="list-unstyled mb-4 mt-3">
                    @if (Auth::user()->role > 4)
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-pin text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Code : </span>
                        <span>{{$data['profile']->spCode ?? '-' }}</span>
                    </li>
                    @endif
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user-check text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Full Name : </span>
                        <span>{{$data['profile']->name ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-id-badge text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">NIK : </span>
                        <span>{{$data['profile']->upNIK ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Gender : </span>
                        <span>{{$data['profile']->upGender ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-check text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Status : </span>
                        <span>{{$data['profile']->userStatus ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-crown text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Role : </span>
                        <span>{{$data['profile']->rolesName ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-flag text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Company : </span>
                        <span>{{$data['profile']->companyName ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map text-heading"></i>
                        <span class="fw-medium mx-2 text-heading">Area : </span>
                        <span>{{$data['profile']->companyArea ?? '-' }}</span>
                    </li>
                </ul>
                <!-- This is where the Change Password card used to be -->
                <button id="openPasswordModalBtn"class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-4">
                        Edit Password
                </button>
            </div>
        </div>
    </div>
   
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card shadow-none bg-transparent border border-warning mb-3">
            <div class="card-body">
                <div class="text-center text-uppercase card-text">
                    <span class="badge rounded-pill bg-label-info  ">
                        <i class="ti ti-id-badge me-1"></i> Contact
                    </span>
                </div>
                <hr>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-phone-call"></i>
                        <span class="fw-medium mx-2 text-heading">Phone : </span>
                        <span>
                            @if (in_array(auth()->user()->role, [5,6,7]))
                            {{$data['profile']->spPhone ?? '-' }}
                            @else
                            {{$data['profile']->upPhone ?? '-' }}
                            @endif
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin"></i>
                        <span class="fw-medium mx-2 text-heading">Office Address : </span>
                        <span>{{$data['profile']->address_office ?? '-' }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email : </span>
                        <span>{{$data['profile']->email ?? '-' }}</span>
                    </li>
                </ul>
                
                <div class="text-center text-uppercase card-text">
                    <span class="badge rounded-pill bg-label-info  ">
                        <i class="ti ti-color-swatch me-1"></i> Quotation
                    </span>
                </div>
                <hr>
                <!-- Submited Quotation -->
                <ul class="list-unstyled mb-0">
                    @if (in_array(auth()->user()->role, [1,2,3]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-file"></i><span class="fw-medium mx-2">Quotation Submitted :</span>
                        <span>{{$data['quotationSubmitted']->count()}}</span>
                    </li>
                    @elseif (auth()->user()->role == 4)
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-file"></i><span class="fw-medium mx-2">Quotation Submitted :</span>
                        <span>{{$data['quotationCompanySubmitted']->count()}}</span>
                    </li>
                    @elseif (in_array(auth()->user()->role, [5,6,7]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-file"></i><span class="fw-medium mx-2">Quotation Submitted :</span>
                        <span>{{$data['quotationSalesSubmitted']->count()}}</span>
                    </li>
                    @endif

                    <!-- On Process Quotation -->
                    @if (in_array(auth()->user()->role, [1,2,3]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-edit"></i><span class="fw-medium mx-2">Quotation On Process :</span>
                        <span>{{$data['quotationOnProcess']->count()}}</span>
                    </li>
                    @elseif (auth()->user()->role == 4)
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-edit"></i><span class="fw-medium mx-2">Quotation On Process :</span>
                        <span>{{$data['quotationCompanyOnProcess']->count()}}</span>
                    </li>
                    @elseif (in_array(auth()->user()->role, [5,6,7]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-edit"></i><span class="fw-medium mx-2">Quotation On Process :</span>
                        <span>{{$data['quotationSalesOnProcess']->count()}}</span>
                    </li>
                    @endif

                    <!-- Done Quotation -->
                    @if (in_array(auth()->user()->role, [1,2,3]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-check"></i><span class="fw-medium mx-2">Quotation Done :</span>
                        <span>{{$data['quotationDone']->count()}}</span>
                    </li>
                    @elseif (auth()->user()->role == 4)
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-check"></i><span class="fw-medium mx-2">Quotation Done :</span>
                        <span>{{$data['quotationCompanyDone']->count()}}</span>
                    </li>
                    @elseif (in_array(auth()->user()->role, [5,6,7]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-check"></i><span class="fw-medium mx-2">Quotation Done :</span>
                        <span>{{$data['quotationSalesDone']->count()}}</span>
                    </li>
                    @endif

                    <!-- Canceled Quotation -->
                    @if (in_array(auth()->user()->role, [1,2,3]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-x"></i><span class="fw-medium mx-2">Quotation Canceled :</span>
                        <span>{{$data['quotationCanceled']->count()}}</span>
                    </li>
                    @elseif (auth()->user()->role == 4)
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-x"></i><span class="fw-medium mx-2">Quotation Canceled :</span>
                        <span>{{$data['quotationCompanyCanceled']->count()}}</span>
                    </li>
                    @elseif (in_array(auth()->user()->role, [5,6,7]))
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-x"></i><span class="fw-medium mx-2">Quotation Canceled :</span>
                        <span>{{$data['quotationSalesCanceled']->count()}}</span>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <h5 class="card-header">User Location</h5>
            <div class="card-body">
                <div class="leaflet-map" id="userLocation"></div>
            </div>
        </div>
    </div>
</div>
<!-- Tailwind CSS Modal Structure -->
<div id="editPasswordModal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300 opacity-0 pointer-events-none">
    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl mx-auto p-0 transform transition-transform duration-300 scale-95">
        <!-- Modal Header -->
        <div class="flex justify-between items-center bg-gray-50 p-4 border-b border-gray-200 rounded-t-lg">
            <h5 class="text-xl font-semibold text-gray-800">Change Password</h5>
            <button id="closePasswordModalBtn"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full p-1 transition duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Modal Body (Original Change Password Card Content) -->
        <div class="p-6">
            <div class="bg-yellow-100 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg relative mb-6">
                <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
                <span class="block sm:inline">Minimum 8 characters long</span>
            </div>
            {{-- The form will submit normally, causing a page reload --}}
            <form id="formChangePassword" action="{{ url('/updatePassword?id='.$data['profile']->id) }}" method="POST">
                @csrf {{-- Laravel will inject the CSRF token here --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="newPassword">New Password</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent pr-10"
                                type="password" id="newPassword" name="newPassword"
                                placeholder="••••••••••••" required minlength="8" autocomplete="new-password" />
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 cursor-pointer" onclick="togglePasswordVisibility('newPassword', this)">
                                {{-- Eye icon SVG --}}
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">Confirm New Password</label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent pr-10"
                                type="password" name="confirmPassword" id="confirmPassword"
                                placeholder="••••••••••••" required minlength="8" autocomplete="new-password" />
                            <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 cursor-pointer" onclick="togglePasswordVisibility('confirmPassword', this)">
                                {{-- Eye icon SVG --}}
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200 mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset ('/assets/js/maps-leaflet.js')}}"></script>

<!-- Tailwind Modal JavaScript -->
<script>
    const openPasswordModalBtn = document.getElementById('openPasswordModalBtn');
    const editPasswordModal = document.getElementById('editPasswordModal');
    const closePasswordModalBtn = document.getElementById('closePasswordModalBtn');
    const newPasswordInput = document.getElementById('newPassword'); // Get reference for initial focus

    // Function to open the modal
    function openModal() {
        editPasswordModal.classList.remove('opacity-0', 'pointer-events-none'); // Make visible and interactive
        editPasswordModal.classList.add('opacity-100', 'pointer-events-auto');
        document.body.style.overflow = 'hidden'; // Prevent scrolling on body when modal is open
        newPasswordInput.focus(); // Focus the first input field for better UX
    }

    // Function to close the modal
    function closeModal() {
        editPasswordModal.classList.remove('opacity-100', 'pointer-events-auto'); // Make invisible and non-interactive
        editPasswordModal.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = ''; // Restore body scrolling
        openPasswordModalBtn.focus(); // Return focus to the button that opened it for accessibility
    }

    // Event listener to open the modal when the button is clicked
    openPasswordModalBtn.addEventListener('click', openModal);

    // Event listener to close the modal using the 'X' (close) button
    closePasswordModalBtn.addEventListener('click', closeModal);

    // Event listener to close the modal when clicking outside the modal content
    // This ensures clicks *inside* the modal content (like input fields) do NOT close it.
    editPasswordModal.addEventListener('click', (event) => {
        if (event.target === editPasswordModal) {
            closeModal();
        }
    });

    // Event listener to close the modal when the Escape key is pressed
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && editPasswordModal.classList.contains('opacity-100')) {
            closeModal();
        }
    });

    // Function to toggle password input visibility (show/hide password text)
    function togglePasswordVisibility(fieldId, iconElement) {
        const passwordField = document.getElementById(fieldId);
        // Get the actual SVG icon element
        const icon = iconElement.querySelector('svg');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            // Change the SVG path to represent an "open eye" icon
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.06 12c.5-1.5 3.3-6 11.94-6 8.64 0 11.44 4.5 11.94 6-1.12 3.6-4.66 6-11.94 6-7.28 0-10.82-2.4-11.94-6z"></path>`;
        } else {
            passwordField.type = 'password';
            // Change the SVG path to represent a "closed eye" icon
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
        }
    }
</script>

@endsection
