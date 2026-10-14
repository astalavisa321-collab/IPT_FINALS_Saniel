<div class="mb-3">
    <label for="customer_id" class="form-label">Customer *</label>
    <select name="customer_id" id="customer_id" class="form-select" required>
        <option value="">Select a customer</option>
        @foreach ($customers as $customer)
            <option value="{{ $customer->id }}"
                {{ old('customer_id', $order->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }} — {{ $customer->phone }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="service_id" class="form-label">Laundry Service *</label>
    <select name="service_id" id="service_id" class="form-select" required>
        <option value="">Select a service</option>
        @foreach ($services as $service)
            <option value="{{ $service->id }}"
                {{ old('service_id', $order->service_id ?? '') == $service->id ? 'selected' : '' }}>
                {{ $service->name }} — ₱{{ number_format($service->price_per_kg, 2) }}/kg
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="employee_id" class="form-label">Assigned Employee</label>
    <select name="employee_id" id="employee_id" class="form-select">
        <option value="">Unassigned</option>
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}"
                {{ old('employee_id', $order->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                {{ $employee->name }} — {{ $employee->position }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="weight_kg" class="form-label">Laundry Weight (kg) *</label>
    <input type="number" name="weight_kg" id="weight_kg"
        class="form-control" step="0.01" min="0.01" required
        value="{{ old('weight_kg', $order->weight_kg ?? '') }}">
    <div class="form-text">The order total will be calculated automatically using the selected service price.</div>
</div>

<div class="mb-3">
    <label for="order_date" class="form-label">Order Date *</label>
    <input type="date" name="order_date" id="order_date"
        class="form-control" required
        value="{{ old('order_date', isset($order) ? $order->order_date->format('Y-m-d') : date('Y-m-d')) }}">
</div>

<div class="mb-3">
    <label for="expected_completion_date" class="form-label">Expected Completion Date</label>
    <input type="date" name="expected_completion_date" id="expected_completion_date"
        class="form-control"
        value="{{ old('expected_completion_date', isset($order) && $order->expected_completion_date ? $order->expected_completion_date->format('Y-m-d') : '') }}">
</div>

<div class="mb-3">
    <label for="status" class="form-label">Order Status *</label>
    <select name="status" id="status" class="form-select" required>
        @foreach (['pending', 'washing', 'ready', 'completed', 'cancelled'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $order->status ?? 'pending') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notes</label>
    <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $order->notes ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
```