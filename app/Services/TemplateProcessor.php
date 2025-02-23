<?php

namespace App\Services;

use App\Models\Celebrant;
use Carbon\Carbon;

class TemplateProcessor
{
    public static function processBirthdayTemplate(Celebrant $celebrant, string $template = null)
    {
        $template = $template ?? 'Happy Birthday {name}!';
        
         // Define available replacements
        $replacements = [
          '{name}' => $celebrant->name ?? '',
          '{title}' => $celebrant->title ?? '',
          '{age}' => $celebrant->birthday ? Carbon::parse($celebrant->birthday)->age : '',
          '{date}' => $celebrant->birthday ? Carbon::parse($celebrant->birthday)->format('F d') : ''
      ];

      // Remove any undefined variables from template
      $template = preg_replace('/\{[^}]+\}/', '', preg_replace(array_keys($replacements), array_values($replacements), $template));

      return trim($template);
    }

    public static function processWeddingTemplate(Celebrant $celebrant, string $template = null)
    {
        $template = $template ?? 'Happy Wedding Anniversary {name}!';
        
        $replacements = [
            '{name}' => $celebrant->name,
            '{title}' => $celebrant->title,
            '{years}' => Carbon::parse($celebrant->wedding)->age,
            '{date}' => Carbon::parse($celebrant->wedding)->format('F d')
        ];
        // Remove any undefined variables from template
        $template = preg_replace('/\{[^}]+\}/', '', preg_replace(array_keys($replacements), array_values($replacements), $template));
        
        return trim($template);
    }
}
