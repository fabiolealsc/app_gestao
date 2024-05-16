
{{ $slot }}
<form action={{ route('site.contato') }} method="POST">
    @csrf
    <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Nome" class={{ $classe }}>
    <br>
    <input type="text" name="telefone" value="{{ old('telefone') }}" placeholder="Telefone" class={{ $classe }}>
    <br>
    <input type="text" name="email" value="{{ old('email') }}" placeholder="E-mail" class={{ $classe }}>
    <br>
    
    <select name="motivo_contato" class={{ $classe }}>
        <option value="">Qual o motivo do contato?</option>
        @foreach ($motivo_contato as $key => $value)
            <option value="{{$key}}" {{ old('motivo_contato') == $key ? 'selected' : '' }} >{{$value}}</option>
        @endforeach
    </select>
    <br>
    <textarea name="mensagem" class={{ $classe }}>{{ old('mensagem') != '' ? old('mensagem') : 'Preencha aqui a sua mensagem' }}</textarea>
    <br>
    <button type="submit" class={{ $classe }}>ENVIAR</button>
</form>
<div style="position:absolute; top:0px; left:0px; width:100%; background:red">
    <pre>
        {{ print_r($errors) }}
    </pre>
</div>