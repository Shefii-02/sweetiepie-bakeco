@extends('layouts.email')


@section('content')

<h2 style="font-size:170%;font-weight:bolder;text-align:center;letter-spacing:-1px; margin-bottom:30px; color:#666;"><span>Career Application</span></h2>
            
<table cellpadding="8" cellspacing="0" align="center">
    <tr style="border-bottom:1px solid #DDD;">
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Store</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->store_name }}</td>
    </tr>
     <tr style="border-bottom:1px solid #DDD;">
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Position</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->position }}</td>
    </tr>
     <tr style="border-bottom:1px solid #DDD;">
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Name</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->firstname . ' ' . $career->lastname }}</td>
    </tr>
     <tr style="border-bottom:1px solid #DDD;">
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Email</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->email }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Phone</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->phone }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Availability</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $career->availability }}</td>
    </tr>
    <tr>
        <td colspan="2"><p>{{ $career->message }}</p></td>
    </tr>
</table>


@endsection
