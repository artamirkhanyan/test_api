<?php


class ChecklistTest extends TestCase
{

    public function testMeetWordCount(){

        config()->set('config.minimum_words', 10);

        $parameters = [
            'content' => 'fruits are really good for your health. You should eat at least 1 banana per day and 1 green apple.'
        ];

        $this->post("api/checklist", $parameters);

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                "error",
                "content",
                "keywords_used",
                "average_keywords_density"
            ]
        );
    }
}