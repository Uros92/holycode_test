<?php


class ApiTest extends TestCase
{
    /**
     * A basic test for api endpoint and checking json structure.
     *
     * @return void
     */
    public function testApi()
    {
        $this->get('/countries');

        $this->seeStatusCode(200);

        $this->seeJsonStructure(
            [
                [
                    'country_description',
                    'name',
                    'videos'
                ]
            ]
        );
    }
}
