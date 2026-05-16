<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = ['name', 'capacity', 'description', 'image'];

    // Calcul automatique de la disponibilité
    public function getIsAvailableAttribute(): bool
    {
        return !$this->reservations()
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->exists();
    }

    // Accesseur pour l'image (Lien direct ou Placeholder)
    public function getRoomImageAttribute(): string
    {
        if ($this->image && filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        // Génère un carré coloré avec les initiales si vide
        return "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&background=6366f1&color=fff&size=512";
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}