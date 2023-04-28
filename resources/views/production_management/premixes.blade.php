@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('content')
	<h3>Premixes</h3>
	<div>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Beginning</th>
                    <th scope="col">Micro</th>
                    <th scope="col">Macro</th>
                    <th scope="col">Ending</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">0</th>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    {{-- <td><button type="button" class="btn btn-warning">Update</button></td> --}}
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script>
		$.ajax({
			type: "GET",
			url: "{{ config('app.root_domain') . config('app.user_details_slug') . \Crypt::encryptString(Auth::user()->id) }}",
			dataType: 'json',
			success: function(response){
				document.getElementById('fullname').innerHTML = response['first_name'] + " " + response['last_name'];
				document.getElementById('email').innerHTML = response['email'];
			}
		});
	</script>
@endsection
