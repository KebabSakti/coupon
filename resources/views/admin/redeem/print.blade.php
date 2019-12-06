<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>Print Coupon</title>
 <style type="text/css">
    
</style>
</head>
<body>
    @foreach ($coupon as $item)
    <table style="width:100%; font-size:40px; border-bottom:5px dashed #CCC; margin-bottom:30px; padding-bottom:20px;">
        <tr>
            <td style="width:30%;">Customer ID</td>
            <td>: {{$item->customer->customer_code}}</td>
        </tr>
        <tr>
            <td>Customer Name</td>
            <td>: {{$item->customer->name}}</td>
        </tr>
        <tr>
            <td>Coupon Code</td>
            <td>: {{$item->coupon_code}}</td>
        </tr>
    </table>
   @endforeach
</body>
</html>