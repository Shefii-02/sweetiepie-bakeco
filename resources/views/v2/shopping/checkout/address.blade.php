<div class="row">
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="firstname" class="form-label">First Name<span class="text-danger">
                    *</span></label>
            <input placeholder="Enter your first name" type="text" autocomplete="off"
                class="form-control px-0 border-0 bg-white shadow-none" name="{{ $name }}_firstname"
                id="firstname" value="{{ old($name.'_firstname') }}">
            <span>
                {{ $errors->first('firstname') }}
            </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="lastname" class="form-label">Last Name</label>
            <input placeholder="Enter your last name" type="text" autocomplete="off"
                class="form-control px-0 border-0 bg-white shadow-none" value="{{ old($name.'_lastname') }}" name="{{ $name }}_lastname"
                id="lastname">
            <span>
                {{ $errors->first('lastname') }}
            </span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="address" class="form-label">Address<span class="text-danger">
                    *</span></label>
            <input placeholder="Enter your address" class="form-control address_fill px-0 border-0 bg-white shadow-none"
                autocomplete="off" value="{{ old($name.'_address') }}" name="{{ $name }}_address" id="address">
            <span>
                {{ $errors->first('address') }}
            </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="city" class="form-label">City<span class="text-danger">
                    *</span></label>
            <input  placeholder="Enter your city" type="text" autocomplete="off"
                class="form-control city_fill px-0 border-0 bg-white shadow-none"
                value="{{ old($name.'_city') }}" name="{{ $name }}_city" id="city">
            <span>
                {{ $errors->first('city') }}
            </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="postal_code" class="form-label">Postal Code<span
                    class="text-danger"> *</span></label>
            <input placeholder="Enter your province" type="text" autocomplete="off"
                maxlength="7"
                class="form-control postal_fill px-0 border-0 bg-white shadow-none"
                id="postal_code" value="{{ old($name.'_postal') }}" name="{{ $name }}_postal">
            <span>
                {{ $errors->first('postal') }}
            </span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="province" class="form-label">Province<span class="text-danger">
                    *</span></label>

            <select class="form-control province_fill px-0 border-0 bg-white shadow-none"
                name="{{ $name }}_province" id="province">
                <option value="">Select Province</option>
                @foreach ($provinces as $item)
                    <option  {{ old($name.'_province') == $item->name ? "selected" : '' }} value="{{ $item->name }}"
                        {{ $item->code == old('province') ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                @endforeach
            </select>
            <span>
                {{ $errors->first('province') }}
            </span>

        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
            <label for="phone" class="form-label">Phone<span
                    class="text-danger"> *</span></label>
            <input placeholder="Enter your phone" type="text" autocomplete="off"
                maxlength="7"
                class="form-control px-0 border-0 bg-white shadow-none"
                id="phone" value="{{ old($name.'_phone') }}" name="{{ $name }}_phone">
            <span>
                {{ $errors->first('phone') }}
            </span>
        </div>
    </div>
</div>