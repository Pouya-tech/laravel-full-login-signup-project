<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" class="btn btn-danger">Logout
</form>
