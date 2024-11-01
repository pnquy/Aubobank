<div class="confirmation-form">
    <form id="deactivationForm" method="POST" action="{{ route('profile.deactivate-account') }}">
        @csrf
        <input type="checkbox" id="confirmCheckbox">
        <label for="confirmCheckbox">Bạn có chắc chắn muốn huỷ kích hoạt tài khoản của mình không?</label><br>
        <button type="submit" class="btn btn-danger" disabled id="submitButton">Huỷ kích hoạt</button>
    </form>
</div>

<script>
    document.getElementById('confirmCheckbox').addEventListener('change', function() {
        document.getElementById('submitButton').disabled = !this.checked;
    });
</script>