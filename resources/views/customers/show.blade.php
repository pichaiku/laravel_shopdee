@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Customer' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('customers.customer.destroy', $customer->custID) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('customers.customer.index') }}" class="btn btn-primary" title="Show All Customer">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('customers.customer.create') }}" class="btn btn-success" title="Create New Customer">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('customers.customer.edit', $customer->custID ) }}" class="btn btn-primary" title="Edit Customer">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Customer" onclick="return confirm(&quot;Click Ok to delete Customer.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>First Name</dt>
            <dd>{{ $customer->firstName }}</dd>
            <dt>Last Name</dt>
            <dd>{{ $customer->lastName }}</dd>
            <dt>Address</dt>
            <dd>{{ $customer->address }}</dd>
            <dt>Subdistrict I D</dt>
            <dd>{{ $customer->subdistrictID }}</dd>
            <dt>Zipcode</dt>
            <dd>{{ $customer->zipcode }}</dd>
            <dt>Mobile Phone</dt>
            <dd>{{ $customer->mobilePhone }}</dd>
            <dt>Home Phone</dt>
            <dd>{{ $customer->homePhone }}</dd>
            <dt>Birthdate</dt>
            <dd>{{ $customer->birthdate }}</dd>
            <dt>Gender</dt>
            <dd>{{ $customer->gender }}</dd>
            <dt>Email</dt>
            <dd>{{ $customer->email }}</dd>
            <dt>Username</dt>
            <dd>{{ $customer->username }}</dd>
            <dt>Password</dt>
            <dd>{{ $customer->password }}</dd>
            <dt>Image File</dt>
            <dd>{{ $customer->imageFile }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($customer->isActive) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection