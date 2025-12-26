@extends('institute.layout')

@section('content')
{{-- <div class="container mt-4">
    <h3>Institute Profile</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ auth('institute')->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth('institute')->user()->email }}</p>
            <p><strong>Status:</strong>
                @if(auth('institute')->user()->is_active === 'Y')
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </p>
        </div>
    </div>
</div> --}}
  <div class="dashboardDtlsArea">

    {{-- <div class="card-body">
            <p><strong>Name:</strong> {{ auth('institute')->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth('institute')->user()->email }}</p>
            <p><strong>Status:</strong>
                @if(auth('institute')->user()->is_active === 'Y')
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </p>
        </div> --}}
                    <div class="container-fluid">
                        <div class="dashboardBreadCumBarBar">
                            <div class="d-flex justify-content-between align-items-center dashboardBreadCumBarBarinner">
                                <div class="leftPart">
                                    <h4 class="mb-0 font-16 page-title">Profile Settings</h4>
                                </div>

                            </div>
                        </div>



                        <div class="dashboardDtlsAreainner mb-3">
                            <div class="dashboaradPanelBody">
                                <div class="profile-box">
                                    <div class="profile-box-top">
                                        <h3>Recent Transactions</h3>
                                        <p>Update your account's profile information and email address</p>
                                    </div>
                                    <div class="profile-box-bottom">
                                        <div class="profile-image-sec">
                                            <div class="profile">
                                                <img src="images/avatar.png" alt="" class="profile-pic">
                                            </div>
                                            <div class="profile-btn-sec">
                                                <button class="user-edit-btn">
                                                    <i class="fa-regular fa-camera"></i>
                                                    <input class="file-upload" type="file" accept="image/*">
                                                    <span>Change Avatar</span>
                                                </button>
                                                <p>JPG, PNG, GIF up to 2MB</p>
                                            </div>
                                        </div>
                                        <div class="profile-input">
                                            <label for="">Name</label>
                                            <input type="text" placeholder="Full name">
                                        </div>
                                        <div class="profile-input">
                                            <label for="">Email</label>
                                            <input type="email" placeholder="Email address">
                                        </div>
                                        <div class="profile-btn-sec p-0">
                                            <button class="save-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboardDtlsAreainner mb-3">
                            <div class="dashboaradPanelBody">
                                <div class="profile-box">
                                    <div class="profile-box-top">
                                        <h3>Update Password</h3>
                                        <p>Ensure your account is using a long, random password to stay secure</p>
                                    </div>
                                    <div class="profile-box-bottom">
                                        <div class="profile-input">
                                            <label for="">Current password</label>
                                            <input type="password" placeholder="Current password">
                                        </div>
                                        <div class="profile-input">
                                            <label for="">New password</label>
                                            <input type="password" placeholder="New password">
                                        </div>
                                        <div class="profile-input">
                                            <label for="">Confirm password</label>
                                            <input type="password" placeholder="Confirm password">
                                        </div>
                                        <div class="profile-btn-sec p-0">
                                            <button class="save-btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5"></div>
                    </div>
                </div>


@endsection
