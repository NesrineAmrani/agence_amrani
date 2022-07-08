<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Ferma extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'ferma_code',
        'ferma_facade', // array
        'ferma_situation', // array
        'ferma_etat', // array
        'ferma_surface_total',
        'ferma_surface_batie',
        'surface_jardin',
        'nbr_etages',
        'surface',
        'ferma_details', // array
        'largeur_1',
        'largeur_2',
        'largeur_3',
        'activite',
        'projet',
        'description',
        'prix_metre',
        'prix_total',
        'prix_declaration',
        'client_id',
        'city_id',
        'city_sector_id',
        'intermediaire_id',
        'ferma_service_id',
        'created_at',
        'updated_at'
    ];
    public const ETATS = ['Nouveau', 'Déjà Utilisé'];
    public const FACADES = ['Rue', 'Derb', 'Place', 'Piscine', 'Mer'];
    public const SITUATIONS = ['Titre', 'Milikia', 'Contrat', 'Miftah', 'Contrat Adlia'];
    public const DETAILS = ['Piscine', 'Eau', 'Electricite', 'Puit'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    
    public function intermediaire(){
        return $this->belongsTo(Intermediaire::class);
    }

    public function service(){
        return $this->belongsTo(FermaService::class, 'ferma_service_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function city_sector(){
        return $this->belongsTo(CitySector::class);
    }
}
