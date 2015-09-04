<?php

namespace App\Http\Controllers;

use App\User;

use App\Klassering;

use App\Wedstrijd;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function competities(Request $request)
    {
        $competities = Klassering::select('type', 'jaar_begin', 'jaar_eind', 'locatie', 'competitie', 'geslacht', 'terrein', 'club', 'team', 'ranking_competitie', 'ranking_spirit')
		               ->orderBy('jaar_begin', 'desc');
        $competities = $this->filter($request, $competities);
        $competities = $competities->get();

        $result = [];

        foreach ($competities as $competitie)
        {
            if (!array_key_exists ($competitie->competitie, $result))
            {
                $fill = array(
                    "id" => $competitie->competitie,
                    "type" => $competitie->type,
                    "jaar_begin" => $competitie->jaar_begin,
                    "jaar_eind" => $competitie->jaar_eind,
                    "geslacht" => $competitie->geslacht,
                    "terrein" => $competitie->terrein,
                    "locatie" => $competitie->locatie,
                    "kampioen" => "",
                    "spirit" => "",
                );

                $result[$competitie->competitie] = $fill;
            }

            if ($competitie->speeldag == "" && ($competitie->divisie == "" || $competitie->divisie == 1))
            {
                if ($competitie->ranking_competitie == 1)
                {
                    $result[$competitie->competitie]["kampioen"] = $competitie->team;
                }
                
                if ($competitie->ranking_spirit == 1)
                {
                    $result[$competitie->competitie]["spirit"] = $competitie->team;
                }        
            }                
        }

        return array_values($result);
    }
    
    //ublic function wedstrijdenlijst(Request $request)
   // {
    //    $competities = Wedstrijd::select('competitie', 'speeldag', 'divisie', 'locatie', 'compleet', 'club_thuis', 'team_thuis', 'club_uit', 'team_uit', 'score_thuis', 'score_uit')
//		               ->orderBy('jaar_begin', 'desc');
 //       $competities = $this->filter($request, $competities);
  //     
   //     return $competities->get();
   // }

    public function opzet(Request $request, $id)
    {
        $klassement = Klassering::select('speeldag', 'divisie')
                       ->groupBy('speeldag', 'divisie')
                       ->where('competitie', '=', urldecode($id));
        $klassement = $this->filter($request, $klassement);
        $klassement = $klassement->get();

        $wedstrijd = Wedstrijd::select('speeldag', 'divisie')
                       ->groupBy('speeldag', 'divisie')
                       ->where('competitie', '=', urldecode($id));
        $wedstrijd = $this->filter($request, $wedstrijd);
        $wedstrijd = $wedstrijd->get();
        
        $result = [];
        foreach ($klassement as $combi)
        {
            $fill = array(
                "speeldag" => $combi->speeldag,
                "divisie" => $combi->divisie
            );

            if (!in_array($fill, $result))
            {
                $result[] = $fill;
            }
        }
        foreach ($wedstrijd as $combi)
        {
            $fill = array(
                "speeldag" => $combi->speeldag,
                "divisie" => $combi->divisie 
            );

            if (!in_array($fill, $result))
            {
                $result[] = $fill;
            }
        }
        return $result;
    }

    public function wedstrijden(Request $request, $id)
    {
        $competities = Wedstrijd::select('speeldag', 'divisie', 'locatie', 'club_thuis', 'team_thuis', 'club_uit', 'team_uit', 'score_thuis', 'score_uit')
		               ->orderBy('speeldag', 'desc')
                       ->orderBy('divisie', 'asc')
                       ->where('competitie', '=', urldecode($id));
        $competities = $this->filter($request, $competities);
        
        return $competities->get();
    }

    /*public function klassementenlijst(Request $request)
    {
        $competities = Klassering::select('type', 'jaar_begin', 'jaar_eind', 'datum_begin', 'datum_eind', 'locatie', 'competitie')
		               ->orderBy('jaar_begin', 'desc');
        $competities = $this->filter($request, $competities);
        
        return $competities->get();
    }*/


    public function klassementen(Request $request, $id)
    {
        $competities = Klassering::select('speeldag', 'divisie', 'club', 'team', 'ranking_competitie', 'ranking_spirit', 'score_wedstrijden', 'score_punten', 'score_voor', 'score_tegen', 'score_spirit')
		               ->orderBy('ranking_competitie', 'asc')
                       ->where('competitie', '=', urldecode($id));
        $competities = $this->filter($request, $competities);
        
        return $competities->get();
    }

    /*public function kampioenen(Request $request)
    {
        $kampioenen = Klassering::select('competitie', 'type', 'jaar_begin', 'jaar_eind', 'competitie', 'ranking_competitie', 'ranking_spirit')
		               ->orderBy('jaar_begin', 'desc')
                       ->where('speeldag', '=', '')
                       ->where(function ($query) {
                           $query->where('ranking_competitie', '<=', 3)
                                 ->orWhere('ranking_spirit', '=', 1);
                           });
                       
        $kampioenen = $this->filter($request, $kampioenen);
        
        return $kampioenen->get();
    }*/

    private function filter(Request $request, $query)
    {
        if ($request->has('competitie'))
        {
            $query = $query->where('competitie', '=', $request->input('competitie'));
        }
        if ($request->has('type'))
        {
            $query =$query->where('type', '=', $request->input('type'));
        }
        if ($request->has('geslacht'))
        {
            $query =$query->where('geslacht', '=', $request->input('geslacht'));
        }
        if ($request->has('leeftijd'))
        {
            $query =$query->where('leeftijd', '=', $request->input('leeftijd'));
        } 
        if ($request->has('speeldag'))
        {
            $query =$query->where('speeldag', '=', $request->input('speeldag'));
        } 
        if ($request->has('divisie'))
        {
            $query =$query->where('divisie', '=', $request->input('divisie'));
        }       
        return $query; 
    }
}
