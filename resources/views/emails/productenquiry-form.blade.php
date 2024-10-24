@extends('layouts.email')

@section('content')

<h2 style="font-size:170%;font-weight:bolder;text-align:center;letter-spacing:-1px; margin-bottom:30px; color:#666;"><span>Product Inquiry</span></h2>
            
<table cellpadding="8" cellspacing="0" align="center">
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD; ">Product</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->product->name }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD; ">Name</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->firstname }} {{ $contact->lastname }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Email</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->email }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Phone</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->phone }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Company</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->company_name }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Website</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->website }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Address</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->address }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">City</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->city }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Postalcode</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->postalcode }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Province</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->province }}</td>
    </tr>
</table>

@endsection
