<?php

namespace Chirper\Chirp;

interface JsonChirpTransformer
{
    public function toChirp(string $json): Chirp;
}