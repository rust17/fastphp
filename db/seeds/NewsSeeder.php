<?php


use Phinx\Seed\AbstractSeed;

class NewsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create('ZH_CN');
        $data = [];
        for ($i = 0; $i < 100; $i ++) {
            $data[] = [
                'news_title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'news_body' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->insert('news', $data);
    }
}
