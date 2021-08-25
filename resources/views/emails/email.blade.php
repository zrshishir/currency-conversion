<!DOCTYPE html>
<html>
<head>
    <title>Account Credit</title>
</head>
<body>
<h1>Your wallet has been credited successfully.</h1>
<br>
    <span style="white-space: pre-line">Sender Name: {{ $details['sender_name'] }}</span> </br>
    <span style="white-space: pre-line">Sender Email: {{ $details['sender_email'] }}</span> </br>
    <span style="white-space: pre-line">Amount: <strong>{{ $details['amount'] }}</strong> {{$details['currency']}}</span> </br>
</div>
<p>Thank you</p>
</body>
</html>
