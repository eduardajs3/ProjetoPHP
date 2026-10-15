<?php
namespace App\App\Commons\Validations;

class ValidateRequestBody {
  public function parse($body, $requiredFields = []) {
    if (!is_object($body)) {
      return [
        'valid' => false,
        'error' => 'Invalid JSON format or empty body.'
      ];
    }
  
    foreach ($requiredFields as $field) {
      if (!property_exists($body, $field)) {
        return [
          'valid' => false,
          'error' => "Missing required fields"
        ];
      }
    }
  
    return [
      'valid' => true,
      'data' => $body
    ];
  }
}