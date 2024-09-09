@extends('kerangka.master')

@section('title', 'Edit Profile')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Edit Account</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Profile</h5>
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT') <!-- Jika Anda menggunakan PUT untuk update -->
                        <label for="foto" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="foto"
                              name="foto"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label>
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input
                                class="form-control"
                                type="text"
                                id="firstName"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                autofocus
                            />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                                class="form-control"
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="john.doe@example.com"
                            />
                        </div>
                        {{-- <div class="mb-3 col-md-6">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input
                                class="form-control"
                                type="text"
                                id="phoneNumber"
                                name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                            />
                        </div> --}}
                        {{-- <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input
                                class="form-control"
                                type="text"
                                id="address"
                                name="address"
                                value="{{ old('address', $user->address) }}"
                            />
                        </div> --}}
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input
                                class="form-control"
                                type="password"
                                id="password"
                                name="password"
                            />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input
                                class="form-control"
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                            />
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                            {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
