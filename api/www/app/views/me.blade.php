@extends('layout')

@section('content')
  <h2>Welcome "{{ Auth::user()->username }}" to the messages page!</h2>

  <hr />

  <h1 style="text-align: center">MESSAGES</h1>

  <?php $messages = Auth::user()->messages?>

  <table>

  	<tr>
  		<th>TEXT</th>
  		<th>TIME</th>
  	</tr>

  	@foreach ($messages as $message)
  	<tr>
  		<td>{{ $message->text }}</td>
		<td>{{ $message->created_at }}</td>
  	</tr>
  	@endforeach
	
  </table>

  
@stop