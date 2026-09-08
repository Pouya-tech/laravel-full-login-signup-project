<form method="POST" action="{{ route('logout') }}" class="inline">
    @csrf
    <button type="submit" {{ $attributes->merge(['class' => 'btn btn-danger']) }}>Logout
</form>
