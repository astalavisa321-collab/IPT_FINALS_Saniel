
<div class="mb-3">
    <label for="name" class="form-label">Service Name *</label>
    <input type="text" name="name" id="name" class="form-control" required
        maxlength="255" value="{{ old('name', $service->name ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control"
        rows="3">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="price_per_kg" class="form-label">Price per Kilogram (₱) *</label>
    <input type="number" name="price_per_kg" id="price_per_kg"
        class="form-control" step="0.01" min="0.01" required
        value="{{ old('price_per_kg', $service->price_per_kg ?? '') }}">
</div>

<div class="mb-3">
    <label for="turnaround_hours" class="form-label">Turnaround Time (Hours) *</label>
    <input type="number" name="turnaround_hours" id="turnaround_hours"
        class="form-control" min="1" required
        value="{{ old('turnaround_hours', $service->turnaround_hours ?? 24) }}">
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Service Status *</label>
    <select name="is_active" id="is_active" class="form-select" required>
        <option value="1"
            {{ (string) old('is_active', isset($service) ? (int) $service->is_active : 1) === '1' ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ (string) old('is_active', isset($service) ? (int) $service->is_active : 1) === '0' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>

<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
<a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
