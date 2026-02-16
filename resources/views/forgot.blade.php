<h2>Recuperar Senha</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/forgot-password">
    @csrf
    <input type="email" name="email" placeholder="Digite seu email"><br><br>
    <button type="submit">Enviar Link</button>
</form>
