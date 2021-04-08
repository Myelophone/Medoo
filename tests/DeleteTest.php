<?php
namespace Medoo\Tests;

class DeleteTest extends MedooTestCase
{
    /**
     * @covers Medoo::delete()
     * @dataProvider typesProvider
     */
    public function testDelete($type)
    {
        $this->setType($type);
        
        $this->database->delete("account", [
            "AND" => [
                "type" => "business",
                "age[<]" => 18
            ]
        ]);

        $this->assertQuery(<<<EOD
            DELETE FROM "account"
            WHERE ("type" = 'business' AND "age" < 18)
            EOD,
            $this->database->queryString
        );
    }
}