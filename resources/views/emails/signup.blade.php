@extends('layouts.email')
@section('content')
    <table width="100%" style="text-align:center">
	<tbody>
	
		<tr>
			<td style="padding-bottom: 15px; text-align: center;">
				<h3>Thank you for registered at Sweetie Pie Bake Co </h3>
                
			</td>
		</tr>
		<tr >
		    <td style="padding-bottom: 15px; text-align: center;"> 
		        <a href="{{env('APP_URL')}}" target="_new">Visit the website</a>
		    </td>
		</tr>
	</tbody>
</table>
@endsection