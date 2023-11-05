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
    <h3 style="text-align: center; color:rgb(22, 104, 180)">Vendor Wise Product Sells Report</h3>
    <h4 style="text-align: center; color:rgb(22, 104, 180)">From {{ $startDate->format('d-M-Y') }} To {{ $endDate->format('d-M-Y') }}</h4>
    @php
        $grandTotalPrice = 0;
        $grandTotalQuantity = 0;
    @endphp
    @foreach($groupedData as $vendorName => $orderDetails)
        <h5>Vendor name: <span style="color: rgb(224, 13, 94)">{{ $vendorName }}</span></h5>
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
                @foreach($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->productOrdered->name }}</td>
                        <td>{{ $orderDetail->order->invoice_no }}</td>
                        <td>{{ $orderDetail->product_sales_quantity }}</td>
                        <td>{{ $orderDetail->order->amount }}</td>
                    </tr>
                @php
                    $totalPrice += $orderDetail->order->amount;
                    $totalQuantity += $orderDetail->product_sales_quantity;
                    $grandTotalPrice += $orderDetail->order->amount;
                    $grandTotalQuantity += $orderDetail->product_sales_quantity;

                @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong >Total</strong></td>
                    <td><strong>{{ $totalQuantity }}</strong></td>
                    <td><strong>{{ $totalPrice }}</strong></td>
                </tr>
            </tbody>
        </table>
    @endforeach
    &nbsp;
    <h4 style="color: rgb(11, 163, 130)">Total product Sell: {{ $grandTotalQuantity }}</h4>
    <h4 style="color: rgb(11, 163, 130)">Total Price: {{ $grandTotalPrice }}</h4>
</body>
</html>

