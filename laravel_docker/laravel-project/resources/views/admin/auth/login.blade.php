<!-- admin/login.blade.php -->
<form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">ログイン</button>
</form>
