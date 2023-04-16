<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
Thank you for using. <br>
The reservation has been confirmed as shown below. please confirm. <br>
<br>
■ Reservation details <br>
**************************************************** <br>
Reservation number: {{ $transaction->trans_confirm_no }} <br>
Reservation date: {{ $transaction->created_at->format('Y-m-d') }} <br>
Reservation time: {{ $transaction->created_at->format('H:i:s') }} <br>
Payment method: {{ $transaction->pay_method }} <br>
**************************************************** <br>
@foreach($products as $product)
    Product name 1: {{ $product['name'] }} <br>
    Price: {{ $product['price'] }} VNĐ <br>
    Số lượng: {{ $product['quantity'] }} <br>
@endforeach
Tổng: {{ $transaction->trans_pay_amount }} VNĐ <br>
-------------------------------------------------- <br>
Tên người nhận: User A <br>
Phone number: {{ $transaction->phone_number }} <br>
Address: {{ $transaction->address }} . <br>
**************************************************** <br>
Contact: https://www.tomosia.com/ <br>
</body>
</html>