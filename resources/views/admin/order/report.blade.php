<!DOCTYPE html>
<html>
<head>
    <title>Vendor Report</title>
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
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    @foreach($groupedData as $vendorName => $orderDetails)
        <h5>{{ $vendorName }}</h5>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grandTotalPrice = 0;
                @endphp
                @foreach($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->productOrdered->name }}</td>
                        <td>{{ $orderDetail->product_sales_quantity }}</td>
                        <td>{{ $orderDetail->order->amount }}</td>
                    </tr>
                @php
                    $grandTotalPrice += $orderDetail->order->amount;
                @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong>Grand Total</strong></td>
                    <td><strong>{{ $grandTotalPrice }}</strong></td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>

