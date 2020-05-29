@extends('layouts.user_dash')

@section('content')
<div class="column is-media-margin-l cf">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
        <p class="is-size-4">Edit User</p>
        <small>Edit User</small>
      </div>
      @include('partials.massages') 
    </div>

    <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">
 
            <form class="columns is-multiline is-mobile is-desktop is-tablet" method="POST" action="{{ route('profile.update', $user->id) }}" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}          
                    {{ method_field('PUT') }} 
                        <div class="column is-8-desktop is-8-tablet is-offset-2-tablet is-offset-2-desktop is-12-mobile p-t-20"> 

                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">First Name</label>
                                <?php  $first_name = $user->profile['first_name']  ? $user->profile['first_name'] : old('first_name') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="first_name"
                                            value="{{$first_name}}"
                                            class="input {{ $errors->has('first_name') ? ' is-danger' : '' }}"
                                            id="first_name"
                                            placeholder="first name"
                                            required autofocus>
                                </div>
                                @if ($errors->has('first_name'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Last Name</label>
                                <?php  $last_name = $user->profile['last_name']  ? $user->profile['last_name'] : old('last_name') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="last_name"
                                            value="{{$last_name}}"
                                            class="input {{ $errors->has('last_name') ? ' is-danger' : '' }}"
                                            id="last_name"
                                            placeholder="last_name"
                                            required autofocus>
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">About Me</label>
                                <?php  $about_me = $user->profile['about_me']  ? $user->profile['about_me'] : old('about_me') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <textarea type="textarea"
                                            name="about_me" 
                                            class="textarea {{ $errors->has('about_me') ? ' is-danger' : '' }}"
                                            id="about_me" 
                                            required autofocus>{{$about_me}}</textarea>
                                </div>
                                @if ($errors->has('about_me'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('about_me') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <?php  $image = $user->profile['image']  ? $user->profile['image'] : ''; ?>
                                <div class="user-pic border-round" style="background-image: url('/storage/profile/{{$image}}');" alt="image"></div>
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">profile picture</label>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="file"
                                            name="image" 
                                            class="file {{ $errors->has('image') ? ' is-danger' : '' }}"
                                            id="image"
                                            placeholder="image"
                                            required autofocus>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">                              
                                <?php  $banner = $user->profile['banner']  ? $user->profile['banner'] : ''; ?>
                                <div class="user-pic" style="background-image: url('/storage/profile/{{$banner}}');" alt="image"></div>
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">banner image</label>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="file"
                                            name="banner" 
                                            class="file {{ $errors->has('banner') ? ' is-danger' : '' }}"
                                            id="banner"
                                            placeholder="banner"
                                            required autofocus>
                                </div>
                                @if ($errors->has('banner'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('banner') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">birthday</label>
                                <?php  $birthday = $user->profile['birthday']  ? $user->profile['birthday'] :  old('birthday') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="date"
                                            name="birthday" 
                                            class="input {{ $errors->has('birthday') ? ' is-danger' : '' }}"
                                            id="birthday"
                                            placeholder="birthday"
                                            value="{{$birthday}}"
                                            required autofocus>
                                </div>
                                @if ($errors->has('birthday'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Number</label>
                                <?php  $housenumber = $user->profile['housenumber']  ? $user->profile['housenumber'] : old('housenumber') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="housenumber"
                                            value="{{$housenumber}}"
                                            class="input {{ $errors->has('housenumber') ? ' is-danger' : '' }}"
                                            id="housenumber"
                                            placeholder="house number"
                                            required autofocus>
                                </div>
                                @if ($errors->has('housenumber'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('housenumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Addressline1</label>
                                <?php  $addressline1 = $user->profile['addressline1']  ? $user->profile['addressline1'] : old('addressline1') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="addressline1"
                                            value="{{$addressline1}}"
                                            class="input {{ $errors->has('addressline1') ? ' is-danger' : '' }}"
                                            id="addressline1"
                                            placeholder="addressline1"
                                            required autofocus>
                                </div>
                                @if ($errors->has('addressline1'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('addressline1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Addressline2</label>
                                <?php  $addressline2 = $user->profile['addressline2']  ? $user->profile['addressline2'] : old('addressline2') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="addressline2"
                                            value="{{$addressline2}}"
                                            class="input {{ $errors->has('addressline2') ? ' is-danger' : '' }}"
                                            id="addressline2"
                                            placeholder="addressline2"
                                            required autofocus>
                                </div>
                                @if ($errors->has('addressline2'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('addressline2') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Postal Code</label>
                                <?php  $postcode = $user->profile['postcode']  ? $user->profile['postcode'] : old('postcode') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="postcode"
                                            value="{{$postcode}}"
                                            class="input {{ $errors->has('postcode') ? ' is-danger' : '' }}"
                                            id="postcode"
                                            placeholder="postcode"
                                            autofocus>
                                </div>
                                <span v-if="isValid" class="help is-danger">This is not a valid Postal Code</span>
                                @if ($errors->has('postcode'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">city</label>
                                <?php  $city = $user->profile['city']  ? $user->profile['city'] : old('city') ?>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="city"
                                            value="{{$city}}"
                                            class="input {{ $errors->has('city') ? ' is-danger' : '' }}"
                                            id="city"
                                            placeholder="city"
                                            required autofocus>
                                </div>
                                @if ($errors->has('city'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <?php  $country = $user->profile['country']  ? $user->profile['country'] : old('country') ?>
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Country</label>
                                <div class="control select column is-12-desktop p-t-0"> 
                                    <select name="country"
                                            value="{{$country}}"
                                            class="is-multiple {{ $errors->has('country') ? ' is-danger' : '' }}"
                                            id="select"
                                            style="width: 100%;">
                                            @if(Config::get('rulevalidation'))
                                                @foreach(Config::get('rulevalidation')['all'] as $countrie ) 
                                                    <option class="option" <?php if ($countrie->code == $country ) echo 'selected' ; ?> value="{{$countrie->code}}">{{$countrie->name}}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                </div>
                                @if ($errors->has('country'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="field p-t-0 p-b-40">
                                <div class="control">
                                    <button type="submit" class="button is-primary round-btn">Save changes <i class="fa fa-save m-l-10"></i></button>
                                </div>
                            </div>
                        </div> 
            </form> 
    </div>  
</div>

@endsection 

@section('scripts')

    <script>
        var app = new Vue({
            el: '#app',
            data: { 
                isvalidatePostal: false,
                isValid: false,
                postalCode: '',
                selectedCountry: '',
                postalReg: {"AF":["\/^\\d\\d\\d\\d$\/"],"AX":["\/^\\d\\d\\d\\d\\d$\/","\/^AX-\\d\\d\\d\\d\\d$\/"],"AL":["\/^\\d\\d\\d\\d$\/"],"DZ":["\/^\\d\\d\\d\\d\\d$\/"],"AS":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"AD":["\/^AD\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"AO":[],"AI":["\/^AI-2640$\/"],"AQ":["\/^BIQQ 1ZZ$\/"],"AG":[],"AR":["\/^\\d\\d\\d\\d$\/","\/^[a-zA-Z]\\d\\d\\d\\d[a-zA-Z][a-zA-Z][a-zA-Z]$\/"],"AM":["\/^\\d\\d\\d\\d$\/"],"AW":[],"AU":["\/^\\d\\d\\d\\d$\/"],"AT":["\/^\\d\\d\\d\\d$\/"],"AZ":["\/^AZ \\d\\d\\d\\d$\/"],"BS":[],"BH":["\/^\\d\\d\\d$\/","\/^\\d\\d\\d\\d$\/"],"BD":["\/^\\d\\d\\d\\d$\/"],"BB":["\/^BB\\d\\d\\d\\d\\d$\/"],"BY":["\/^\\d\\d\\d\\d\\d\\d$\/"],"BE":["\/^\\d\\d\\d\\d$\/"],"BZ":[],"BJ":[],"BM":["\/^[a-zA-Z][a-zA-Z] \\d\\d$\/","\/^[a-zA-Z][a-zA-Z] [a-zA-Z][a-zA-Z]$\/"],"BT":["\/^\\d\\d\\d\\d\\d$\/"],"BO":[],"BA":["\/^\\d\\d\\d\\d\\d$\/"],"BW":[],"BR":["\/^\\d\\d\\d\\d\\d-\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"IO":["\/^BBND 1ZZ$\/"],"BN":["\/^[a-zA-Z][a-zA-Z]\\d\\d\\d\\d$\/"],"BG":["\/^\\d\\d\\d\\d$\/"],"BF":[],"BI":[],"KH":["\/^\\d\\d\\d\\d\\d$\/"],"CM":[],"CA":["\/^[a-zA-Z]\\d[a-zA-Z] \\d[a-zA-Z]\\d$\/"],"CV":["\/^\\d\\d\\d\\d$\/"],"KY":["\/^KY\\d-\\d\\d\\d\\d$\/"],"CF":[],"TD":[],"CL":["\/^\\d\\d\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d-\\d\\d\\d\\d$\/"],"CN":["\/^\\d\\d\\d\\d\\d\\d$\/"],"CX":["\/^\\d\\d\\d\\d$\/"],"CC":["\/^\\d\\d\\d\\d$\/"],"CO":["\/^\\d\\d\\d\\d\\d\\d$\/"],"KM":[],"CG":[],"CD":[],"CK":[],"CR":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"CI":[],"HR":["\/^\\d\\d\\d\\d\\d$\/"],"CU":["\/^\\d\\d\\d\\d\\d$\/"],"CY":["\/^\\d\\d\\d\\d$\/"],"CZ":["\/^\\d\\d\\d \\d\\d$\/"],"DK":["\/^\\d\\d\\d\\d$\/"],"DJ":[],"DM":[],"DO":["\/^\\d\\d\\d\\d\\d$\/"],"EC":["\/^\\d\\d\\d\\d\\d\\d$\/"],"EG":["\/^\\d\\d\\d\\d\\d$\/"],"SV":["\/^\\d\\d\\d\\d$\/"],"GQ":[],"ER":[],"EE":["\/^\\d\\d\\d\\d\\d$\/"],"ET":["\/^\\d\\d\\d\\d$\/"],"FK":["\/^FIQQ 1ZZ$\/"],"FO":["\/^\\d\\d\\d$\/"],"FJ":[],"FI":["\/^\\d\\d\\d\\d\\d$\/"],"FR":["\/^\\d\\d\\d\\d\\d$\/"],"GF":["\/^973\\d\\d$\/"],"PF":["\/^987\\d\\d$\/"],"GA":[],"GM":[],"GE":["\/^\\d\\d\\d\\d$\/"],"DE":["\/^\\d\\d\\d\\d\\d$\/"],"GH":[],"GI":["\/^GX11 1AA$\/"],"GR":["\/^\\d\\d\\d \\d\\d$\/"],"GL":["\/^\\d\\d\\d\\d$\/"],"GD":[],"GP":["\/^971\\d\\d$\/"],"GU":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"GT":["\/^\\d\\d\\d\\d\\d$\/"],"GG":["\/^GY\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^GY\\d\\d \\d[a-zA-Z][a-zA-Z]$\/"],"GN":["\/^\\d\\d\\d$\/"],"GW":["\/^\\d\\d\\d\\d$\/"],"GY":[],"HT":["\/^\\d\\d\\d\\d$\/"],"VA":["\/^00120$\/"],"HN":["\/^[a-zA-Z][a-zA-Z]\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"HK":[],"HU":["\/^\\d\\d\\d\\d$\/"],"IS":["\/^\\d\\d\\d$\/"],"IN":["\/^\\d\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d \\d\\d\\d$\/"],"ID":["\/^\\d\\d\\d\\d\\d$\/"],"IR":["\/^\\d\\d\\d\\d\\d\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d\\d$\/"],"IQ":["\/^\\d\\d\\d\\d\\d$\/"],"IE":["\/^[a-zA-Z][a-zA-Z0-9][a-zA-Z0-9] [a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9][a-zA-Z0-9]$\/"],"IM":["\/^IM\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^IM\\d\\d \\d[a-zA-Z][a-zA-Z]$\/"],"IL":["\/^\\d\\d\\d\\d\\d\\d\\d$\/"],"IT":["\/^\\d\\d\\d\\d\\d$\/"],"JM":["\/^\\d\\d$\/"],"JP":["\/^\\d\\d\\d-\\d\\d\\d\\d$\/","\/^\\d\\d\\d$\/"],"JE":["\/^JE\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^JE\\d\\d \\d[a-zA-Z][a-zA-Z]$\/"],"JO":["\/^\\d\\d\\d\\d\\d$\/"],"KZ":["\/^\\d\\d\\d\\d\\d\\d$\/"],"KE":["\/^\\d\\d\\d\\d\\d$\/"],"KI":[],"KP":[],"KR":["\/^\\d\\d\\d-\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"KW":["\/^\\d\\d\\d\\d\\d$\/"],"KG":["\/^\\d\\d\\d\\d\\d\\d$\/"],"LA":["\/^\\d\\d\\d\\d\\d$\/"],"LV":["\/^LV-\\d\\d\\d\\d$\/"],"LB":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d \\d\\d\\d\\d$\/"],"LS":["\/^\\d\\d\\d$\/"],"LR":["\/^\\d\\d\\d\\d$\/"],"LY":[],"LI":["\/^\\d\\d\\d\\d$\/"],"LT":["\/^LT-\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"LU":["\/^\\d\\d\\d\\d$\/"],"MO":[],"MK":["\/^\\d\\d\\d\\d$\/"],"MG":["\/^\\d\\d\\d$\/"],"MW":[],"MY":["\/^\\d\\d\\d\\d\\d$\/"],"MV":["\/^\\d\\d\\d\\d\\d$\/"],"ML":[],"MT":["\/^[a-zA-Z][a-zA-Z][a-zA-Z] \\d\\d\\d\\d$\/"],"MH":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"MQ":["\/^972\\d\\d$\/"],"MR":[],"MU":["\/^\\d\\d\\d\\d\\d$\/"],"YT":["\/^976\\d\\d$\/"],"MX":["\/^\\d\\d\\d\\d\\d$\/"],"FM":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"MD":["\/^MD\\d\\d\\d\\d$\/","\/^MD-\\d\\d\\d\\d$\/"],"MC":["\/^980\\d\\d$\/"],"MN":["\/^\\d\\d\\d\\d\\d$\/"],"ME":["\/^\\d\\d\\d\\d\\d$\/"],"MS":[],"MA":["\/^\\d\\d\\d\\d\\d$\/"],"MZ":["\/^\\d\\d\\d\\d$\/"],"MM":["\/^\\d\\d\\d\\d\\d$\/"],"NA":[],"NR":[],"NP":["\/^\\d\\d\\d\\d\\d$\/"],"NL":["\/^\\d\\d\\d\\d[a-zA-Z][a-zA-Z]$\/","\/^\\d\\d\\d\\d [a-zA-Z][a-zA-Z]$\/"],"AN":[],"NC":["\/^988\\d\\d$\/"],"NZ":["\/^\\d\\d\\d\\d$\/"],"NI":["\/^\\d\\d\\d\\d\\d$\/"],"NE":["\/^\\d\\d\\d\\d$\/"],"NG":["\/^\\d\\d\\d\\d\\d\\d$\/"],"NU":[],"NF":["\/^\\d\\d\\d\\d$\/"],"MP":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"NO":["\/^\\d\\d\\d\\d$\/"],"OM":["\/^\\d\\d\\d\\d$\/"],"PK":["\/^\\d\\d\\d\\d\\d$\/"],"PW":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"PS":["\/^\\d\\d\\d$\/"],"PA":["\/^\\d\\d\\d\\d$\/"],"PG":["\/^\\d\\d\\d$\/"],"PY":["\/^\\d\\d\\d$\/"],"PE":["\/^\\d\\d\\d\\d\\d$\/","\/^PE \\d\\d\\d\\d\\d$\/"],"PH":["\/^\\d\\d\\d\\d$\/"],"PN":["\/^PCRN 1ZZ$\/"],"PL":["\/^\\d\\d-\\d\\d\\d$\/"],"PT":["\/^\\d\\d\\d\\d-\\d\\d\\d$\/"],"PR":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"QA":[],"RO":["\/^\\d\\d\\d\\d\\d\\d$\/"],"RE":["\/^974\\d\\d$\/"],"RU":["\/^\\d\\d\\d\\d\\d\\d$\/"],"RW":[],"BL":["\/^\\d\\d\\d\\d\\d$\/"],"SH":["\/^[a-zA-Z][a-zA-Z][a-zA-Z][a-zA-Z] 1ZZ$\/"],"KN":[],"LC":["\/^LC\\d\\d \\d\\d\\d$\/"],"MF":["\/^97150$\/"],"PM":["\/^97500$\/"],"VC":["\/^VC\\d\\d\\d\\d$\/"],"WS":["\/^WS\\d\\d\\d\\d$\/"],"SM":["\/^4789\\d$\/"],"ST":[],"SA":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"SN":["\/^\\d\\d\\d\\d\\d$\/"],"RS":["\/^\\d\\d\\d\\d\\d$\/"],"SC":[],"SL":[],"SG":["\/^\\d\\d\\d\\d\\d\\d$\/"],"SK":["\/^\\d\\d\\d \\d\\d$\/"],"SI":["\/^\\d\\d\\d\\d$\/","\/^SI-\\d\\d\\d\\d$\/"],"SB":[],"SO":["\/^[a-zA-Z][a-zA-Z] \\d\\d\\d\\d\\d$\/"],"ZA":["\/^\\d\\d\\d\\d$\/"],"GS":["\/^SIQQ 1ZZ$\/"],"ES":["\/^\\d\\d\\d\\d\\d$\/"],"LK":["\/^\\d\\d\\d\\d\\d$\/"],"SD":["\/^\\d\\d\\d\\d\\d$\/"],"SR":[],"SJ":["\/^\\d\\d\\d\\d$\/"],"SZ":["\/^[a-zA-Z]\\d\\d\\d$\/"],"SE":["\/^\\d\\d\\d \\d\\d$\/"],"CH":["\/^\\d\\d\\d\\d$\/"],"SY":[],"TW":["\/^\\d\\d\\d$\/","\/^\\d\\d\\d-\\d\\d$\/"],"TZ":["\/^\\d\\d\\d\\d\\d$\/"],"TJ":["\/^\\d\\d\\d\\d\\d\\d$\/"],"TH":["\/^\\d\\d\\d\\d\\d$\/"],"TL":[],"TG":[],"TK":[],"TO":[],"TT":["\/^\\d\\d\\d\\d\\d\\d$\/"],"TN":["\/^\\d\\d\\d\\d$\/"],"TR":["\/^\\d\\d\\d\\d\\d$\/"],"TM":["\/^\\d\\d\\d\\d\\d\\d$\/"],"TC":["\/^TKCA 1ZZ$\/"],"TV":[],"UG":[],"UA":["\/^\\d\\d\\d\\d\\d$\/"],"AE":[],"GB":["\/^[a-zA-Z][a-zA-Z]\\d\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^[a-zA-Z]\\d[a-zA-Z] \\d[a-zA-Z][a-zA-Z]$\/","\/^[a-zA-Z][a-zA-Z]\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^[a-zA-Z][a-zA-Z]\\d[a-zA-Z] \\d[a-zA-Z][a-zA-Z]$\/","\/^[a-zA-Z]\\d\\d \\d[a-zA-Z][a-zA-Z]$\/","\/^[a-zA-Z]\\d \\d[a-zA-Z][a-zA-Z]$\/"],"US":["\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d$\/"],"UY":["\/^\\d\\d\\d\\d\\d$\/"],"UZ":["\/^\\d\\d\\d\\d\\d\\d$\/"],"VU":[],"VE":["\/^\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d-[a-zA-Z]$\/"],"VN":["\/^\\d\\d\\d\\d\\d\\d$\/"],"VG":["\/^VG\\d\\d\\d\\d$\/"],"VI":["\/^\\d\\d\\d\\d\\d$\/","\/^\\d\\d\\d\\d\\d-\\d\\d\\d\\d$\/"],"WF":["\/^986\\d\\d$\/"],"YE":[],"ZM":["\/^\\d\\d\\d\\d\\d$\/"],"ZW":[]}
            },
            methods: { 
              postalRegex: function () {
                const countryCode = this.selectedCountry;
                const regex = this.valMatch( this.postalReg, countryCode );
                if ( regex.length > 0 ) {
                    const re = regex[0];
                    if ( this.validatePostal(re, this.postalCode) ) {
                        this.isValid = false
                    } else {
                        this.isValid = true
                    }
                }
              }, 
              validatePostal(re, postalCode) { 
                const pattern = re.slice(1,re.length-1)
                const reg = new RegExp(pattern); 
                return reg.test(postalCode);
              },
              valMatch: function(object, str) {
                    for (const key in object) {
                        if (key.includes(str)) {
                            return object[key]
                        }
                    }
                    return false
                },
                keyMatch: function(array, str) {
                    for (const key in array) {
                        if (array[key] === str) {
                            return key
                        }
                    }
                    return false
                }
            },
            computed: {
                disabledSubmit: function () {
                    return !this.isValid
                }
            }
        })
    </script>

@endsection