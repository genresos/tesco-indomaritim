<div class="form-group">
    @include('stisla.includes.forms.inputs.input', [
        'id' => $id ?? 'password',
        'type' => 'password',
        'label' => $label ?? 'Password',
        'required' => $required ?? true,
        'icon' => 'fas fa-key'
    ])

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="showPassword">
        <label class="form-check-label" for="showPassword">Show Password</label>
    </div>
</div>

<script>
    document.getElementById('showPassword').addEventListener('change', function() {
        const passwordInput = document.getElementById('{{ $id ?? 'password' }}');
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
