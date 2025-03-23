@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')

<x-alert type="success" />

    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="col-md-6">
            <x-form.input name="first_name" label="First Name" :value="$user->profile->first_name" required />
            </div>
            <div class="col-md-6">
            <x-form.input name="last_name" label="Last Name" :value="$user->profile->last_name" required />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
            <x-form.input type="date" name="birthday" label="Birthday" :value="$user->profile->birthday" />
            </div>
            <div class="col-md-6">
            <x-form.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
            <x-form.input name="street_adress" label="Street Address" :value="$user->profile->street_adress" />
            </div>
            <div class="col-md-4">
            <x-form.input name="city" label="City" :value="$user->profile->city" />
            </div>
            <div class="col-md-4">
            <x-form.input name="state" label="State" :value="$user->profile->state" />
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->profile->postal_code" />
            </div>
            <div class="col-md-4">
            <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile->country" />
            </div>
            <div class="col-md-4">
            <x-form.select name="locale" :options="$locales" label="Locale" :selected="$user->profile->locale" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary my-2">Save</button>
    </form>
@endsection