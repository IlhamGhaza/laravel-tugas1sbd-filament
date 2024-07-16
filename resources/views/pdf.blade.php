<div>Order Number: {{ $record->order_number }}</div>
<div>Order Date: {{ $record->order_date }}</div>
<div>Total Price: {{ $record->total_price }}</div>
<br>

@php
    $customer = App\Models\Customer::find($record->customer_id);
@endphp

@if ($customer)
    <div>Customer Name: {{ $customer->name }}</div>
@else
    <div>Customer not found</div>
@endif
