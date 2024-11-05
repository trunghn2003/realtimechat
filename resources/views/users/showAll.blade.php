@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <ul id="users" ></ul>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
 <script type="module">
    const users = document.getElementById('users');
    window.axios.get('/api/users')
        .then((response) => {
            response.data.forEach((user) => {
                const li = document.createElement('li');
                li.setAttribute('id', user.id);
                li.textContent = user.name;
                users.appendChild(li);
            });
        });

 </script>

 <script type="module">
    Echo.channel('users')
        .listen('UserCreated', (e) => {
            const users = document.getElementById('users');
            const li = document.createElement('li');
            li.setAttribute('id', e.user.id);
            li.textContent = e.user.name;
            users.appendChild(li);
        })
        .listen('UserDeleted', (e) => {
            const user = document.getElementById(e.user.id);
            user.remove();
        })

        .listen('UserUpdated', (e) => {
            const user = document.getElementById(e.user.id);
            user.textContent = e.user.name;
        });
 </script>
@endpush
