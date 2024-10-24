@extends('layouts.email')

@section('content')

<h2 style="font-size:170%;font-weight:bolder;text-align:center;letter-spacing:-1px; margin-bottom:30px; color:#666;"><span>Contact us Email</span></h2>
            
<table cellpadding="8" cellspacing="0" align="center">
    <tr style="border-bottom:1px solid #DDD;">
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Subject</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->subject }}</td>
    </tr>
    <tr>
        <th align="left" style="font-weight:normal;border-bottom:1px solid #DDD;">Name</th>
        <td style="font-weight:bold;border-bottom:1px solid #DDD;">{{ $contact->first_name }} {{ $contact->last_name }}</td>
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
        <td colspan="2"><p>{{ $contact->message }}</p></td>
    </tr>
</table>

@endsection
