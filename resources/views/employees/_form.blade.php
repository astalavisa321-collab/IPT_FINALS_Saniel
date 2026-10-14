<div class="mb-3">
    <label for="name" class="form-label">Employee Name *</label>
    <input type="text" name="name" id="name" class="form-control" required
        maxlength="255" value="{{ old('name', $employee->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone Number *</label>
    <input type="text" name="phone" id="phone" class="form-control" required
        maxlength="255" value="{{ old('phone', $employee->phone ?? '') }}">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control"
        maxlength="255" value="{{ old('email', $employee->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="position" class="form-label">Position *</label>
    <input type="text" name="position" id="position" class="form-control"
        required maxlength="255" value="{{ old('position', $employee->position ?? '') }}">
</div>

<div class="mb-3">
    <label for="status" class="form-label">Employment Status *</label>
    <select name="status" id="status" class="form-select" required>
        @foreach (['active', 'inactive'] as $status)
            <option value="{{ $status }}"
                {{ old('status', $employee->status ?? 'active') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
