@extends('layouts.layout')
@section('title',"User Dashboard")
@section('content')

@php
 $user = Session::get('uid');
@endphp
<table class="table table-striped">
<thead>
    <tr>
      <th scope="col">Full Name</th>
      <th scope="col">Email Address</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Gender</th>
      <th scope="col">Country</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{$user->name}}</th>
      <td>{{$user->email}}</td>
      <td>{{$user->dob}}</td>
      @if($user->gender == "F")
      <td>Female</td>
      @elseif($user->gender == "M")
      <td>Male</td>
      @else
      <td>Other</td>
      @endif
      <td>{{$user->getcountry->country_name}}</td>
      <td>{{$user->getstate->state_name}}</td>
      <td>{{$user->getcity->city_name}}</td>
    </tr>
  </tbody>
</table>
@endsection