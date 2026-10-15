<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function ensureNutritionistIsAuthenticated() {
  $secretKey = '540e0fdd739c03c63d6b042425f4c777';

  $headers = getallheaders();
  if (!isset($headers['Authorization'])) {
      http_response_code(401);
      echo json_encode(['message' => 'Token is missing!']);
      exit;
  }

  $authHeader = $headers['Authorization'];
  if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
      http_response_code(401);
      echo json_encode(['message' => 'Invalid Authorization header format']);
      exit;
  }

  $token = $matches[1];

  try {
      $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

      $_SESSION['user'] = $decoded;
  } catch (Exception $e) {
      http_response_code(401);
      echo json_encode(['error' => 'Invalid or expired token', 'message' => $e->getMessage()]);
      exit;
  }
}