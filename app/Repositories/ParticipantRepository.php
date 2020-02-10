<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/10/2020
 * Time: 6:07 PM
 */

namespace App\Repositories;


use App\Event;
use App\Group;
use App\Individual;
use App\Organization;
use App\Participant;
use App\ParticipantRole;
use App\Ward;

class ParticipantRepository
{

    /*
     * Gett all Participants with the relationship
     */
    public function all()
    {
        return Participant::with('individual','organization','event','ward','group','participant_role')
            ->latest()
            ->get()
            ->map->format();
    }


    /*
     * Delete
     */


}
