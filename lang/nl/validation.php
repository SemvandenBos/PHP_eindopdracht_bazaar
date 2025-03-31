<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validatie Taalregels
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels bevatten de standaard foutmeldingen die door
    | de validator worden gebruikt. Sommige regels hebben meerdere versies,
    | zoals de regels voor grootte. Voel je vrij om elk van deze berichten aan te passen.
    |
    */

    'accepted' => 'Het :attribute moet worden geaccepteerd.',
    'accepted_if' => 'Het :attribute moet worden geaccepteerd wanneer :other :value is.',
    'active_url' => 'Het :attribute moet een geldige URL zijn.',
    'after' => 'Het :attribute moet een datum zijn na :date.',
    'after_or_equal' => 'Het :attribute moet een datum zijn op of na :date.',
    'alpha' => 'Het :attribute mag alleen letters bevatten.',
    'alpha_dash' => 'Het :attribute mag alleen letters, cijfers, streepjes en onderstrepingen bevatten.',
    'alpha_num' => 'Het :attribute mag alleen letters en cijfers bevatten.',
    'array' => 'Het :attribute moet een array zijn.',
    'ascii' => 'Het :attribute mag alleen enkelbyte alfanumerieke tekens en symbolen bevatten.',
    'before' => 'Het :attribute moet een datum zijn voor :date.',
    'before_or_equal' => 'Het :attribute moet een datum zijn op of voor :date.',
    'between' => [
        'array' => 'Het :attribute moet tussen :min en :max items bevatten.',
        'file' => 'Het :attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Het :attribute moet tussen :min en :max zijn.',
        'string' => 'Het :attribute moet tussen :min en :max tekens zijn.',
    ],
    'boolean' => 'Het :attribute moet waar of onwaar zijn.',
    'confirmed' => 'De bevestiging van het :attribute komt niet overeen.',
    'date' => 'Het :attribute moet een geldige datum zijn.',
    'email' => 'Het :attribute moet een geldig e-mailadres zijn.',
    'image' => 'Het :attribute moet een afbeelding zijn.',
    'integer' => 'Het :attribute moet een geheel getal zijn.',
    'max' => [
        'array' => 'Het :attribute mag niet meer dan :max items bevatten.',
        'file' => 'Het :attribute mag niet groter zijn dan :max kilobytes.',
        'numeric' => 'Het :attribute mag niet groter zijn dan :max.',
        'string' => 'Het :attribute mag niet meer dan :max tekens bevatten.',
    ],
    'min' => [
        'array' => 'Het :attribute moet minstens :min items bevatten.',
        'file' => 'Het :attribute moet minstens :min kilobytes zijn.',
        'numeric' => 'Het :attribute moet minstens :min zijn.',
        'string' => 'Het :attribute moet minstens :min tekens bevatten.',
    ],
    'numeric' => 'Het :attribute moet een nummer zijn.',
    'required' => 'Het :attribute is verplicht.',
    'same' => 'Het :attribute en :other moeten overeenkomen.',
    'size' => [
        'array' => 'Het :attribute moet :size items bevatten.',
        'file' => 'Het :attribute moet :size kilobytes zijn.',
        'numeric' => 'Het :attribute moet :size zijn.',
        'string' => 'Het :attribute moet :size tekens bevatten.',
    ],
    'string' => 'Het :attribute moet een string zijn.',
    'unique' => 'Het :attribute is al in gebruik.',
    'url' => 'Het :attribute moet een geldige URL zijn.',

    /*
    |--------------------------------------------------------------------------
    | Aangepaste Validatie Attributen
    |--------------------------------------------------------------------------
    |
    | De volgende taalregels worden gebruikt om onze attributen leesbaarder
    | te maken, zoals "E-mailadres" in plaats van "email". Dit helpt ons
    | om berichten expressiever te maken.
    |
    */

    'attributes' => [],

];