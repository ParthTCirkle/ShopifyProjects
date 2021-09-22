@extends('layouts.masterlayout')
@section('title','Shopify OAuth')
@section('content')
	<section>
		<div class="container" style="padding-top: 15%">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-6">
									<strong > Add Shop domain </strong>
								</div>
								<div class="col-md-6">
									{{-- <a href="#" class="btn btn-primary" style="float: right;"> All users</a> --}}
								</div>
							</div>
						</div>
						<div class="card-body">
							<form action="{{ route('createAuthentication') }}" method="POST" enctype='multipart/form-data'>
								@csrf
								<div class="mb-3">
									<label for="shopname" class="form-label">Shop Domain</label>
									<input type="text" class="form-control" name="shopname" placeholder="Enter Shop name" value=" {{old('shopname')}} ">
									@error('shopname') <span class="text-danger">{{$message}}</span> @enderror
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
