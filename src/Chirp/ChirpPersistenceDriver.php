<?php

namespace Chirper\Chirp;

interface ChirpPersistenceDriver
{
    /**
     * @param Chirp $chirp
     * @return bool
     *
     * @throws PersistenceDriverException
     */
    public function create(Chirp $chirp): bool;
}