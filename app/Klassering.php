<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klassering extends Model {
    
    protected $table = 'klassering';

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
        
        'club',
        'team',
        
        'ranking_competitie',
        'score_wedstrijden',
        'score_punten',
        'score_voor',
        'score_tegen',
        
        'ranking_spirit',
        'score_spirit',
        
        'opmerking'
    ];
      
}