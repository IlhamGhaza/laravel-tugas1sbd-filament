<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .order-details,
        .customer-details {
            margin-bottom: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .order-details div,
        .customer-details div {
            margin-bottom: 8px;
            color: #666;
        }

        .customer-details {
            margin-top: 20px;
            padding-top: 20px;
        }

        .customer-details div {
            margin-bottom: 8px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .details-table th {
            background-color: #f0f0f0;
            color: #333;
        }

        .details-table td {
            background-color: #ffffff;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Order Invoice</h1>
        </div>

        <div class="order-details">
            <h2>Order Details</h2>
            <table class="details-table">
                <tr>
                    <th>Order Number</th>
                    <td>{{ $record->order_number }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $record->order_date }}</td>
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>{{ $record->total_price }}</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>{{ $record->discount }}</td>
                </tr>
            </table>
        </div>

        <div class="customer-details">
            <h2>Customer Details</h2>
            @if ($customer)
            <div><strong>Name:</strong> {{ $customer->name }}</div>
            <div><strong>Address:</strong> {{ $customer->address }}</div>
            <div><strong>Phone:</strong> {{ $customer->phone }}</div>
            @else
            <div>Customer not found</div>
            @endif
        </div>

        <div class="order-details">
            <h2>Order Items</h2>
            <table class="details-table">
                <tr>
                    <th>Arrangement</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Sub Total</th>
                </tr>
                @foreach ($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->arrangement->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->unit_price }}</td>
                    <td>{{ $detail->sub_total }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="customer-details">
            <h2>Payments</h2>
            <table class="details-table">
                <tr>
                    <th>Payment Date</th>
                    <th>Total Payment</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                </tr>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->total_payment }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->payment_status }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
