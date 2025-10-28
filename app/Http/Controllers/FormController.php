<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactoMail;
use App\Mail\SolicitudMail;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function contacto(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'email' => 'required|email',
                'mensaje' => 'required',
            ]);

            $data = $request->all();

            Mail::to('tucorreo@dominio.com')->send(new ContactoMail($data));

            // Si es petición AJAX, retornar JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tu consulta ha sido enviada exitosamente.'
                ]);
            }

            // Si no es AJAX, comportamiento normal
            return back()->with('success', 'Mensaje enviado correctamente');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor completa todos los campos requeridos.'
                ], 422);
            }
            throw $e;

        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al enviar la consulta. Por favor, intenta nuevamente.'
                ], 500);
            }
            return back()->with('error', 'Error al enviar el mensaje');
        }
    }

    public function solicitud(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'email' => 'required|email',
                'telefono' => 'required',
                'empresa' => 'required',
                'producto' => 'required',
                'servicio' => 'required',
            ]);

            $data = $request->all();

            Mail::to('tucorreo@dominio.com')->send(new SolicitudMail($data));

            // Si es petición AJAX, retornar JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tu solicitud de presupuesto ha sido enviada exitosamente.'
                ]);
            }

            // Si no es AJAX, comportamiento normal
            return back()->with('success', 'Solicitud enviada correctamente');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor completa todos los campos requeridos.'
                ], 422);
            }
            throw $e;

        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al enviar la solicitud. Por favor, intenta nuevamente.'
                ], 500);
            }
            return back()->with('error', 'Error al enviar la solicitud');
        }
    }
}