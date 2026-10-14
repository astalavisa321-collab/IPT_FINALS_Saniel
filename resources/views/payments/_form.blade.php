<div class="mb-3">
    <label for="order_id" class="form-label">Laundry Order *</label>
    <select name="order_id" id="order_id" class="form-select" required>
        <option value="">Select an order</option>
        @foreach ($orders as $orderOption)
            <option value="{{ $orderOption->id }}"
                {{ old('order_id', $payment->order_id ?? request('order_id', '')) == $orderOption->id ? 'selected' : '' }}>
                Order #{{ $orderOption->id }} —
                {{ $orderOption->customer->name }} —
                ₱{{ number_format($orderOption->total_amount, 2) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Payment Amount (₱) *</label>
    <input type="number" name="amount" id="amount" class="form-control"
        step="0.01" min="0.01" required
        value="{{ old('amount', $payment->amount ?? '') }}">
</div>

<div class="mb-3">
    <label for="method" class="form-label">Payment Method *</label>
    <select name="method" id="method" class="form-select" required>
        @foreach (['cash', 'gcash', 'bank_transfer'] as $method)
            <option value="{{ $method }}"
                {{ old('method', $payment->method ?? 'cash') === $method ? 'selected' : '' }}>
                {{ ucfirst(str_replace('_', ' ', $method)) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Payment Status *</label>
    <select name="status" id="status" class="form-select" required>
        @foreach (['pending', 'completed', 'failed', 'refunded'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $payment->status ?? 'pending') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="paid_at" class="form-label">Date and Time Paid</label>
    <input type="datetime-local" name="paid_at" id="paid_at" class="form-control"
        value="{{ old('paid_at', isset($payment) && $payment->paid_at ? $payment->paid_at->format('Y-m-d\TH:i') : '') }}">
    <div class="form-text">Leave blank if the payment has not yet been made.</div>
</div>

<div class="mb-3">
    <label for="reference_number" class="form-label">Reference Number</label>
    <input type="text" name="reference_number" id="reference_number"
        class="form-control" maxlength="255"
        value="{{ old('reference_number', $payment->reference_number ?? '') }}">
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
