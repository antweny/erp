<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/13/2020
 * Time: 12:01 PM
 */

namespace App\Repositories;


use App\Individual;

class IndividualRepository
{
    /*
     * Gett all Participants with the relationship
     */
    public function all()
    {
        return Individual::with('country','city','district','ward','street','education_level')
            ->latest()
            ->get()
            ->map->format();
    }
}
