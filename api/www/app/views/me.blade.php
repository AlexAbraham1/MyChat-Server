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


  <!--FORM TO ADD MESSAGE -->

  {{ Form::open(array('url' => 'new/message', 'method' => 'post')) }}

  <p>
      <span style="margin-left: 100px;">{{ Form::text('text', Input::old('text'),  array('placeholder'=>'ADD TASK')) }}</span>

      <span style="margin-left: 30px;">{{ Form::submit('POST') }}</span>
  </p>



  {{ Form::close() }}

  
@stop