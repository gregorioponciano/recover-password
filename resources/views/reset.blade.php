<h2>Redefinir Senha</h2>

<form method="POST" action="/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Nova senha"><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirmar senha"><br><br>
    <button type="submit">Redefinir</button>
</form>
