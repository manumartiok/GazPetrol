<h2>Nuevo mensaje de contacto</h2>
<p><strong>Nombre:</strong> {{ $data['nombre'] ?? '' }}</p>
<p><strong>Apellido:</strong> {{ $data['apellido'] ?? '' }}</p>
<p><strong>Email:</strong> {{ $data['email'] ?? '' }}</p>
<p><strong>Celular:</strong> {{ $data['celular'] ?? '' }}</p>
<p><strong>Mensaje:</strong></p>
<p>{{ $data['mensaje'] ?? '' }}</p>