<h2>Cadastro</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="Nome"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Senha"><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirmar Senha"><br><br>
    <button type="submit">Cadastrar</button>
</form>
