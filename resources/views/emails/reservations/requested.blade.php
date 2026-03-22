<x-mail::message>
# Nueva Solicitud de Reserva

Se ha recibido una nueva solicitud de reserva para **La Casilla**.

**Detalles de la reserva:**
- **Semana:** {{ $details['week_descriptor'] }} (Año {{ $details['year'] }}, Semana {{ $details['week_number'] }})
- **Nombre:** {{ $details['name'] }}
- **Email:** {{ $details['email'] }}
- **Mensaje:**
{{ $details['message'] ?? 'Sin observaciones' }}

<x-mail::button :url="config('app.url') . '/admin/weeks'">
Gestionar Semanas
</x-mail::button>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
