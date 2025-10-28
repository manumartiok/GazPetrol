<h2>Nueva solicitud de presupuesto</h2>
<p><strong>Nombre:</strong> {{ $data['nombre'] ?? '' }}</p>
<p><strong>Email:</strong> {{ $data['email'] ?? '' }}</p>
<p><strong>Teléfono:</strong> {{ $data['telefono'] ?? '' }}</p>
<p><strong>Empresa:</strong> {{ $data['empresa'] ?? '' }}</p>
<p><strong>Producto:</strong> {{ $data['producto'] ?? '' }}</p>
<p><strong>Servicio:</strong> {{ $data['servicio'] ?? '' }}</p>
<p><strong>Aclaraciones:</strong></p>
<p>{{ $data['aclaraciones'] ?? '' }}</p>
@if(isset($data['archivo']))
<p><strong>Archivo adjunto:</strong> {{ $data['archivo']->getClientOriginalName() }}</p>
@endif