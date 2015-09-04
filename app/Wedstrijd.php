<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wedstrijd extends Model {
    
    protected $table = 'wedstrijden';

    protected $fillable = [
        'competitie',
        'compleet',
        'type',
        'jaar_begin',
        'jaar_eind',
        'datum_begin',
        'datum_eind',
        
        'leeftijd',
        'terrein',
        'divisie',
        'geslacht',
        'speeldag',
        'locatie',
        'club_thuis',
        'team_thuis',
        'club_uit',
        'team_uit',
        'score_thuis',
        'score_uit',
        'opmerking'
    ];
  
}