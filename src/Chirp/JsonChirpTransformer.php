<?php

namespace Chirper\Chirp;

interface JsonChirpTransformer
{
    /**
     * @param string $json
     * @return Chirp
     *
     * @throws \Exception
     */
    public function toChirp(string $json): Chirp;
}