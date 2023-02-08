
<div class="form-group {{ $errors->has('firstName') ? 'has-error' : '' }}">
    <label for="firstName" class="col-md-2 control-label">First Name</label>
    <div class="col-md-10">
        <input class="form-control" name="firstName" type="text" id="firstName" value="{{ old('firstName', optional($customer)->firstName) }}" minlength="1" maxlength="100" required="true" placeholder="Enter first name here...">
        {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('lastName') ? 'has-error' : '' }}">
    <label for="lastName" class="col-md-2 control-label">Last Name</label>
    <div class="col-md-10">
        <input class="form-control" name="lastName" type="text" id="lastName" value="{{ old('lastName', optional($customer)->lastName) }}" minlength="1" maxlength="100" required="true" placeholder="Enter last name here...">
        {!! $errors->first('lastName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    <label for="address" class="col-md-2 control-label">Address</label>
    <div class="col-md-10">
        <input class="form-control" name="address" type="text" id="address" value="{{ old('address', optional($customer)->address) }}" maxlength="200" placeholder="Enter address here...">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('subdistrictID') ? 'has-error' : '' }}">
    <label for="subdistrictID" class="col-md-2 control-label">Subdistrict I D</label>
    <div class="col-md-10">
        <input class="form-control" name="subdistrictID" type="text" id="subdistrictID" value="{{ old('subdistrictID', optional($customer)->subdistrictID) }}" maxlength="6" placeholder="Enter subdistrict i d here...">
        {!! $errors->first('subdistrictID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
    <label for="zipcode" class="col-md-2 control-label">Zipcode</label>
    <div class="col-md-10">
        <input class="form-control" name="zipcode" type="text" id="zipcode" value="{{ old('zipcode', optional($customer)->zipcode) }}" maxlength="5" placeholder="Enter zipcode here...">
        {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('mobilePhone') ? 'has-error' : '' }}">
    <label for="mobilePhone" class="col-md-2 control-label">Mobile Phone</label>
    <div class="col-md-10">
        <input class="form-control" name="mobilePhone" type="text" id="mobilePhone" value="{{ old('mobilePhone', optional($customer)->mobilePhone) }}" maxlength="10" placeholder="Enter mobile phone here...">
        {!! $errors->first('mobilePhone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('homePhone') ? 'has-error' : '' }}">
    <label for="homePhone" class="col-md-2 control-label">Home Phone</label>
    <div class="col-md-10">
        <input class="form-control" name="homePhone" type="text" id="homePhone" value="{{ old('homePhone', optional($customer)->homePhone) }}" maxlength="9" placeholder="Enter home phone here...">
        {!! $errors->first('homePhone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
    <label for="birthdate" class="col-md-2 control-label">Birthdate</label>
    <div class="col-md-10">
        <input class="form-control" name="birthdate" type="text" id="birthdate" value="{{ old('birthdate', optional($customer)->birthdate) }}" placeholder="Enter birthdate here...">
        {!! $errors->first('birthdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
    <label for="gender" class="col-md-2 control-label">Gender</label>
    <div class="col-md-10">
        <input class="form-control" name="gender" type="text" id="gender" value="{{ old('gender', optional($customer)->gender) }}" min="0" placeholder="Enter gender here...">
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($customer)->email) }}" maxlength="200" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
    <label for="username" class="col-md-2 control-label">Username</label>
    <div class="col-md-10">
        <input class="form-control" name="username" type="text" id="username" value="{{ old('username', optional($customer)->username) }}" minlength="1" maxlength="100" required="true" placeholder="Enter username here...">
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="text" id="password" value="{{ old('password', optional($customer)->password) }}" minlength="1" maxlength="100" required="true" placeholder="Enter password here...">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('imageFile') ? 'has-error' : '' }}">
    <label for="imageFile" class="col-md-2 control-label">Image File</label>
    <div class="col-md-10">
        <input class="form-control" name="imageFile" type="text" id="imageFile" value="{{ old('imageFile', optional($customer)->imageFile) }}" min="0" max="200" placeholder="Enter image file here...">
        {!! $errors->first('imageFile', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('isActive') ? 'has-error' : '' }}">
    <label for="isActive" class="col-md-2 control-label">Is Active</label>
    <div class="col-md-10">
        <div class="checkbox">
            <label for="isActive_1">
            	<input id="isActive_1" class="" name="isActive" type="checkbox" value="1" {{ old('isActive', optional($customer)->isActive) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('isActive', '<p class="help-block">:message</p>') !!}
    </div>
</div>

