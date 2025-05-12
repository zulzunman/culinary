<div>
    <form action="{{ route('users.reject', $user->id) }}" method="post">
        @csrf
        <label for="">Pesan penolakan</label>
        <textarea name="comment" id=""></textarea>
        <button type="submit">submit</button>
    </form>
</div>