<?php
namespace Tests\Unit\Http\Controllers\Backend;

use App\Models\Artist;
use App\Repositories\Artist\ArtistEloquentRepository as ArtistRepo;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Str;

class ArtistlUnitTest extends TestCase
{
    /** @test */
    public function testCreate()
    {
        $faker = Factory::create();
        $name = $faker->name;
        $data = [
            'name' => $name,
            'slug' => Str::slug($name),
            'avatar' => $faker->url,
            'year_active' => $faker->numberBetween(0, 50),
            'info' => $faker->word,
        ];
        $artistRepo = new ArtistRepo;
        $artist = $artistRepo->createArtist($data);
        // assert
        $this->assertInstanceOf(Artist::class, $artist);
        $this->assertEquals($data['name'], $artist->name);
        $this->assertEquals($data['slug'], $artist->slug);
        $this->assertEquals($data['avatar'], $artist->avatar);
        $this->assertEquals($data['year_active'], $artist->year_active);
        $this->assertEquals($data['info'], $artist->info);
        $this->assertDatabaseHas('artists', [
            'name' => $artist->name,
        ]);
    }

    public function testShow()
    {
        $artist = factory(Artist::class)->create();
        $artistRepo = new ArtistRepo;
        $result = $artistRepo->findArtist($artist->id);
        // assert
        $this->assertInstanceOf(Artist::class, $result);
        $this->assertEquals($result->name, $artist->name);
        $this->assertEquals($result->slug, $artist->slug);
        $this->assertEquals($result->avatar, $artist->avatar);
        $this->assertEquals($result->year_active, $artist->year_active);
        $this->assertEquals($result->info, $artist->info);
    }

    public function testUpdate()
    {
        $artist = factory(Artist::class)->create();
        $artistRepo = new ArtistRepo;
        $result = false;
        $faker = Factory::create();
        $name = $faker->name;
        $data = [
            'name' => $name,
            'slug' => Str::slug($name),
            'avatar' => $faker->url,
            'year_active' => $faker->numberBetween(0, 50),
            'info' => $faker->word,
        ];
        $update = $artistRepo->updateArtist($artist->id, $data);
        if (is_object($update)) {
            $result = true;
        }
        // assert
        $this->assertTrue($result);
        $this->assertEquals($data['name'], $update->name);
        $this->assertEquals($data['slug'], $update->slug);
        $this->assertEquals($data['avatar'], $update->avatar);
        $this->assertEquals($data['year_active'], $update->year_active);
        $this->assertEquals($data['info'], $update->info);
        $this->assertDatabaseHas('artists', [
            'name' => $data['name'],
        ]);
    }

    public function testDelete()
    {
        $artist = factory(Artist::class)->create();
        $artistRepo = new ArtistRepo;
        $delete = $artistRepo->deleteArtist($artist->id);
        // assert
        $this->assertTrue($delete);
        $this->assertDatabaseMissing('artists', [
            'name' => $artist->name,
        ]);
    }
}
