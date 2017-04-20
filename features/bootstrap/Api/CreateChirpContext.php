<?php

namespace Test\Behavior\Context\Api;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Faker;
use GuzzleHttp\Client;

class CreateChirpContext implements Context
{

    /** @var Faker\Generator */
    private $faker;

    /** @var Client */
    private $httpClient;

    /** @var string */
    private $chirpText;

    /** @var string */
    private $uuid;

    public function __construct()
    {
        $this->faker      = Faker\Factory::create();
        $clientOpt        = [
            'base_uri' => 'http://localhost:3000',
        ];
        $client           = new Client($clientOpt);
        $this->httpClient = $client;
    }

    /**
     * @Given I write a Chirp with :numCharacters or less characters
     */
    public function iWriteAChirpWithOrLessCharacters($numCharacters)
    {
        $this->chirpText = $this->faker->realText($numCharacters);
    }

    /**
     * @When I post the Chirp
     */
    public function iPostTheChirp()
    {
        $this->uuid = $this->faker->uuid;
        $obj  = (object)[
            'data' => (object)[
                'type' => 'chirp',
                'id' => $this->uuid,
                'attributes' => (object)[
                    'text' => $this->chirpText
                ]
            ]
        ];

        $this->httpClient->post('chirp', ['json' => $obj]);
    }

    /**
     * @Then I should see it in my timeline
     */
    public function iShouldSeeItInMyTimeline()
    {
        throw new PendingException();
    }
}
