<!--/ add new card modal  -->
<div class="modal" id="addUser" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="submit_form" action="{{ url('panel/add-user') }}" enctype='multipart/form-data'
                    method="POST">
                    @csrf
                    {{-- <input type="hidden" value="{{ $role->id }}" name="user_role" id="role_id"> --}}
                    <input type="hidden" value="0" name="user_id" id="user_id">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="logo-content">
                                <a href="#">
                                    <div id="img_div">
                                        <img id="favicon" alt="your image"
                                            src="{{ asset('images/avatars/male.png') }}" class="big-logo" height="100"
                                            width="100">
                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <label for="role" class="ml-3">User Status</label>
                            <br>
                            <br>
                            <div class="form-check-success form-check-inline mr-3">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                    value="1" checked />
                                <label class="form-check-label" for="inlineRadio1">Active</label>
                            </div>
                            <br>
                            <br>
                            <div class="form-check-success form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                    value="0" />
                                <label class="form-check-label" for="inlineRadio2">Banned</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="logo"> Choose file here
                                <input type="file" name="avatar" id="logo" class="form-control file"
                                    data-filename="edit-logo" accept=".jpeg,.jpg,.png"
                                    onchange="document.getElementById('favicon').src = window.URL.createObjectURL(this.files[0])"
                                    style="width: 366px;">
                            </label>
                        </div>

                        <div class="col">
                            <label for="admin">User</label>
                            <input type="text" class="form-control" id="user_role" value="{{ $role }}"
                                name="user_role" readonly="true">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="First Name">
                        </div>

                        <div class="col">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="email">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name"
                                placeholder="User Name">
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Phone Number">
                        </div>
                        {{-- <div class="col">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Address">
                        </div> --}}

                        <div class="col">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                placeholder="Address">
                        </div>
                    </div>

                    <div class="row mb-2 {{ $role == 'employee' ? '' : 'd-none' }} " id="salary">
                        <div class="col ">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary"
                                placeholder="salary">
                        </div>
                        <div class="col">
                            <label for="salarytype">Salary Type</label>
                            <input type="text" class="form-control" id="salary_type" name="salary_type"
                                placeholder="Salary Type">
                        </div>
                    </div>
                    <div class="row mb-2">

                        <div class="col">
                            <label for="recipient-name">@lang('Select Country')</label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="recipient-name">@lang('Select State')</label>
                            <select class="form-control type" id="state" name="state" required>
                                <option value="">Select State</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="recipient-name">@lang('Select City')</label>
                            <select class="form-control type" id="city" name="city">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        @if ($role == 'customer')
                            <div class="col">
                                <label for="recipient-name">@lang('Assign Trainer')</label>
                                <select class="form-control " id="user_trainer" name="user_trainer">
                                    <option value="">Assign Trainer</option>
                                    @foreach ($employe as $value)
                                        <option value="{{ @$value->employee->id }}">{{ @$value->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="col">
                                <label for="recipient-name">@lang('Role')</label>
                                <select class="form-control type" id="check_role" name="check_role" required>
                                    <option value="">Select Role</option>
                                    @foreach ($role_data as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    {{-- @if ($role == 'customer')
                        <div class="row mb-2">

                            <div class="col">
                                <label for="recipient-name">@lang('Select Country')</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Count</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="recipient-name">@lang('Select State')</label>
                                <select class="form-control type" id="state" name="state" required>
                                    <option value="">Select State</option>

                                </select>
                            </div>
                        </div>
                    @else --}}
                    {{-- <div class="row mb-2">

                            <div class="col">
                                <label for="recipient-name">@lang('Select Country')</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Count</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="recipient-name">@lang('Select State')</label>
                                <select class="form-control type" id="state" name="state" required>
                                    <option value="">Select State</option>

                                </select>
                            </div>
                        </div> --}}
                    @if ($role != 'customer')
                        <div class="row mb-2">
                            <div class="col">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="col">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    @endif


                    @if ($role == 'customer')
                        <div class="row mb-2">
                            {{-- <div class="col">
                                <label for="recipient-name">@lang('Raferral')</label>
                                <select class="form-control " id="user_referral" name="user_referral">
                                    <option value="">Referral</option>
                                    @foreach ($users as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['first_name'] }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col">
                                <label for="confirm-password">Service</label>
                                {{-- <input type="text" class="form-control" id="service" name="service"
                                    placeholder="Service"> --}}
                                    @php($service = App\Models\Service::get())
                                    <select class="form-control type" id="service" name="service" required>
                                        <option value="">Select Role</option>
                                        @foreach ($service as $value)
                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="row mb-2">

                            <div class="col-12">
                                <label for="confirm-password">Notes</label>
                                <textarea class="form-control" id="notes" name="notes"></textarea>
                            </div>
                        </div>
                    @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                <button type="submit" type="button" class="btn btn-success">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
