<?php
  namespace App\middleware;

  use Firebase\JWT\JWT;
  require __DIR__ . '../vendor/autolad.php';

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;

  class AuthMiddleware {
    public function handle(Request $request, callable $next) {
      // Leyendo el Header por los token de validacion:
      $AuthHeader = $request->headers->get('Authorization');

      // Verificamos si llego token
      if (!$AuthHeader) {
        return new Response(json_encode(['error' => 'No token provided']), 401);
      }

      // Obtener el TOKEN especifico:
      list($jwt) = sscanf($AuthHeader, 'Bearer %s');

      if (!$jwt) {
        return new Response(json_encode(['error' => 'Token Inválido']), 401);
      }

      try {
        // Decodificamos Token:
        // $decoded = JWT::decode($jwt, $_ENV['JWT_SECRET'], ['HS256']); -> Marca error expected type 'stdclass null'. found 'string '
        /* El error anterior se debe a que intentamos asignar un valor que no tiene el tipo esperado */

        $decoded = JWT::decode($jwt, $_ENV['JWT_SECRET'], ['HS256']);
        /* JWT::decode() devuelve un objeto */

        // Asignamos el usuario decodificado a los atributos de la petición
        $request->attributes->set('user', $decoded);
      } catch (\Exception $err) {
        return new Response(json_encode(['error' => 'Token Inválido tmb']), 401);
      }

      return $next($request);
    }
  }