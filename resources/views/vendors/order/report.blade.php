<!DOCTYPE html>
<html>
<head>
    <style>
        h5 {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            width: 25%;
        }
        th {
            background-color: cyan;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center; color:rgb(22, 104, 180)">{{ Auth::user()->name }} Product Sells Report</h3>
    <h4 style="text-align: center; color:rgb(22, 104, 180)">From {{ $startDate->format('d-M-Y') }} To {{ $endDate->format('d-M-Y') }}</h4>
  
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Invoice Number</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
                $totalQuantity = 0;
            @endphp
            @foreach($sellProducts as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->productOrdered->name }}</td>
                    <td>{{ $orderDetail->order->invoice_no }}</td>
                    <td>{{ $orderDetail->product_sales_quantity }}</td>
                    <td>{{ $orderDetail->order->amount }}</td>
                </tr>
            @php
                $totalPrice += $orderDetail->order->amount;
                $totalQuantity += $orderDetail->product_sales_quantity;
            @endphp
            @endforeach
            <tr>
                <td colspan="2"><strong >Total</strong></td>
                <td><strong>{{ $totalQuantity }}</strong></td>
                <td><strong>{{ $totalPrice }}</strong></td>
            </tr>
        </tbody>
    </table>
  
</body>
</html>

